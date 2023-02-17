<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id'
       ];

    public function order_items()
    {
      return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function order_items_wing()
    {
      return $this->hasMany('App\Models\OrderItemWing', 'order_id');
    }
}

