<?php

namespace App\Rules;

use App\Models\Members;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class Checkstatusedit implements DataAwareRule, InvokableRule
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
        $member=Members::where('flat_no',$this->data['flat_no'])->get();
        foreach ($member as $member) {
            if($member->status==1 && $member->phone != $this->data['phone']&&$value==1){
                $fail('This Flat No already has active member');
            }
        }
    }
}
