<?php

namespace App\Http\Controllers\admin\content;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function index()
    {
        $contents =  Content::orderBy("id", "desc")->get();
        return view("admin.content.index", compact("contents"));
    }


    public function create()
    {
        return view("admin.content.create");
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

        $newContent = Content::create($data);

        if ($newContent) {
            return redirect()->route("admin.contents.index")->with('success', 'İçerik başarılı bir şekilde eklendi.');
        }

        return redirect()->back()->with('error', 'İçerik sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view("admin.room.edit", compact("room"));
    }

    public function update(Request $request)
    {

      $id = $request->route('content');
      $content = Content::findOrFail($id);
      $data = $request->except('_token');
      $update = $content->update($data);
      if ($update) {
        
          return back()->with('success', 'Oda Tipi başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'Oda Tipi güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = Content::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "İçerik başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "İçerik silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
