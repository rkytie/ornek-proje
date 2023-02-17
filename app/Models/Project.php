<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function blocks(){
      return $this->hasMany('App\Models\Block');
    }

    public function customers(){
      return $this->BelongsToMany('App\Models\Customer');
    }
}
