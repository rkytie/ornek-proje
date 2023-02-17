<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentHaveInterior extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function apartment(){
      return $this->belongsTo('App\Models\Apartment');
    }

    public function InteriorFeature(){
      return $this->belongsTo('App\Models\InteriorFeature');
    }
}
