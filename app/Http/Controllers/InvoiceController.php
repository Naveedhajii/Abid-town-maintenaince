<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Members;
use App\Models\Payable;
use App\Rules\CheckDate;
use App\Models\Invoicemonth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
        ];
        return view('invoice.index',[
            'payments'=>Invoice::latest()->with('createdby')->with('member')->filter(request(['search']))->paginate(8)
        ]);
    }
    public function create(Request $request)
    {
        
        $member=collect();
        if((isset($request['search'])&&$request['search'])){
        $model= new Members;
        $member=$model->where('phone',$request->get('search'))->orWhere('flat_no',$request->get('search'))->where('status',1)->with('payable')->first();
        }
        if($member==null){
            $message="No member found or No member is active";
        }
        else{
            $message='';
        }
        $users = User::count();
        // dd($member);
        $widget = [
            'users' => $users,
        ];


        
        return view('invoice.create',[
            'member'=>$member,
            'message'=>$message,
            'request'=>$request,
            $widget
        ]);
    }

    public function store(Request $request,Members $member){
        $formfeilds=$request->validate([
            'amount'=>'required|integer',
            'balance'=>'',
            'flat_no'=>'',
            'note'=>'required',
            'created_by'=>''
        ]);
       
            $formfeilds['member_id']=$member->id;
            $formfeilds['invoice_id']=Carbon::now()->timestamp;
            $formfeilds['created_by']= Auth::user()->id;

            $invoice=Invoice::create($formfeilds);

        if(array_key_exists('balance', $formfeilds)&&$formfeilds['balance']!=''){
            $member->balance=(int)$member->balance-(int)$request->amount;
            if($member->balance<0){
                $member->balance=0;
            }
            $updateOnMember=[
                'id'=>$member->id,
                'balance'=>$member->balance,
            ];
    
            $member->update($updateOnMember);
            $payables=Payable::where(['id'=>$formfeilds['balance']])->first();
            $payables->remaining=(int)$payables->remaining-(int)$formfeilds['amount'];
            $is_payed=0;
            if($payables->remaining<=0){
                $payables->remaining=0;
                $is_payed=1;
            }
            $payables->update([
                'id'=>$payables->id,
                'remaining'=>$payables->remaining,
                'is_payed'=>$is_payed,
            ]);

            $invoice->payable()->attach($payables->id);
        }

        return redirect('/invoice')->with('message','Invoice has been added');
    }
}
