<?php

namespace App\Http\Controllers\admin\product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Kind;
use App\Helper\ImageUploadHelper;
use App\Models\Pvc;
use App\Models\Window;
use App\Models\ProductPvc;
use App\Models\Handle;
use App\Models\Color;
use App\Models\Wing;
use App\Models\Slat;
use App\Models\GlassFeature;
use App\Models\Image;


class ProductController extends Controller
{
    public function index()
    {
        $products =  Product::get()->all();
        return view("admin.product.index", compact("products"));
    }

    public function create()
    {
        $categories = Category::where('category_id', '!=', NULL)->get();
        $brands = Brand::get()->all();
        $pvcs = Pvc::get()->all();
        $windows = Window::get()->all();
        $colors = Color::get()->all();
        $handles = Handle::get()->all();
        $glass_features = GlassFeature::get()->all();

        return view("admin.product.create", [
          'categories' => $categories,
          'brands' => $brands,
          'pvcs' => $pvcs,
          'windows' => $windows,
          'handles' => $handles,
          'glass_features' => $glass_features,
          'colors' => $colors,
        ]);
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
      $product = new Product;
      $product->name = $request->name;
      $product->slug = sef_link($request->name);
      $product->category_id = $request->category_id;
      $product->user_id = $request->user_id;
      $product->description = $request->description;
      $product->min_width = $request->min_width;
      $product->max_width = $request->max_width;
      $product->min_height = $request->min_height;
      $product->max_height = $request->max_height;
      $product->price = $request->price;
      $product->wing = $request->wing;
      $product->number_of_verticals = $request->number_of_verticals;
      $product->number_of_horizontal = $request->number_of_horizontal;
      $product->window_id = $request->window_id;
      $product->pvc_id = $request->pvc_id;
      $product->color_id = $request->color_id;
      $product->ordering = $request->ordering;
      $product->handle_id = $request->handle_id;
      $product->glass_feature_id = $request->glass_feature_id;
      $product->save();
      if(isset($request->images)){
        foreach ($request->file('images') as $imagefile) {
          $ph = new Image;
          $path = $imagefile->store('/uploads/galeries', ['disk' =>   'my_files']);
          $ph->url = $path;
          $ph->product_id = $product->id;
          $saveM = $ph->save();
          
        }
      }

          return redirect()->route("admin.products.index")->with('success', 'Ürün başarılı bir şekilde eklendi.');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $categories = Category::where('category_id', '!=', NULL)->get();
        $brands = Brand::get()->all();
        $pvcs = Pvc::get()->all();
        $windows = Window::get()->all();
        $colors = Color::get()->all();
        $handles = Handle::get()->all();
        $glass_features = GlassFeature::get()->all();
        $product = Product::findOrFail($id);

        return view("admin.product.edit", [
          'categories' => $categories,
          'brands' => $brands,
          'pvcs' => $pvcs,
          'windows' => $windows,
          'handles' => $handles,
          'glass_features' => $glass_features,
          'colors' => $colors,
          'product' => $product
        ]);
    }

