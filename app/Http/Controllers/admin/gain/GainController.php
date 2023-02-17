<?php

namespace App\Http\Controllers\admin\gain;

use App\Models\Category;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GainController extends Controller
{
    public function index()
    {

        return view("admin.gain.index");
    }

}
