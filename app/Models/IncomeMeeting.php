<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeMeeting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, "customer_id");
    }

    public function getDateAttribute()
    {
        return  date("Y-m-d", strtotime($this->date_time));
    }

    public function getTimeAttribute()
    {
        return date("H:i", strtotime($this->date_time));
    }
}
