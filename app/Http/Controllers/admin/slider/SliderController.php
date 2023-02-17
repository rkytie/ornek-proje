<?php

namespace App\Http\Controllers\admin\slider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;
use App\Helper\ImageUploadHelper;


class SliderController extends Controller
{
    public function index()
    {
        $sliders =  Slider::orderBy("id", "desc")->get();

        return view("admin.slider.index", compact("sliders"));
    }


    public function create()
    {
        return view("admin.slider.create");
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
        'link' => "required",
        'ordering' => "required"
      ]);

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "sliders", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
      if($validated){
        $newSlider = Slider::create($data);
        if ($newSlider) {
            return redirect()->route("admin.sliders.index")->with('success', 'Slider başarılı bir şekilde eklendi.');
        }
      }
      return redirect()->back()->with('error', 'Slider kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
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
        $slider = Slider::findOrFail($id);
        deleteImage($slider->photo);

        $delete = $slider->delete();

        if ($delete) {
            $result["success"] = "Slider başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Slider silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
