<?php

namespace App\Http\Controllers\admin\pvc;

use App\Models\Pvc;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\Auth;

class PvcController extends Controller
{
    public function index()
    {
        $pvcs =  Pvc::orderBy("id", "desc")->get();
        return view("admin.pvc.index", compact("pvcs"));
    }


    public function create()
    {
        return view("admin.pvc.create");
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "pvcs", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
        $newProduct = Pvc::create($data);
        if ($newProduct) {
            return redirect()->route("admin.pvcs.index")->with('success', 'PVC başarılı bir şekilde eklendi.');
        }
      return redirect()->back()->with('error', 'PVC ekleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $pvc = Pvc::findOrFail($id);
        return view("admin.pvc.edit", compact("pvc"));
    }

    public function update(Request $request)
    {

      $id = $request->route('pvc');
      $content = Pvc::findOrFail($id);
      $data = $request->except('_token');
      

      if (isset($data['photo'])) {
            $data['photo'] = ImageUploadHelper::upload(rand(1, 9000), "pvcs", $data['photo']);
    }

    $update = $content->update($data);

      if ($update) {
        
          return back()->with('success', 'PVC  başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'PVC güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = Pvc::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "PVC başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "PVC sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
