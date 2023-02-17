<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer(){
      return $this->belongsTo('App\Models\Customer');
    }

    public function apartment(){
      return $this->belongsTo('App\Models\Apartment');
    }

    public function BidStatus(){
      return $this->belongsTo('App\Models\BidStatus');
    }

    public function user(){
      return $this->belongsTo('App\Models\User');
    }
}
