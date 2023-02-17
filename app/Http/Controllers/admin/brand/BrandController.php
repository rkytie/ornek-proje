<?php

namespace App\Http\Controllers\admin\brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Helper\ImageUploadHelper;


class BrandController extends Controller
{
    public function index()
    {
        $brands =  Brand::orderBy("id", "desc")->get();

        return view("admin.brand.index", compact("brands"));
    }


    public function create()
    {
        return view("admin.brand.create");
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "brands", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
      if($validated){
        $newSlider = Brand::create($data);
        if ($newSlider) {
            return redirect()->route("admin.brands.index")->with('success', 'Marka başarılı bir şekilde eklendi.');
        }
      }
      return redirect()->back()->with('error', 'Marka kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view("admin.slider.edit", compact("slider"));
    }

    public function update(Request $request)
    {

    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        deleteImage($brand->photo);

        $delete = $brand->delete();

        if ($delete) {
            $result["success"] = "Marka başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Marka silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
