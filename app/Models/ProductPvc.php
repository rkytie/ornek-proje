<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPvc extends Model
{
    use HasFactory;

    protected $table = 'product_pvc';

    protected $guarded = [];

    public function product(){
      return $this->belongsTo('App\Models\Product');
    }

    public function pvc(){
      return $this->belongsTo('App\Models\Pvc');
    }
}
