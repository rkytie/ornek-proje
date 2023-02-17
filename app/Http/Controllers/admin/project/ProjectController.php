<?php

namespace App\Http\Controllers\admin\project;

use App\Models\Project;
use App\Models\Block;
use App\Models\Type;
use App\Models\Apartment;
use App\Models\User;
use App\Models\Facade;
use App\Models\Status;
use App\Models\Room;
use App\Models\Province;
use App\Models\ExteriorFeature;
use App\Models\InteriorFeature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helper\ImageUploadHelper;


class ProjectController extends Controller
{
    public function index()
    {
        $projects =  Project::orderBy("id", "desc")->get();

        return view("admin.project.index", compact("projects"));
    }

    public function create()
    {
        $blocks = Block::get()->all();
        $types = Type::get()->all();
        $facades = Facade::get()->all();
        $statuses = Status::get()->all();
        $interiors = InteriorFeature::get()->all();
        $exteriors = ExteriorFeature::get()->all();
        return view("admin.project.create", ['blocks' => $blocks, 'types' => $types, 'facades' => $facades, 'statuses' => $statuses, 'interiors' => $interiors, 'exteriors' => $exteriors ]);
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
        'photo' => 'required'
        ]);

        $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "projects", $request->photo) : "";
        $request->photo = $image;
        $data['photo'] = $image;
        if($validated){
          $newProject = Project::create($data);

          if ($newProject) {
              return redirect()->route("admin.projects.index")->with('success', 'Proje başarılı bir şekilde eklendi.');
          }
        }



        return redirect()->back()->with('error', 'Proje kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }

    public function projectFilter(Request $request){
      $rooms = Room::get()->all();
      $types = Type::get()->all();
      $facades = Facade::get()->all();
      $statutes = Status::get()->all();
      $projects = Project::get()->all();

      $apartments = Apartment::where('status_id', $request->status)
      ->orWhere('facade_id', $request->facade_id)
      ->orWhere('room_id', $request->room_id)
      ->orWhere('type_id', $request->type_id)
      ->orWhere('floor_id', $request->floor_id)
      ->get();

      return view('admin.project.filter', ['apartments' => $apartments,'status' => $statutes, 'rooms' => $rooms, 'types' => $types, 'facades' => $facades, 'projects' => $projects]);

    }


    public function show($id)
    {
        $rooms = Room::get()->all();
        $types = Type::get()->all();
        $facades = Facade::get()->all();
        $statutes = Status::get()->all();
        $project = Project::findOrFail($id);
        $blocks = Block::where('project_id', $project->id)->get();
        $projects = Project::get()->all();
        $customers = User::where('permission', 4)->get();

        return view('admin.project.show', ['customers' => $customers, 'project' => $project, 'blocks' => $blocks, 'status' => $statutes, 'rooms' => $rooms, 'types' => $types, 'facades' => $facades, 'projects' => $projects]);
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view("admin.project.edit", compact("project"));
    }

    public function update(Request $request)
    {
        $data = $request->except("_token");
        $id = $request->route('project');
        $project = Project::findOrFail($id);
        $insert = $project->update($data);

        if (isset($project['photo'])) {
            deleteImage($project->photo);
                $data['photo'] = ImageUploadHelper::upload(rand(1, 9000), "projects", $data['photo']);
        }

        if ($insert) {
            return back()->with('success', 'Proje başarılı bir şekilde güncellendi.');
        }
        return redirect()->back()->with('error', 'Görüşme güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function destroy($id)
    {
        $status = Project::findOrFail($id);

        $delete = $status->delete();

        if ($delete) {
            $result["success"] = "Proje başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Proje silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
