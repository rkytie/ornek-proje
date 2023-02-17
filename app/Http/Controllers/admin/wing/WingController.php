<?php

namespace App\Http\Controllers\admin\wing;

use App\Models\Wing;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\Auth;

class WingController extends Controller
{
    public function index()
    {
        $wings =  Wing::orderBy("id", "desc")->get();
        return view("admin.wing.index", compact("wings"));
    }


    public function create()
    {
        return view("admin.wing.create");
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "wings", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
        $newProduct = Wing::create($data);
        if ($newProduct) {
            return redirect()->route("admin.wings.index")->with('success', 'Kanat başarılı bir şekilde eklendi.');
        }
      return redirect()->back()->with('error', 'Kanat kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $wing = Wing::findOrFail($id);
        return view("admin.wing.edit", compact("wing"));
    }

    public function update(Request $request)
    {

        $id = $request->route('wing');
        $wing = Wing::findOrFail($id);
        $data = $request->except('_token');
        $update = $wing->update($data);
        if (isset($data['photo'])) {
            deleteImage($wing->photo);
                $data['photo'] = ImageUploadHelper::upload(rand(1, 9000), "wings", $data['photo']);
        }
        if ($update) {
          
            return back()->with('success', 'Kanat başarılı bir şekilde güncellendi.');
        }
        return redirect()->back()->with('error', 'Kanat güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');
  
    }


    public function destroy($id)
    {
        $content = Wing::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "Kanat başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "Kanat silme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
