<?php

namespace App\Http\Controllers\admin\handle;

use App\Models\Handle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\Auth;

class HandleController extends Controller
{
    public function index()
    {
        $handles =  Handle::orderBy("id", "desc")->get();
        return view("admin.handle.index", compact("handles"));
    }


    public function create()
    {
        return view("admin.handle.create");
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "handles", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
        $newProduct = Handle::create($data);
        if ($newProduct) {
            return redirect()->route("admin.handles.index")->with('success', 'Kulp başarılı bir şekilde eklendi.');
        }
      return redirect()->back()->with('error', 'Kulp kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $handle = Handle::findOrFail($id);
        return view("admin.handle.edit", compact("handle"));
    }

    public function update(Request $request)
    {

      $id = $request->route('handle');
      $content = Handle::findOrFail($id);
      $data = $request->except('_token');
      $update = $content->update($data);
      if ($update) {
        
          return back()->with('success', 'Kulp başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'Kulp güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = Handle::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "Kulp başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "Kulp sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
