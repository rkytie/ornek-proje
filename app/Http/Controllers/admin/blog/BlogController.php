<?php

namespace App\Http\Controllers\admin\blog;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs =  Blog::orderBy("id", "desc")->get();
        return view("admin.blog.index", compact("blogs"));
    }


    public function create()
    {
        return view("admin.blog.create");
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

        $newContent = Blog::create($data);

        if ($newContent) {
            return redirect()->route("admin.blogs.index")->with('success', 'Blog başarılı bir şekilde eklendi.');
        }

        return redirect()->back()->with('error', 'Blog sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view("admin.blog.edit", compact("blog"));
    }

    public function update(Request $request)
    {

      $id = $request->route('blog');
      $content = Blog::findOrFail($id);
      $data = $request->except('_token');
      $update = $content->update($data);
      if ($update) {
        
          return back()->with('success', 'Blog başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'Blog güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = Blog::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "Blog başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "Blog silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
