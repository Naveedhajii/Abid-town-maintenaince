<?php

namespace App\Models;

use App\Models\Members;
use App\Models\Payable;
use App\Models\Invoicemonth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'amount','invoice_id','note','created_by'
    ];

    public function member(){
        return $this->belongsTo(Members::class, 'member_id');
    }

    public function Scopefilter( $query , array $filters ){

        if(isset($filters['search']) && $filters['search']){
            $GLOBALS['search']=$filters['search'];
            $query->whereHas('member',function($q){
                $q->where('first_name','like', '%'. request('search') . '%')->
                orWhere('flat_no','like','%'.request('search').'%')->
                orWhere('flat_no','like','%'.$GLOBALS['search'].'%')->
                orWhere('phone','like','%'.request('search').'%');
            })->orWhere('invoice_id',request('search'));
        }
        if(isset($filters['flat_no']) && $filters['flat_no']){
            $GLOBALS['flat_no']=$filters['flat_no'];
            $query->whereHas('member',function($q){
                $q->where('flat_no','like','%'.$GLOBALS['flat_no'].'%');
            });
        }

    }

    public function payable(){
        return $this->belongsToMany(Payable::class);
    }
    
    public function createdby(){
        return $this->belongsTo(User::class,'created_by');
    }

}

