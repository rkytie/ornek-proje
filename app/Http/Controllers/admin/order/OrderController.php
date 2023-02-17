<?php

namespace App\Http\Controllers\admin\order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders =  Order::orderBy("id", "desc")->get();
        return view("admin.order.index", compact("orders"));
    }


    public function create()
    {
        return view("admin.accessory.create");
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

        $newContent = Accessory::create($data);

        if ($newContent) {
            return redirect()->route("admin.accessories.index")->with('success', 'Aksesuar kategorisi başarılı bir şekilde eklendi.');
        }

        return redirect()->back()->with('error', 'Aksesuar kategorisi sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $accessory = Accessory::findOrFail($id);
        return view("admin.accessory.edit", compact("accessory"));
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
        $content = Accessory::findOrFail($id);

        $delete = $content->delete();

        if ($delete) {
            $result["success"] = "Aksesuar kategorisi başarılı bir şekilde silindi.";
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = "Aksesuar kategorisi sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
