<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer(){
      return $this->belongsTo('App\Models\Customer');
    }

    public function apartment(){
      return $this->belongsTo('App\Models\Apartment');
    }


    public function user(){
      return $this->belongsTo('App\Models\User');
    }
}
