<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHaveKind extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product(){
      return $this->belongsTo('App\Models\Product');
    }

    public function kind(){
      return $this->belongsTo('App\Models\Kind');
    }
}
