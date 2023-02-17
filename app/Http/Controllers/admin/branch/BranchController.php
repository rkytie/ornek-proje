<?php

namespace App\Http\Controllers\admin\branch;

use App\Models\Branch;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        $branchs =  Branch::orderBy("id", "desc")->get();

        return view("admin.branch.index", compact("branchs"));
    }

    public function my_branchs()
    {
        $branchs = Auth::user()->branchs;

        return view("admin.branch.my-branch", compact("branchs"));
    }


    public function create()
    {
        return view("admin.branch.create");
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

        $newBranch = Branch::create($data);

        Auth::user()->branchs()->attach($newBranch->id);

        if ($newBranch) {
            return redirect()->route("admin.branchs.my_branchs")->with('success', 'Şübe başarılı bir şekilde eklendi.');
        }

        return redirect()->back()->with('error', 'Şübe kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view("admin.branch.edit", compact("branch"));
    }

    public function update(Request $request)
    {
        $id = $request->route('branch');
        $branch = Branch::findOrFail($id);
        $allEmails = Branch::pluck("email")->toArray();

        $data = $request->except('_token');

        if ($branch->email !== $data["email"] && in_array($data["email"], $allEmails)) {
            return back()->with("errorEmail", "Sistemde seçtiğiniz e-posta var. Lütfen başka e-postayı girin.");
        }


        $update = $branch->update($data);

        if ($update) {
            return redirect()->route("admin.manager.index")->with('success', 'Şübe başarılı bir şekilde güncellendi.');
        }

        return redirect()->back()->with('error', 'Şübe güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');
    }


    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        deleteImage($branch->image);

        $delete = $branch->delete();
        $result = [];


        if ($delete) {
            $result["success"] = "Şübe başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Şübe silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
