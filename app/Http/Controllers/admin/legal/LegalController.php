<?php

namespace App\Http\Controllers\admin\legal;

use App\Models\Law;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LegalController extends Controller
{
    public function index()
    {
        $legals =  Law::orderBy("id", "desc")->get();
        return view("admin.legal.index", compact("legals"));
    }


    public function create()
    {
        return view("admin.legal.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request56789
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $data = $request->except("_token");

        $newContent = Law::create($data);

        if ($newContent) {
            return redirect()->route("admin.legals.index")->with('success', 'Yasa başarılı bir şekilde eklendi.');
        }

        return redirect()->back()->with('error', 'Yasa sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $legal = Law::findOrFail($id);
        return view("admin.legal.edit", compact("legal"));
    }

    public function update(Request $request)
    {

      $id = $request->route('legal');
      $content = Law::findOrFail($id);
      $data = $request->except('_token');
      $update = $content->update($data);
      if ($update) {
          return redirect()->route('admin.legals.index')->with('success', 'Yasa başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'Yasa güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $content = Law::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "Yasa başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "Yasa silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
