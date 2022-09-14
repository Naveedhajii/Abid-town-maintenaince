<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Members;
use App\Models\Payable;
use App\Rules\Checkstatus;
use Illuminate\Http\Request;
use App\Models\Creationdates;
use App\Rules\Checkstatusedit;
use Illuminate\Validation\Rule;

class MembersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
        ];

        return view('members.index',[
            'members'=>Members::latest()->filter(request(['search']))->paginate(10),
        ]);
    }


    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('m-Y');
    }


    public function createMember(Request $request){
        $formFields= $request->validate([
            'first_name'=> 'required',
            'last_name'=> ['required'],
            'phone'=>['required',Rule::unique('members','phone'),'min:11','max:11'],
            'flat_no'=>['required',new Checkstatus],
            'balance'=>['required',]
        ]);
        // Rule::unique('members','flat_no')
        $formFields['status']=1;
        
        $member=Members::create($formFields);

        $Addbalance=([
            'member_id'=>$member->id,
            'is_payed'=>0,
            'amount'=>$member->balance,
            'remaining'=>$member->balance,
            'name'=>'Balance before September 2022',
        ]);
        Payable::create($Addbalance);

        return redirect('/members')->with('message','Member added successfully.');
        
    }
    public function create()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
        ];

        return view('members.create', compact('widget'));
    }

    public function edit(Members $member)
    {
        return view('members.edit', ['member'=>$member]);
    }

    public function update(Request $request,Members $member){
        $formFields= $request->validate([
            'first_name'=> 'required',
            'last_name'=> ['required'],
            'phone'=>['required'],
            'flat_no'=>['required'],
            'balance'=>['required',],
            'status'=>[new Checkstatusedit]
        ]);

        $member->update($formFields);

        return redirect('/members')->with('message','Member has been updated');
        
    }

    public function changeStatus(Members $member){
        if($member->status==0){
            $member->status=1;
        }
        else{
            $member->status=0;
        }
        $member->update([
            'id'=>$member->id,
            'status'=>$member->status
        ]);
        return redirect('/members');
    }

    public function delete(Members $member){
        $member->delete();

        return redirect('/members');
    }

    public function restore(Members $member){
        Members::withTrashed()->where('id', 3)->restore();
        return redirect('/members');
    }

}
