<?php

namespace App\Models;

use App\Models\Payable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Members extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'phone', 'flat_no', 'balance','status'
    ];

    public function Scopefilter($query , array $filters){
        if($filters['search']??false){
            $query->where('first_name','like', '%'. request('search') . '%')
            ->orWhere('last_name','like', '%'. request('search') . '%')
            ->orWhere('flat_no','like', '%'. request('search') . '%');
        }
    }

    public function paymet(){   
        return $this->hasMany(Invoice::class,'member_id');
    }

    public function payable(){   
        return $this->hasMany(Payable::class,'member_id');
    }
}
