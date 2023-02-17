<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accessory(){
      return $this->belongsTo('App\Models\Accessory');
    }
    
}
