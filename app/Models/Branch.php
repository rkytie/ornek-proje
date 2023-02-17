<?php

namespace App\Models;

use App\Helper\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory, Address;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class,"branch_users");
    }
}
