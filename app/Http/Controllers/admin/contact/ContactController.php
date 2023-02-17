<?php

namespace App\Http\Controllers\admin\contact;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contacts =  Contact::orderBy("id", "desc")->get();

        return view("admin.contact.index", compact("contacts"));
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail(1);
        return view("admin.contact.edit", compact("contact"));
    }

    public function update(Request $request)
    {

      $id = $request->route('contact');
      $contact = Contact::findOrFail($id);
      $data = $request->except('_token');
      $update = $contact->update($data);

      if ($update) {
          return back()->with('success', 'İletişim başarılı bir şekilde güncellendi.');
      }
      return redirect()->back()->with('error', 'İletişim Tipi güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');

    }


    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        $delete = $room->delete();

        if ($delete) {
            $result["success"] = "Oda başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Oda silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
