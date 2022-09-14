<?php

namespace App\Rules;

use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class CheckDate implements DataAwareRule,InvokableRule
{
       /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];
 
    // ...
 
    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
    }
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $this->data['month']=explode(',',$this->data['month']);

        
        $Payments=Invoice::filter(['flat_no'=>$this->data['flat_no']])->with('member')->with('invoicemonth')->get();

        $i=0;


        foreach($this->data['month'] as $month){
            $MonthOnField=Carbon::createFromFormat('m-Y', $this->data['month'][$i]);
            $MonthOnField=$MonthOnField->startOfMonth();
            foreach ($Payments as $payment) {
                foreach($payment->invoicemonth as $paymentmonth){
                    $monthOnPayment=Carbon::createFromFormat('Y-m-d', $paymentmonth->month);
                    $monthOnPayment=$monthOnPayment->startOfMonth();
                    
                    if($monthOnPayment==$MonthOnField){
                        $fail('this flat/house has already paid for '.$MonthOnField->format('m-Y'));
                    }
                }
            }
            $i++;
            
        }
        
    }
}