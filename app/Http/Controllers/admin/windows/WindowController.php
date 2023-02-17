<?php

namespace App\Http\Controllers\admin\window;

use App\Models\Window;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ImageUploadHelper;
use Illuminate\Support\Facades\Auth;

class WindowController extends Controller
{
    public function index()
    {
        $windows =  Window::orderBy("id", "desc")->get();
        return view("admin.window.index", compact("windows"));
    }


    public function create()
    {
        return view("admin.window.create");
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "windows", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
        $newProduct = Window::create($data);
        if ($newProduct) {
            return redirect()->route("admin.windows.index")->with('success', 'Pencere başarılı bir şekilde eklendi.');
        }
      return redirect()->back()->with('error', 'Pencere Çeşidi sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $window = Windows::findOrFail($id);
        return view("admin.window.edit", compact("window"));
    }

    public function update(Request $request)
    {

      $id = $request->route('window');
      $content = Window::findOrFail($id);
      $data = $request->except('_token');
      $update = $content->update($data);
      if ($update) {
        
          return back()->with('success', 'Pencere çeşidi başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'Pencere güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = Window::findOrFail($id);

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
