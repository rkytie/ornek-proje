<?php

namespace App\Http\Controllers\admin\discount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Discount;
use App\Helper\ImageUploadHelper;


class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::orderBy("id", "desc")->get();

        return view("admin.discount.index", compact("discounts"));
    }


    public function create()
    {
        return view("admin.discount.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
      $data = $request->except("_token");

      $validated = $request->validate([
        'name' => 'required',
        'photo' => 'required',
        'status' => "required",
        'ordering' => "required"
      ]);

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "discounts", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
      if($validated){
        $newDiscount = Discount::create($data);
        if ($newDiscount) {
            return redirect()->route("admin.discounts.index")->with('success', 'İndirim başarılı bir şekilde eklendi.');
        }
      }
      return redirect()->back()->with('error', 'İndirim kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        return view("admin.discount.edit", compact("discount"));
    }

    public function update(Request $request)
    {

    }


    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        deleteImage($discount->photo);

        $delete = $discount->delete();

        if ($delete) {
            $result["success"] = "İndirim başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "İndirim silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
