<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentPriceHistory extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'apartment_id'];


    public function apartment(){
      return $this->belongsTo('App\Models\Apartment');
    }
}
