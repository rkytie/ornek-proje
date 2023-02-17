<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'project_id'];

    public function floors(){
      return $this->hasMany('App\Models\Floor');
    }

    public function project(){
      return $this->belongsTo('App\Models\Project');
    }

}
