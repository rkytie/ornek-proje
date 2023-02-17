<?php

namespace App\Http\Controllers\admin\color;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function index()
    {
        $colors =  Color::orderBy("id", "desc")->get();
        return view("admin.color.index", compact("colors"));
    }


    public function create()
    {
        return view("admin.color.create");
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "colors", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
        $newProduct = Color::create($data);
        if ($newProduct) {
            return redirect()->route("admin.colors.index")->with('success', 'Renk başarılı bir şekilde eklendi.');
        }
      return redirect()->back()->with('error', 'Renk kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $color = Color::findOrFail($id);
        return view("admin.color.edit", compact("color"));
    }

    public function update(Request $request)
    {

      $id = $request->route('color');
      $content = Color::findOrFail($id);
      $data = $request->except('_token');
      if (isset($data['photo'])) {
            deleteImage($content->photo);
                $data['photo'] = ImageUploadHelper::upload(rand(1, 9000), "colors", $data['photo']);
        }
      $update = $content->update($data);
      
      if ($update) {
        
          return back()->with('success', 'Renk başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'Renk güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = Color::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "Renk başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "Renk silme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
