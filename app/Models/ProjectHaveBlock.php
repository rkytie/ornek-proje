<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHaveBlock extends Model
{
    use HasFactory;

    public function project(){
      return $this->belongsTo('App\Models\Project');
    }

    public function block(){
      return $this->belongsTo('App\Models\Block');
    }
}
