<?php

namespace App\Http\Controllers\admin\glass_feature;

use App\Models\GlassFeature;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\Auth;

class GlassFeatureController extends Controller
{
    public function index()
    {
        $features =  GlassFeature::orderBy("id", "desc")->get();
        return view("admin.glassfeature.index", compact("features"));
    }


    public function create()
    {
        return view("admin.glassfeature.create");
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "glass_features", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
        $newProduct = GlassFeature::create($data);
        if ($newProduct) {
            return redirect()->route("admin.glass-features.index")->with('success', 'Pencere başarılı bir şekilde eklendi.');
        }
      return redirect()->back()->with('error', 'Pencere Çeşidi sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $glass_feature = GlassFeature::findOrFail($id);
        return view("admin.glassfeature.edit", compact("glass_feature"));
    }

    public function update(Request $request)
    {

      $id = $request->route('window');
      $content = GlassFeature::findOrFail($id);
      $data = $request->except('_token');
      $update = $content->update($data);
      if ($update) {
        
          return back()->with('success', 'Pencere çeşidi başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'Pencere güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = GlassFeature::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "Pencere çeşidi başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "Pencere çeşidi sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
