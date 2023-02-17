<?php

namespace App\Http\Controllers\admin\category;

use App\Models\Category;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helper\ImageUploadHelper;


class CategoryController extends Controller
{
    public function index()
    {
        $categoriesUst = Category::where("category_id", NULL)->get();
        $categoriesAlt = Category::where("category_id", "!=", NULL )->get();

        return view("admin.category.index", ['categoriesUst' => $categoriesUst, 'categoriesAlt' => $categoriesAlt]);
    }


    public function create()
    {
        $categories = Category::where('category_id', NULL)->get();
        return view("admin.category.create", ['categories' => $categories]);
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
          'ordering' => "required",
          'title_photo' => "required",
        ]);

        $image = (isset($request->photo)) ? ImageUploadHelper::upload(rand(1, 9000), "categories", $request->photo) : "";
        $request->photo = $image;
        $data['photo'] = $image;

        $image2 = (isset($request->title_photo)) ? ImageUploadHelper::upload(rand(1, 9000), "categories", $request->title_photo) : "";
        $request->title_photo = $image2;
        $data['title_photo'] = $image2;


        if($validated){
          $newCampaign = Category::create($data);
          if ($newCampaign) {
              return redirect()->route("admin.categories.index")->with('success', 'Kategori başarılı bir şekilde eklendi.');
          }
        }
        return redirect()->back()->with('error', 'Kategori kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();


    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories = Category::where('category_id', NULL)->get();
        $category = Category::findOrFail($id);
        return view("admin.category.edit", ['category' => $category, 'categories' => $categories]);
    }

    public function update(Request $request)
    {

        $data = $request->except("_token");
        $id = $request->route('category');
        $category = Category::findOrFail($id);

        if (isset($data['photo'])) {
            deleteImage($category->photo);
                $data['photo'] = ImageUploadHelper::upload(rand(1, 9000), "categories", $data['photo']);
        }

        if (isset($data['title_photo'])) {
            deleteImage($category->title_photo);
                $data['title_photo'] = ImageUploadHelper::upload(rand(1, 9000), "categories", $data['title_photo']);
        }

        $insert = $category->update($data);


        if ($insert) {
            return back()->with('success', 'Kategori başarılı bir şekilde güncellendi.');
        }
        return redirect()->back()->with('error', 'Kategori sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $delete = $category->delete();

        if ($delete) {
            $result["success"] = "Kategori başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Kategori silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }
}
