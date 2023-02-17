<?php

namespace App\Models;

use App\Models\District;
use App\Models\Province;
use App\Models\Neighborhood;
use App\Models\ApartmentFacade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertisement extends Model
{
  use HasFactory;

  protected $table = "advertisements";

  protected $guarded = [];

  public function apartment_facades()
  {
    return $this->hasMany(ApartmentFacade::class, "advertissement_id");
  }

  public function get_province()
  {
    return $this->hasOne(Province::class, "province_key", "province");
  }

  public function get_district()
  {
    return $this->hasOne(District::class, "district_key", "district");
  }

  public function get_neighborhood()
  {
    return $this->hasOne(Neighborhood::class, "neighborhood_key", "neighborhood");
  }

  public function track_advertissements()
  {
    return $this->hasMany(TrackAdvertissement::class, "advertissement_id");
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function visitors()
  {
    return $this->hasMany(Visitor::class, "advertissement_id");
  }

  public function getFullAddressAttribute()
  {
    $neighborhood = $this->get_neighborhood->neighborhood_name;
    $district = $this->get_district->district_name;
    $province = $this->get_province->province_name;
    $fullAddress = "$neighborhood Mahalessi, $district, $province";

    return Str::lower($fullAddress);
  }

  public function getPropertyTypeValueAttribute()
  {
    $property_type = null;

    if ($this->property_type) {
      switch ($this->property_type) {
        case '1':
          $property_type = ' <span class="badge badge-primary text-capitalize mb-2">Daire</span>';
          break;
        case '2':
          $property_type = ' <span class="badge badge-info text-capitalize mb-2">Dükkan</span>';
          break;
        case '3':
          $property_type = ' <span class="badge badge-warning text-capitalize mb-2">Ofis</span>';
          break;
      }
    }

    return $property_type;
  }

  function getIsSaleOrRentAttribute()
  {
    $type = $this->sale_or_rent;

    switch ($type) {
      case '1':
        $type = "Satılık";
        break;
      case '2':
        $type = "Satılık";
        break;
      default:
        $type = "Belirlenmemiş";
        break;
    }
    return $type;
  }
}
