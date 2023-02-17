<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHandle extends Model
{
    use HasFactory;

    protected $table = 'product_handle';

    protected $guarded = [];

    public function product(){
      return $this->belongsTo('App\Models\Product');
    }

    public function handle(){
      return $this->belongsTo('App\Models\Handle');
    }
}
