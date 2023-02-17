<?php

namespace App\Http\Controllers\admin\customer;

use App\Models\Province;
use App\Models\Bid;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helper\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy("name","asc")->get();
        return view("admin.customer.index", compact("customers"));
    }

    public function create()
    {
        $projects = Project::get()->all();
        return view("admin.customer.create", ['projects' => $projects]);
    }


    public function store(Request $request)
    {
        $data = $request->except("_token");
        $customerArray = Arr::except($data, ["you_found_us", "other_info_description"]);

        if(isset($request->email)){
          if (in_array($data["email"], Customer::emails())) {
              return back()->with("errorEmail", "Sistemde seçtiğiniz e-posta var. Lütfen başka e-postayı girin.")->withInput();
          }
        }
        if(isset($request->phone)){
          $phone = Customer::where('phone', $request->phone)->first();
          if(isset($phone)){
            return back()->with("errorEmail", "Sistemde seçtiğiniz telefon mevcut.")->withInput();
          }
        }


        $customerArray["status"] = true;
        $customerArray["user_id"] = Auth::user()->id;
        $customerArray["created_date"] = Carbon::today();

        if (isset($customerArray["image"])) {
            $image = (isset($customerArray['image'])) ? ImageUploadHelper::upload(rand(1, 9000), "customers", $customerArray['image']) : "";
            $customerArray["image"] = $image;
        }

        $newCustomer = Customer::create($customerArray);
        if(isset($request->province)){

          $this->insert_other_info($newCustomer, $data);

        }


        if ($newCustomer) {
            return redirect("/admin/customers/$newCustomer->id")
                ->with('success', 'Müsteri başarılı bir şekilde eklendi.');
        }

        return redirect()->back()->with('error', 'Müsteri kaydı sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!')->withInput();
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $provinces = Province::all();
        return view("admin.customer.edit", compact("customer", "provinces"));
    }

    public function show($id)
    {
        $provinces = Province::all();
        $customer = Customer::findOrFail($id);
        $bids = Bid::where('customer_id', $id)->get();;

        $customerMeetings = $customer->meetings()->orderBy("id", "desc")->get();

        $customerNotes = $customer->notes()->orderBy("id", "desc")->get();
        $customerDocuments = $customer->documents()->orderBy("id", "desc")->get();
        $nextMeetings = $customer->meetings()->whereDate("date_time", ">=", date("Y-m-d"))->get();
        //dd($nextMeetings);

        return view('admin.customer.show', compact(
            'customer',
            "customerNotes",
            "customerDocuments",
            "customerMeetings",
            "provinces",
            "nextMeetings",
            "bids"
        ));
    }


    public function update(Request $request)
    {
        $id = $request->route('customer');
        $user = Customer::findOrFail($id);
        $allEmails = Customer::pluck("email")->toArray();

        $data = $request->except('_token');

        if ($user->email !== $data["email"] && in_array($data["email"], $allEmails)) {
            return back()->with("errorEmail", "Sistemde seçtiğiniz e-posta var. Lütfen başka e-postayı girin.");
        }

        if (isset($data['image'])) {
            deleteImage($user->image);
            if ((Auth::user()->permission == 1) || (Auth::user()->permission == 2)) {
                $data['image'] = ImageUploadHelper::upload(rand(1, 9000), "users", $data['image']);
            } elseif (Auth::user()->permission == 3) {
                $data['image'] = ImageUploadHelper::upload(rand(1, 9000), "customer", $data['image']);
            }
        }

        $data = Arr::except($data, ["you_found_us", "other_info_description"]);

        $otherInfo = [
            "you_found_us" => $request->you_found_us,
            "description" => $request->other_info_description
        ];

        $user->other_info()->update($otherInfo);

        $update = $user->update($data);

        if ($update) {
            return redirect()->route('admin.customers.show', ['customer' => $id])->with('success', 'Müsteri başarılı bir şekilde güncellendi.');
        }

        return redirect()->back()->with('error', 'Müsteri güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');
    }

    public function destroy($id)
    {
        $user = Customer::findOrFail($id);
        deleteImage($user->image);

        $delete = $user->delete();
        $result = [];


        if ($delete) {
            $result["success"] = "Müsteri başarılı bir şekilde silindi.";
            $result["type"] = "success";
            //return redirect()->route('admin.users.index')->with('success', 'Müsteri başarılı bir şekilde silindi.');
        } else {
            $result["type"] = "error";
            $result["error"] = "Müsteri silinirken sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!";
        }

        return response()->json($result);
    }

    private function insert_other_info($newCustomer, $request)
    {
        $array = [
            "customer_id" => $newCustomer->id,
            "you_found_us" => $request["you_found_us"],
            "description" => $request["description"],
        ];

        return  $newCustomer->other_info()->create($array);
    }

    private function update_other_info($customer_id, $request)
    {
        $customer = Customer::findOrFail($customer_id);

        $array = [
            "you_found_us" => $request["you_found_us"],
            "description" => $request["other_info_description"],
        ];

        $customer->other_info()->delete();

        $update = $customer->other_info()->create($array);

        if ($update) {
            return back()->with('success', 'Müsteri başarılı bir şekilde güncellendi.');
        }

        return redirect()->back()->with('error', 'Müsteri güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');
    }

    public function my_customers(Request $request)
    {
        $customers = $request->user()-> my_customers()->orderBy("name","asc")->get();

        if($request->user()->permission==1 || $request->user()->permission==2){
            $staffIds= explode(",", $request->user()->consultants);
            $customers = Customer::whereIn("user_id", $staffIds)->get();
        }

        return view("admin.customer.my-customer", compact("customers"));
    }

    public function update_customer_info($customer_id, Request $request)
    {
        $customer = Customer::findOrFail($customer_id);
        $data = $request->except('_token');
        $allEmails = Customer::pluck("email")->toArray();

        if (isset($data["email"]) && $customer->email !== $data["email"] && in_array($data["email"], $allEmails)) {
            return back()->with("errorEmail", "Sistemde seçtiğiniz e-posta var. Lütfen başka e-postayı girin.");
        }

        if (isset($data['image'])) {
            deleteImage($customer->image);
            if ((Auth::user()->permission == 1) || (Auth::user()->permission == 2)) {
                $data['image'] = ImageUploadHelper::upload(rand(1, 9000), "users", $data['image']);
            } elseif (Auth::user()->permission == 3) {
                $data['image'] = ImageUploadHelper::upload(rand(1, 9000), "customer", $data['image']);
            }
        }

        if ($request->get("action") == "other_info") {
            return $this->update_other_info($customer_id, $data);
        }

        $update = $customer->update($data);

        if ($update) {
            return redirect()->route('admin.customers.show', ['customer' => $customer_id])->with('success', 'Müsteri başarılı bir şekilde güncellendi.');
        }

        return redirect()->back()->with('error', 'Müsteri güncelleme sırasında bir sorun oluştu. Daha sonra tekrar deneyiniz!');
    }

    public function customerProjects(Request $request){
      $apartment = Customer::findorfail($request->customer_id);
      $save = $apartment->Projects()->sync($request->projects);
      if($save){
        return back()->with('success', 'Müsteri başarılı bir şekilde güncellendi.');
      }
    }

    public function customerFilter(Request $request){

      $project = Project::with('customers')->findMany(($request->projects));
      return view("admin.customer.filter", ['customers' => $project[0]->customers ]);

    }

    public function priceFilter(Request $request){

      if($request->low == NULL){
        $bids = Bid::where('price', '<', $request->max)->get();
      }elseif ($request->max == NULL) {
        $bids = Bid::where('price', '>', $request->low)->get();
      }else{
        $bids = Bid::orWhere('price', '>', $request->low)->orWhere('price', '<', $request->max)->get();
      }

      return view('admin.customer.bid', ['bids' => $bids]);

    }
}
