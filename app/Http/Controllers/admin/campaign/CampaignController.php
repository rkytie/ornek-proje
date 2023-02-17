<?php

namespace App\Http\Controllers\admin\campaign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Campaign;
use App\Helper\ImageUploadHelper;


class CampaignController extends Controller
{
    public function index()
    {
        $campaigns =  Campaign::orderBy("id", "desc")->get();

        return view("admin.campaign.index", compact("campaigns"));
    }


    public function create()
    {
        return view("admin.campaign.create");
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

      $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "campaigns", $request->photo) : "";
      $request->photo = $image;
      $data['photo'] = $image;
      if($validated){
        $newCampaign = Campaign::create($data);
        if ($newCampaign) {
            return redirect()->route("admin.campaigns.index")->with('success', 'Kampanya başarılı bir şekilde eklendi.');
        }
      }
      return redirect()->back()->with('error', 'Kampanya kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
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
        $campaign = Campaign::findOrFail($id);
        deleteImage($campaign->photo);

        $delete = $campaign->delete();

        if ($delete) {
            $result["success"] = "Kampanya başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Kampanya silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
