<?php

namespace App\Http\Controllers\admin\kind;

use App\Models\Kind;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\Auth;

class KindController extends Controller
{
    public function index()
    {
        $kinds =  Kind::orderBy("id", "desc")->get();
        return view("admin.kind.index", compact("kinds"));
    }


    public function create()
    {
        $accessories =  Accessory::orderBy("id", "desc")->get();
        return view("admin.kind.create", ['accessories' => $accessories]);
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "kinds", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
        $newProduct = Kind::create($data);
        if ($newProduct) {
            return redirect()->route("admin.kinds.index")->with('success', 'Aksesuar Çeşidi bir şekilde eklendi.');
        }
      return redirect()->back()->with('error', 'Aksesuar Çeşidi sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kind = Kind::findOrFail($id);
        return view("admin.kind.edit", compact("kind"));
    }

    public function update(Request $request)
    {

      $id = $request->route('kind');
      $content = Kind::findOrFail($id);
      $data = $request->except('_token');
      $update = $content->update($data);
      if ($update) {
        
          return back()->with('success', 'Aksesuar çeşidi başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'Aksesuar çeşidi güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = Kind::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "Aksesuar çeşidi başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "Aksesuar çeşidi sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
