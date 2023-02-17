<?php

use App\Models\Navigation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Law;



function kaldir_sur($height=NULL, $width=NULL){

}

function blogs(){
    $blogs = Blog::get()->all();
    return $blogs;
}

function legals(){
    $legals = Law::get()->all();
    return $legals;
}



function productPriceCal($height=NULL, $width=NULL, $product_id){
    $product = Product::findorfail($product_id);

    if(empty($height)){
        $height = $product->min_height;
    }
    if(empty($width)){
        $width = $product->min_width;
    }
    if(empty($pvc)){
        $pvc = $product->pvc_default->price;
    }
    if(empty($window)){
        $window = $product->window_default->price;
    }


    $alan = ($height * $width);
    $cevre = ($product->number_of_verticals * $height) + ($product->number_of_horizontal * $width);

    $formul = (($cevre * $pvc) + ($alan * $window));
    return ( $formul);
}




function get_long_date()
{
    $date = date("d F Y");

    return convertMonthToTurkishCharacter($date);
}

function convertMonthToTurkishCharacter($date)
{
    $aylar = array(
        'January'    =>    'Ocak',
        'February'    =>    'Şubat',
        'March'        =>    'Mart',
        'April'        =>    'Nisan',
        'May'        =>    'Mayıs',
        'June'        =>    'Haziran',
        'July'        =>    'Temmuz',
        'August'    =>    'Ağustos',
        'September'    =>    'Eylül',
        'October'    =>    'Ekim',
        'November'    =>    'Kasım',
        'December'    =>    'Aralık',
        'Monday'    =>    'Pazartesi',
        'Tuesday'    =>    'Salı',
        'Wednesday'    =>    'Çarşamba',
        'Thursday'    =>    'Perşembe',
        'Friday'    =>    'Cuma',
        'Saturday'    =>    'Cumartesi',
        'Sunday'    =>    'Pazar',
        'Jan' => 'Oca',
        'Feb' => 'Şub',
        'Mar' => 'Mar',
        'Apr' => 'Nis',
        'May' => 'May',
        'Jun' => 'Haz',
        'Jul' => 'Tem',
        'Aug' => 'Ağu',
        'Sep' => 'Eyl',
        'Oct' => 'Eki',
        'Nov' => 'Kas',
        'Dec' => 'Ara'

    );
    return  strtr($date, $aylar);
}

function breadcrumburl()
{
    $url = request()->path();
    $values = str_replace("-", " ", $url);

    $values = explode("/", $values);

    return $values;
}

function getUserImage()
{
    if (Auth::check()) {
        $path = Auth::user()->image;

        if($path && file_exists($path)){
            return asset($path);
        }

        return Auth::user()->gender == 1 ? asset('assets/images/users/user-4.jpg') : asset('assets/images/users/user-9.jpg');

    }
}

function get_image($path)
{
    if (str_contains($path, "http://") || str_contains($path, "https://")) {
        return $path;
    }

    return $path && file_exists($path) ? asset($path) : false;
}

function countCart(){
  return count(Auth::user()->carts);
}

function menuCategories(){
    $categories = Category::where('category_id', NULL)->get();
    return $categories;
}

function sef_link($var){
    $linkfirst = str_replace(
      ['ü', 'Ü', 'ö', 'Ö'],
      ['u', 'U', 'o', 'O', '.', ','],
      $var);
      $seperator = "-";
      $link = Str::slug($linkfirst, $seperator);
      return $link;
  }


function getProfileImage()
{
    if (Auth::check()) {
        $path = Auth::user()->image;
        $gender = Auth::user()->gender;

        if ($path && file_exists($path)) {
            return asset($path);
        }

        switch ($gender) {
            case '1':
                $imagePath = asset("backend/images/users/mal-avatar.jpeg");
                break;
            case '2':
                $imagePath = asset("backend/images/users/femal-avatar.jpg");
                break;
            default:
                $imagePath = "https://via.placeholder.com/150";
                break;
        }

        return $imagePath;
    }
}


function generateNewUniqueId()
{
    return  (int)str_pad(rand(0, 999999999), 8, "0", STR_PAD_LEFT);
}

function format_date($date)
{
    return date("d-m-Y", strtotime($date));
}

function randomDate($start_date, $end_date)
{
    $min = strtotime($start_date);
    $max = strtotime($end_date);
    $val = rand($min, $max);
    return date('Y-m-d H:i:s', $val);
}


function getUserPermission()
{
    $permission = Auth::user()->permission;

    switch ($permission) {
        case 1:
            $permission = "admin";
            break;
        case 2:
            $permission = "manager";
            break;
        case 3:
            $permission = "staff";
            break;

        default:
            $permission = "unknown";
            break;
    }

    return $permission;
}

function deleteImage($image)
{
    if ($image && file_exists($image)) {
        unlink($image);
        return true;
    }

    return false;
}
function get_user_id()
{
    if (Auth::check()) {
        return Auth::user()->id;
    }
    return null;
}

function get_nullable_val($instance, $attribute, $return = "")
{
    return $instance && $instance->$attribute != null ? $instance->$attribute : $return;
}

function get_user_fullname()
{
    if (Auth::check()) {
        return Auth::user()->name . " " . Auth::user()->surname;
    }
    return null;
}

function get_user_name()
{
    if (Auth::check()) {
        return Auth::user()->name;
    }
    return null;
}

function getAge($entryDate)
{
    $result = null;

    if ($entryDate) {

        if (gettype($entryDate) == "object") {
            $entryDate = $entryDate->toDateString();
        }

        $entryDate = explode("-", $entryDate);

        $startDate = Carbon::createMidnightDate(date("Y"), date("m"), date("d")); //Start date
        $entryDate = Carbon::createMidnightDate($entryDate[0], $entryDate[1], $entryDate[2]); //End date

        $difference = [
            "day" => $startDate->diffInDays($entryDate),
            "weeks" => $startDate->diffInWeeks($entryDate),
            "months" => $startDate->diffInMonths($entryDate),
            "years" => $startDate->diffInYears($entryDate)
        ];

        $result = $difference["day"] . " days";

        if ($difference["years"] > 1) {
            $result = $difference["years"] . " years";
        } else if ($difference["months"] >= 1) {
            $result = $difference["months"] . " months";
        } else if ($difference["day"] > 7) {
            $result = $difference["weeks"] . " weeks";
        }
    }

    return $result;
}

function advertissement_facades()
{
    return [
        "1" => "Kuzey",
        "2" => "Güney",
        "3" => "Doğu",
        "4" => "Batı",
        "5" => "KuzeyDoğu",
        "6" => "KuzeyBatı",
        "7" => "GüneyDoğu",
        "8" => "GüneyBatı",
    ];
}

function get_advertisement_price($advertisement)
{
    $price = null;

    if ($advertisement != null) {
        if ($advertisement['sale_or_rent'] == 1 && $advertisement['sale_price'] != null) {
            $price = $advertisement['sale_price'] . " ₺";
        } elseif ($advertisement['sale_or_rent'] == 2 && $advertisement['rental_price'] != null) {
            $price = $advertisement['rental_price'] . " ₺";
        } else {
            $price = "Fiyat belirtilmemiş";
        }
    }

    return $price;
}
