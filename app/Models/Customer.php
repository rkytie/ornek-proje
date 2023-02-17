<?php

namespace App\Models;

use App\Helper\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory,Address;

    protected $guarded = [];

    public function scopeEmails()
    {
        return Customer::pluck("email")->toArray();
    }

    public function documents()
    {
        return $this->hasMany(CustomerDocument::class, "client_id");
    }


    public function other_info()
    {
        return $this->hasOne(CustomerOtherInfo::class,"customer_id");
    }

    public function notes(){
        return $this->hasMany(CustomerNote::class,"customer_id");
    }

    public function meetings(){
        return $this->hasMany(Meeting::class,"customer_id");
    }

    public function getFullNameAttribute()
    {
        return ucfirst("{$this->name} {$this->surname}");
    }

    public function Projects(){
      return $this->belongsToMany('App\Models\Project');
    }
}
