<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kinds(){
        return $this->hasMany('App\Models\Kind');
      }
}
     