    public function update(Request $request)
    {

      $data = $request->except("_token");
      $product = Product::findOrFail($request->product_id);
      $product->name = $request->name;
      $product->slug = sef_link($request->name);
      $product->category_id = $request->category_id;
      $product->user_id = $request->user_id;
      $product->description = $request->description;
      $product->min_width = $request->min_width;
      $product->max_width = $request->max_width;
      $product->min_height = $request->min_height;
      $product->max_height = $request->max_height;
      $product->ordering = $request->ordering;
      $product->price = $request->price;
      $product->wing = $request->wing;
      $product->number_of_verticals = $request->number_of_verticals;
      $product->number_of_horizontal = $request->number_of_horizontal;
      $product->window_id = $request->window_id;
      $product->pvc_id = $request->pvc_id;
      $product->color_id = $request->color_id;
      $product->handle_id = $request->handle_id;
      $product->glass_feature_id = $request->glass_feature_id;
      $product->save();
      if(isset($request->images)){

        
        foreach ($request->file('images') as $imagefile) {
          $ph = new Image;
          $path = $imagefile->store('/uploads/galeries', ['disk' =>   'my_files']);
          $ph->url = $path;
          $ph->product_id = $product->id;
          $saveM = $ph->save();
        }
      }
        

        
          return redirect()->route("admin.products.index")->with('success', 'Ürün başarılı bir şekilde eklendi.');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $delete = $product->delete();

        if ($delete) {
            $result["success"] = "Ürün başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.manager.index')->with('success', 'Şübe başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Ürün silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }

    public function default_wings($id){
      $product = Product::findorfail($id);
      $wings = Wing::get()->all();
      return view('admin.product.default_wing', ['product' => $product, 'wings' => $wings]);
    }

    public function default_wings_store(Request $request){
      $areas = [];
      $product = Product::findorfail($request->product_id);
      foreach($request->wings as $wing){
        $areas[] = $wing;
      }
      

      $product->defaul_wings = json_encode($areas);
      $save = $product->save();

      if ($save) {
        
        return back();
      }else{
        echo "yanlış bişiler var";
      }


    }

    public function product_pvcs($id){
      $data = Product::findorfail($id);
      $pvcs = Pvc::get()->all();
      return view('admin.product.pvc', ['data' => $data, 'pvcs' => $pvcs]);
    }

    public function product_pvcs_store(Request $request){

        $product = Product::findorfail($request->product_id);

        $save = $product->pvc()->sync($request->pvc);
        if($save){
          return back();
        }else{
          echo "tamam";
        }
    }
    
    public function product_slats($id){
      $data = Product::findorfail($id);
      $slats = Slat::get()->all();
      return view('admin.product.slat', ['data' => $data, 'slats' => $slats]);
    }

    public function product_slats_store(Request $request){

        $product = Product::findorfail($request->product_id);

        $save = $product->slat()->sync($request->slat);
        if($save){
          return back();
        }else{
          echo "tamam";
        }
    }

    public function product_wings($id){
      $product = Product::findorfail($id);
      $wings = Wing::get()->all();
      return view('admin.product.wings', ['product' => $product, 'wings' => $wings, ]);
    }

    public function product_wings_store(Request $request){
        $product = Product::findorfail($request->product_id);
        $save = $product->wings()->sync($request->wing);
        if($save){
          return back();
        }else{
          echo "tamam";
        }

    }

    public function product_windows($id){
      $data = Product::findorfail($id);
      $pvcs = Window::get()->all();
      return view('admin.product.window', ['data' => $data, 'pvcs' => $pvcs]);

    }

    public function product_windows_store(Request $request){

      $product = Product::findorfail($request->product_id);

      $save = $product->window()->sync($request->pvc);
      if($save){
        return back();
      }else{
        echo "tamam";
      }
    }

    public function product_handles($id){
      $data = Product::findorfail($id);
      $handles = Handle::get()->all();
      return view('admin.product.handle', ['data' => $data, 'handles' => $handles]);

    }

    public function product_handles_store(Request $request){

      $product = Product::findorfail($request->product_id);

      $save = $product->handle()->sync($request->handle);
      if($save){
        return back();
      }else{
        echo "tamam";
      }
    }

    public function product_colors($id){
      $data = Product::findorfail($id);
      $colors = Color::get()->all();
      return view('admin.product.color', ['data' => $data, 'colors' => $colors]);

    }

    public function product_colors_store(Request $request){

      $product = Product::findorfail($request->product_id);

      $save = $product->color()->sync($request->color);
      if($save){
        return back();
      }else{
        echo "tamam";
      }
    }

    public function product_glass_features($id){
      $data = Product::findorfail($id);
      $glass_features = GlassFeature::get()->all();
      return view('admin.product.glass_feature', ['data' => $data, 'glass_features' => $glass_features]);

    }

    public function product_glass_features_store(Request $request){

      $product = Product::findorfail($request->product_id);

      $save = $product->glass_feature()->sync($request->glass_feature);
      if($save){
        return back();
      }else{
        echo "tamam";
      }
    }


    public function image_destroy($id){
      $product = Image::findorfail($id);
        return $product;
        exit;
       

        return response()->json($id);

    }


    

}
