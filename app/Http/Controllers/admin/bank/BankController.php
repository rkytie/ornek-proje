<?php

namespace App\Http\Controllers\admin\bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Bank;
use App\Helper\ImageUploadHelper;


class BankController extends Controller
{
    public function index()
    {
        $banks =  Bank::orderBy("id", "desc")->get();

        return view("admin.bank.index", compact("banks"));
    }


    public function create()
    {
        return view("admin.bank.create");
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

      $validated = $request->validate([
        'name' => 'required',
        'photo' => 'required',
        'status' => "required",
        'ordering' => "required"
      ]);

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "banks", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
      if($validated){
        $newSlider = Bank::create($data);
        if ($newSlider) {
            return redirect()->route("admin.banks.index")->with('success', 'Banka başarılı bir şekilde eklendi.');
        }
      }
      return redirect()->back()->with('error', 'Banka kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view("admin.slider.edit", compact("slider"));
    }

    public function update(Request $request)
    {

    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        deleteImage($brand->photo);

        $delete = $brand->delete();

        if ($delete) {
            $result["success"] = "Marka başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Marka silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
