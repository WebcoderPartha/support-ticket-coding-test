<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Customer Relation
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    // Admin Relation
    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

}
