<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Members;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function generateInvoicePDF(Members $member,Invoice $payment)
    {
        
        $pdf=app('dompdf.wrapper');
        // $payables=$payment->with('payable')->get();
        $payments=$payment->where('id',$payment->id)->with('payable')->first();
        $pdf->loadView('pdf',[
            'member'=>$member,
            'payment'=>$payments,
            'payables'=>$payment->payable
        ]);
        return  $pdf->download('invoice.pdf');
    }

    public function generateReportPDF(Members $member)
    {
        
        $pdf=app('dompdf.wrapper');
        // $payables=$payment->with('payable')->get();
        $payments=Invoice::where('member_id',$member->id)->with('payable')->get();

        $pdf->loadView('report',[
            'member'=>$member,
            'Payments'=>$payments,
        ]);
        return  $pdf->download('flatNo'.$member->flat_no.'Name:'.$member->first_name.' report.pdf');
    }
    
}
