<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['name', 'number', 'room_id', 'description', 'floor_id', 'type_id', 'facade_id', 'price', 'square', 'gross_square', 'status_id'];

    public function floor(){
      return $this->belongsTo('App\Models\Floor');
    }

    public function room(){
      return $this->belongsTo('App\Models\Room');
    }

    public function type(){
      return $this->belongsTo('App\Models\Type');
    }

    public function facade(){
      return $this->belongsTo('App\Models\Facade');
    }

    public function status(){
      return $this->belongsTo('App\Models\Status');
    }

    public function InteriorFeature(){
      return $this->belongsToMany('App\Models\InteriorFeature');
    }

    public function ExteriorFeature(){
      return $this->belongsToMany('App\Models\ExteriorFeature');
    }

    public function ApartmentPriceHistory(){
      return $this->hasMany('App\Models\ApartmentPriceHistory');
    }
}
