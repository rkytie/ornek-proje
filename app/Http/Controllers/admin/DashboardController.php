<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\IncomeMeeting;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){
        $currentUser = $request->user();
        $countUser = User::where("permission","!=","1")->count();
        $countManager = User::where("permission","2")->count();
        $countStaff = User::where("permission","3")->count();




        return view("admin.index",compact("countUser","countManager","countStaff"));
    }
}
