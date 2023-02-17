<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreInformation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
      return $this->belongsTo('App\Models\User');
    }

}
