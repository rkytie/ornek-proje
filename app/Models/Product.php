<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
      return $this->belongsTo('App\Models\Category');
    }

    public function brand(){
      return $this->belongsTo('App\Models\Brand');
    }

    public function user(){
      return $this->belongsTo('App\Models\User');
    }

    public function kinds(){
      return $this->belongsToMany('App\Models\Kind');
    }

    public function pvc_default(){
      return $this->belongsTo('App\Models\Pvc', 'pvc_id', 'id');
    }

    public function window_default(){
      return $this->belongsTo('App\Models\Window', 'window_id', 'id');
    }

    public function slat_default(){
      return $this->belongsTo('App\Models\Slat', 'slat_id', 'id');
    }

    public function handle_default(){
      return $this->belongsTo('App\Models\Handle', 'handle_id', 'id');
    }

    public function color_default(){
      return $this->belongsTo('App\Models\Color', 'color_id', 'id');
    }

    public function glass_feature_default(){
      return $this->belongsTo('App\Models\GlassFeature', 'glass_feature_id', 'id');
    }

    public function pvc(){
      return $this->belongsToMany('App\Models\Pvc');
    }

    public function slat(){
      return $this->belongsToMany('App\Models\Slat');
    }

    public function window(){
      return $this->belongsToMany('App\Models\Window');
    }

    public function handle(){
      return $this->belongsToMany('App\Models\Handle');
    }

    public function wings(){
      return $this->belongsToMany('App\Models\Wing');
    }

    public function color(){
      return $this->belongsToMany('App\Models\Color');
    }

    public function glass_feature(){
      return $this->belongsToMany('App\Models\GlassFeature');
    }

    public function images()
    {
      return $this->hasMany('App\Models\Image', 'product_id');
    }
}
