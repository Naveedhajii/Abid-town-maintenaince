<?php

namespace App\Rules;

use App\Models\Members;
use Illuminate\Contracts\Validation\InvokableRule;

class Checkstatus implements InvokableRule
{
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
        $member=Members::where('flat_no',$value)->get();
        foreach ($member as $member) {
            if($member->status==1){
                $fail('This Flat No already has active member');
            }
        }
    }
}
