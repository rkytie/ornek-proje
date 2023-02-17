<?php

namespace App\Http\Controllers\admin\slat;

use App\Models\Slat;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\Auth;

class SlatController extends Controller
{
    public function index()
    {
        $slats =  Slat::orderBy("id", "desc")->get();
        return view("admin.slat.index", compact("slats"));
    }


    public function create()
    {
        return view("admin.slat.create");
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "slats", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
        $newProduct = Slat::create($data);
        if ($newProduct) {
            return redirect()->route("admin.slats.index")->with('success', 'Çıta başarılı bir şekilde eklendi.');
        }
      return redirect()->back()->with('error', 'Çıta ekleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slat = Slat::findOrFail($id);
        return view("admin.slat.edit", compact("slat"));
    }

    public function update(Request $request)
    {

      $id = $request->route('slat');
      $content = Slat::findOrFail($id);
      $data = $request->except('_token');
      

      if (isset($data['photo'])) {
            $data['photo'] = ImageUploadHelper::upload(rand(1, 9000), "slats", $data['photo']);
    }

    $update = $content->update($data);

      if ($update) {
        
          return back()->with('success', 'Çıta  başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'Çıta güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = Slat::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "Çıta başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "Çıta sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
