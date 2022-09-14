<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payable extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'is_payed', 'name', 'amount', 'remaining'
    ];

    public function member(){
        return $this->belongsTo(Members::class, 'member_id');
    }

    public function invoice(){
        return $this->belongsToMany(Invoice::class);
    }
    
    
}
