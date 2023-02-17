<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Brand;
use App\Models\Campaign;
use App\Models\Slider;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Blog;
use App\Models\Law;
use App\Models\Adress;
use App\Models\Accessory;
use App\Models\Pvc;
use App\Models\Window;
use App\Models\Color;
use App\Models\Wing;
use App\Models\Handle;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemWing;
use App\Models\Slat;
use App\Models\GlassFeature;
use App\Models\Application;
use Auth;
use Illuminate\Support\Facades\Hash;
use Svea\WebPay\WebPay;
use Svea\WebPay\WebPayItem;
use Svea\WebPay\Config\ConfigurationService;
use Svea\WebPay\Config\ConfigurationProvider;
use Svea\WebPay\Config\SveaConfigurationProvider;
use Svea\WebPay\Helper\Helper;
use Datetime;
use Svea\WebPay\Constant\PaymentMethod;
use Svea\WebPay\Response\SveaResponse;


class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $categories = Category::where('category_id', NULL)->get();
    $brands = Brand::where('status', 1)->get();
    $campaigns = Campaign::where('status', 1)->get();
    $sliders = Slider::get()->all();
    $discounts = Discount::where('status', 1)->get();
    $products = Product::inRandomOrder()->take(4)->get();


    return view('home', [
      'categories' => $categories,
      'brands' => $brands,
      'campaigns' => $campaigns,
      'sliders' => $sliders,
      'products' => $products,
      'discounts' => $discounts
    ]);
  }

  public function productView($slug)
  {
    $product = Product::where('slug', $slug)->first();
    $accessories = Accessory::get()->all();
    $pvcs = Pvc::get()->all();
    $windows = Window::get()->all();
    $colors = Color::get()->sortBy('id')->all();
    $handles = Handle::get()->all();
    $glass_features = GlassFeature::get()->all();
    $wings = Wing::get()->all();
    $slats = Slat::get()->all();
    return view('product.detail', [
      'product' => $product,
      'accessories' => $accessories,
      'pvcs' => $pvcs,
      'windows' => $windows,
      'colors' => $colors,
      'handles' => $handles,
      'glass_features' => $glass_features,
      'wings' => $wings,
      'slats' => $slats,
    ]);
  }



  public function login()
  {
    return view('login');
  }

  public function register()
  {
    return view('register');
  }



  public function updateCart(Request $request)
  {
    if ($request->id and $request->quantity) {
      $cart = session()->get('cart');
      $cart[$request->id]["quantity"] = $request->quantity;
      session()->put('cart', $cart);
      session()->flash('success', 'Cart updated successfully');
    }
  }
  public function removeCart(Request $request)
  {
    if ($request->id) {
      $cart = session()->get('cart');
      if (isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart', $cart);
      }
      session()->flash('success', 'Product removed successfully');
    }
  }

  public function cart()
  {
    $cart = session('cart');
    if (Auth::check()) {
      $user = User::with('adresses')->where('id', Auth::user()->id)->firstOrFail();
      if (count($user->adresses) < 1) {
        return view('cart', ['cart' => $cart, 'errorAddress' => 'Vänligen ange din leveransadress']);
      }
    }
    return view('cart', ['cart' => $cart]);
  }

  public function cartAddress()
  {
    try {
      $cart = session()->get('cart');
      $shippingAddress = session()->get('shippingAddress');
      $total = 0;
      if (isset($cart)) {
        foreach (array_keys($cart) as $key => $value) {
          $cart_id = array_keys($cart)[$key];
          $total += $cart[$cart_id]['price'];
        }
      } else {
        return redirect()->route('cart');
      }
      if (Auth::check()) {
        $user = User::with('adresses')->where('id', Auth::user()->id)->firstOrFail();
        $count_address = count($user->adresses);
  
        if (count($user->adresses) < 1) {
          return view('cart_address', ['total' => $total, 'errorAddress' => 'Vänligen ange din leveransadress']);
        }
        $checkCart = count($cart);
        if (!$checkCart) {
          return redirect()->route('cart');
        }
        if ($count_address < 1) {
          return redirect()->route('newAdress');
        }
      } else {
        if (!isset($shippingAddress)) {
          return redirect()->route('cart');
        }
      }
      return view('cart_address', ['total' => $total]);
    } catch (\Throwable $th) {
      return redirect()->route('index');
    }

  }

  public function cartAddressPost(Request $request)
  {
    try {
      if (Auth::check()) {
        $cart = session()->get('cart');
        $address = Adress::where('id', $request->addressValue)->firstorfail();
        foreach (array_keys($cart) as $key => $value) {
          $cart_id = array_keys($cart)[$key];
          $cart[$cart_id]['contract'] = true;
          $cart[$cart_id]['address'] = $address->id;
        }
        session()->put('cart', $cart);
      }
    } catch (\Throwable $th) {
      return redirect()->route('cart');
    }
  }

  public function addToCart(Request $request)
  {
    $wingsArray = [];
    $product = Product::findorfail($request->product_id);
    $pvcSelect = Pvc::findorfail($request->pvc_id);
    $windowSelect = Window::findorfail($request->window_id);
    $pvc = $pvcSelect->price;
    $window = $windowSelect->price;
    $handleSelect = Handle::findorfail($request->handle_id);
    $colorSelect = Color::findorfail($request->color_id);
    $glassSelect = GlassFeature::findorfail($request->glass_feature_id);
    $slatSelect = Slat::findorfail($request->slat_id);

    $toplam = 0;
    if (empty($request->wing)) {
      $toplam = 0;
    } else {
      foreach ($request->wing as $wing) {
        $hesap = Wing::where('id', $wing)->first();
        $toplam = (intval($toplam) + intval($hesap->price));
        $wingsArray[] = $hesap;
      }
    }

    if (empty($request->height)) {
      $height = $product->min_height;
    } else {
      $height = $request->height;
    }
    if (empty($request->width)) {
      $width = $product->min_width;
    } else {
      $width = $request->width;
    }

    $alan = ($height * $width);
    $cevre = ($product->number_of_verticals * $height) + ($product->number_of_horizontal * $width);

    $handlePrice = ($product->wing * $handleSelect->price);

    $formul = (($cevre * $pvc) + ($alan * $window) + ($handlePrice) + $toplam);


    if (!$product) {
      abort(404);
    }

    if (isset($product->images()->skip(1 - 1)->first()->url)) {
      $product->photo = $product->images()->skip(1 - 1)->first()->url;
    }
    $cart = session()->get('cart');
    // if cart is empty then this the first product
    if (!$cart) {
      $cart = [
        rand() => [
          "name" => $product->name,
          "quantity" => 1,
          "price" => $product->price,
          "photo" => $product->photo,
          "pvc_select" => $pvcSelect->name,
          "pvc_photo" => $pvcSelect->photo,
          "window_select" => $windowSelect->name,
          "window_photo" => $windowSelect->photo,
          "handle_select" => $handleSelect->name,
          "handle_photo" => $handleSelect->photo,
          "color_select" => $colorSelect->name,
          "color_photo" => $colorSelect->photo,
          "glass_select" => $glassSelect->name,
          "glass_photo" => $glassSelect->photo,
          "slat_select" => $slatSelect->name,
          "slat_photo" => $slatSelect->photo,
          "price" => $formul,
          "height" => $height,
          "width" => $width,
          "wings" => $wingsArray,
          "address" => "",
          "contract" => false,
        ]
      ];
      session()->put('cart', $cart);
      return redirect()->route('cart')->with('success', 'Produkten har lagts till i kundvagnen!');
    }
    // if cart not empty then check if this product exist then increment quantity
    if (isset($cart[$request->product_id])) {
      $cart = [
        rand() => [
          "name" => $product->name,
          "quantity" => 1,
          "price" => $product->price,
          "photo" => $product->photo,
          "pvc_select" => $pvcSelect->name,
          "pvc_photo" => $pvcSelect->photo,
          "window_select" => $windowSelect->name,
          "window_photo" => $windowSelect->photo,
          "handle_select" => $handleSelect->name,
          "handle_photo" => $handleSelect->photo,
          "color_select" => $colorSelect->name,
          "color_photo" => $colorSelect->photo,
          "glass_select" => $glassSelect->name,
          "glass_photo" => $glassSelect->photo,
          "slat_select" => $slatSelect->name,
          "slat_photo" => $slatSelect->photo,
          "price" => $formul,
          "height" => $height,
          "width" => $width,
          "wings" => $wingsArray,
          "address" => "",
          "contract" => false,
        ]
      ];
      session()->put('cart', $cart);
      return redirect()->route('cart')->with('success', 'Produkten har lagts till i kundvagnen!');
    }
    // if item not exist in cart then add to cart with quantity = 1
    $cart[rand()] = [
      "name" => $product->name,
      "quantity" => 1,
      "price" => $product->price,
      "photo" => $product->photo,
      "pvc_select" => $pvcSelect->name,
      "pvc_photo" => $pvcSelect->photo,
      "window_select" => $windowSelect->name,
      "window_photo" => $windowSelect->photo,
      "handle_select" => $handleSelect->name,
      "handle_photo" => $handleSelect->photo,
      "color_select" => $colorSelect->name,
      "color_photo" => $colorSelect->photo,
      "glass_select" => $glassSelect->name,
      "glass_photo" => $glassSelect->photo,
      "slat_select" => $slatSelect->name,
      "slat_photo" => $slatSelect->photo,
      "price" => $formul,
      "height" => $height,
      "width" => $width,
      "wings" => $wingsArray,
      "address" => "",
      "contract" => false,
    ];
    session()->put('cart', $cart);
    return redirect()->route('cart')->with('success', 'Produkten har lagts till i kundvagnen!');
  }

  public function cartUpdate(Request $request)
  {
    if ($request->id and $request->quantity) {
      $cart = session()->get('cart');
      $cart[$request->id]["quantity"] = $request->quantity;
      session()->put('cart', $cart);
      session()->flash('success', 'Varukorgen har uppdaterats!');
    }
  }
  public function cartRemove(Request $request)
  {
    if ($request->id) {
      $cart = session()->get('cart');
      if (isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart', $cart);
      }
      session()->flash('success', 'Produkten har tagits bort!');
    }
  }

  public function guestCartAddress()
  {
    try {
      $shippingAddress = session()->get('shippingAddress');
      $cart = session()->get('cart');
      if (Auth::check()) {
        return redirect()->route('index');
      } else {
        if (!isset($cart)) {
          return redirect()->route('index');
        }
        if ($shippingAddress) {
          return redirect()->route('cartAddress');
        }
        return view('guestCartAddress');
      }
    } catch (\Throwable $th) {
      return redirect()->route('index');
    }
  }

  public function guestCartAddressPost(Request $request)
  {
    if (Auth::check()) {
      return redirect()->route('index');
    } else {
      $addressArr = [];
      $shippingAddress = session()->get('shippingAddress');


      $request->validate([
        'name' => 'nullable',
        'surname' => 'nullable',
        'phone' => 'nullable',
        'email' => 'nullable',
        'adress' => 'nullable',
        'city' => 'nullable',
        'country' => 'nullable',
        'zipCode' => 'nullable',
      ]);
      array_push($addressArr, [
        'name' => $request->name,
        'surname' => $request->surname,
        'phone' => $request->phone,
        'email' => $request->email,
        'adress' => $request->adress,
        'city' => $request->city,
        'country' => $request->country,
        'zipCode' => $request->zipCode,
      ]);
      $shippingAddress = [
        'shippingAddress' => $addressArr,

      ];
      session()->put('shippingAddress', $shippingAddress);
      return redirect()->route('cartAddress');
    }
  }

  public function categoryView($slug)
  {
    $category = Category::where('slug', $slug)->first();
    $categories = Category::where('category_id', $category->id)->orderBy('ordering', 'desc')->get();
    return view('category', ['categories' => $categories, 'category' => $category]);
  }

  public function subCategoryView($slug)
  {
    $category = Category::where('slug', $slug)->first();
    $products = Product::where('category_id', $category->id)->get();
    return view('sub_category', ['products' => $products, 'category' => $category]);
  }

  public function myOrders()
  {
    try {
      if(Auth::check()){
        $orders = Order::with('order_items','order_items_wing')->where('user_id',Auth::user()->id)->get();
        return view('myOrders',['orders'=>$orders]);
      }
      else{
        return redirect()->route('giris');
      }
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  public function orderDetail($id)
  {
    try {
      if(Auth::check()){
        $order = Order::with('order_items','order_items_wing')->where('id',$id)->firstorfail();
        if((Auth::user()->id !== $order->user_id) ){
          return redirect()->route('index');
        }
        return view('orderDetail',['order'=>$order]);
      }
      else{
        return redirect()->route('giris');
      }
    } catch (\Throwable $th) {
      return redirect()->route('index');
    }
  }

  public function cartDelete($id)
  {
    $cart = Cart::findorfail($id);
    $delete = $cart->delete();
    if ($delete) {
      return redirect()->back()->with('success', 'Produkten har raderats från din kundvagn.');
    }
    return redirect()->back()->with('warning', 'Ett fel har uppstått, vänligen meddela oss.');
  }

  public function profile()
  {
    return view('profile');
  }

  public function profile_update(Request $request)
  {

    $user = Auth::user();
    $request->validate([
      'name' => 'required',
      'surname' => 'required',
      'birthday' => 'date',
      'phone' => 'required',
    ]);

    $user->name = $request->name;
    $user->surname = $request->surname;
    $user->birthday = $request->birthday;
    $user->phone = $request->phone;

    $save = $user->save();

    if ($save) {
      return redirect()->back()->with('success', 'Din profil har blivit uppdaterad.');
    }
  }

  public function newAdress()
  {
    if (Auth::check()) {
      return view('new_adress');
    } else {
      return redirect()->route('giris');
    }
  }

  public function newAdressPost(Request $request)
  {

    $adress = new Adress;

    $adress->title = $request->title;
    $adress->name = $request->name;
    $adress->surname = $request->surname;
    $adress->phone = $request->phone;
    $adress->adress = $request->adress;
    $adress->zipCode = $request->zipCode;
    $adress->city = $request->city;
    $adress->country = $request->country;
    $adress->user_id = Auth::user()->id;

    $save = $adress->save();

    if ($save) {
      return redirect()->route("profile")->with('success', 'Adressen har raderats.');
    }

    return redirect()->back()->with('error', 'Ett problem uppstod under adressregistreringen. Försök igen senare.!')->withInput();
  }

  public function adressDelete()
  {

    $adress = Adress::findOrFail($_GET['id']);
    if ($adress->user_id == Auth::user()->id) {
      $delete = $adress->delete();
      if ($delete) {
        return redirect()->route("profile")->with('success', 'Adressen har raderats.');
      }
    } else {
      return back();
    }
  }

  public function editAddress($id)
  {
    $adress = Adress::findOrFail($id);
    return view("edit_adress", compact("adress"));
  }

  public function updateAdress(Request $request)
  {
    $adress = Adress::findOrFail($request->id);
    $request->validate([
      'name' => 'required',
      'surname' => 'required',
      'title' => 'required',
      'phone' => 'required',
      'adress' => 'required',
      'country' => 'required',
      'city' => 'required',
      'zipCode' => 'required',
    ]);

    $adress->name = $request->name;
    $adress->surname = $request->surname;
    $adress->title = $request->title;
    $adress->phone = $request->phone;
    $adress->adress = $request->adress;
    $adress->country = $request->country;
    $adress->city = $request->city;
    $adress->zipCode = $request->zipCode;

    $save = $adress->save();

    if ($save) {
      return redirect()->route("profile")->with('success', 'Din profil har blivit uppdaterad.');
    }
  }


  public function changePassword(Request $request)
  {
    $user = Auth::user();

    $userPassword = $user->password;

    $request->validate([
      'current_password' => 'required',
      'new_password' => 'required|same:confirm_password|min:6',
      'confirm_password' => 'required',
    ]);

    if (!Hash::check($request->current_password, $userPassword)) {
      return back()->withErrors(['current_password' => 'Ditt lösenord är felaktigt!']);
    }

    $user->password = Hash::make($request->new_password);

    $user->save();

    return redirect()->back()->with('success', 'Ditt lösenord har ändrats.');
  }

  public function blogView($slug)
  {

    $blog = Blog::where('slug', $slug)->first();
    return view('blog', ['blog' => $blog]);
  }

  public function legalView($slug)
  {

    $legal = Law::where('slug', $slug)->first();
    return view('legal', ['legal' => $legal]);
  }
  public function calculate(Request $request)
  {
    $product = Product::findorfail($request->product_id);
    $pvcSelect = Pvc::findorfail($request->pvc_id);
    $windowSelect = Window::findorfail($request->window_id);
    $pvc = $pvcSelect->price;
    $window = $windowSelect->price;
    $handleSelect = Handle::findorfail($request->handle_id);
    $colorSelect = Color::findorfail($request->color_id);
    $toplam = 0;
    if (empty($request->wings)) {
      $toplam = 0;
    } else {
      foreach ($request->wings as $wing) {
        $hesap = Wing::where('id', $wing)->first();
        $toplam = (intval($toplam) + intval($hesap->price));
      }
    }

    if (empty($request->height)) {
      $height = $product->min_height;
    } else {
      $height = $request->height;
    }
    if (empty($request->width)) {
      $width = $product->min_width;
    } else {
      $width = $request->width;
    }

    $alan = ($height * $width);
    $cevre = ($product->number_of_verticals * $height) + ($product->number_of_horizontal * $width);

    $handlePrice = ($product->wing * $handleSelect->price);

    $formul = (($cevre * $pvc) + ($alan * $window) + ($handlePrice) + $toplam);
    $formul2 = $formul / 100*50;
    return ($formul + $formul2);
  }

  public function search(Request $request)
  {
    $datas = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();
    return view('search', ['datas' => $datas]);
  }

  public function order_payment(Request $request)
  {


    $adress = new Order;
    $cart = session()->get('cart');
    $adress->detail = json_encode($cart);
    $adress->name = $request->name;
    $adress->surname = $request->surname;
    $adress->phone = $request->phone;
    $adress->email = $request->email;
    $adress->adress = $request->adress;

    $adress->save();

    return redirect()->route('index')->with('success', 'Sipariş tamamlandı.');;
  }

  public function contact()
  {
    return view('contact');
  }

  public function contactPost(Request $request)
  {
    $request->validate(
      [
        'name' => 'required',
        'email' => 'nullable',
        'phone' => 'required',
        'message' => 'required',
      ],
      [
        'name.required' => 'Fältet "namn" är obligatoriskt.',
        'phone.required' => 'Fältet "phone" är obligatoriskt.',
        'message.required' => 'Fältet "message" är obligatoriskt.',
      ]
    );
    $contactName = $request->name;
    $contactEmail = $request->email;
    $contactPhone = $request->phone;
    $contactMessage = $request->message;

    $save = Application::create([
      'name' => $contactName,
      'email' => $contactEmail,
      'phone' => $contactPhone,
      'message' => $contactMessage,
    ]);

    if ($save) {
      return redirect()->back()->with('success', 'Success');
    }
  }

  public function faq()
  {
    return view('faq');
  }
  public function aboutUs()
  {
    return view('about_us');
  }

  public function testApi()
  {
    try {
      $cart = session('cart');
      $myConfig = ConfigurationService::getTestConfig(); // add your Svea credentials into config_prod.php or config_test.php file
      $cart_object = array_keys($cart)[0];
      $cart_id = $cart[$cart_object]['address'];
      // We assume that you've collected the following information about the order in your shop:
      if (Auth::check()) {
        $address = Adress::where('id', $cart_id)->firstorfail();
        $user = User::with('adresses')->where('id', Auth::user()->id)->firstOrFail();
        if (count($user->adresses) < 1) {
          return redirect()->route('newAdress');
        }
        // customer information:
        $customerFirstName = $address->name;
        $customerLastName = $address->surname;
        $customerAddress = $address->adress;
        $customerZipCode = $address->zipCode;
        $customerCity = $address->city;
        $customerCountry = $address->country;
        $customerPhoneNo = $address->phone;
      } else {
        foreach (array_keys($cart) as $key => $value) {
          $cart_id = array_keys($cart)[$key];
          $cart[$cart_id]['contract'] = true;
        }
        $shippingAddress = session()->get('shippingAddress');
        $customerFirstName = $shippingAddress['shippingAddress'][0]['name'];
        $customerLastName = $shippingAddress['shippingAddress'][0]['surname'];
        $customerAddress = $shippingAddress['shippingAddress'][0]['adress'];
        $customerZipCode = $shippingAddress['shippingAddress'][0]['zipCode'];
        $customerCity = $shippingAddress['shippingAddress'][0]['city'];
        $customerCountry = $shippingAddress['shippingAddress'][0]['country'];
        $customerPhoneNo = $shippingAddress['shippingAddress'][0]['phone'];
        $customerEmail = $shippingAddress['shippingAddress'][0]['email'];
      }

      $clientOrderNumber = md5(uniqid(rand() + date('YmdHis'), true));

      // The customer has bought three items, one "Billy" which cost 700,99 kr excluding vat (25%) and two hotdogs for 5 kr (incl. vat).

      // We'll also need information about the customer country, and the currency used for this order, etc., see below

      // Start the order creation process by creating the order builder object by calling Svea\WebPay\WebPay::createOrder():
      $myOrder = WebPay::createOrder($myConfig);
      // You then add information to the order object by using the methods in the Svea\WebPay\BuildOrder\CreateOrderBuilder class.
      // For a Card order, the following methods are required:
      $myOrder->setCurrency("SEK");                           // order currency
      $myOrder->setClientOrderNumber($clientOrderNumber);  // required - use a not previously sent client side order identifier, i.e. "order #20140519-371"
      // You may also chain fluent methods together:
      $myOrder
        ->setCustomerReference(md5(uniqid(rand() + date('YmdHis'), true)))         // optional - This should contain a customer reference, as in "customer #123".
        ->setOrderDate(date('c'))                    // optional - or use an ISO8601 date as produced by i.e. date('c')
      ;

      foreach ($cart as $key => $value) {
        $myOrder->addOrderRow(
          WebPayItem::orderRow()
            ->setAmountIncVat($value['price'])
            ->setVatPercent(4)
            ->setQuantity($value['quantity'])
            ->setDescription($value['name'])
        );
      }

      // For card orders the ->addCustomerDetails() method is optional, but recommended, so we'll add what info we have
      $myCustomerInformation = WebPayItem::individualCustomer(); // there's also a ::companyCustomer() method, used for non-person entities

      // Set customer information, using the methods from the IndividualCustomer class
      $myCustomerInformation->setName($customerFirstName, $customerLastName);
      $sveaAddress = \Svea\WebPay\Helper\Helper::splitStreetAddress($customerAddress); // Svea requires an address and a house number
      $myCustomerInformation->setStreetAddress($sveaAddress[0], $sveaAddress[1]);
      $myCustomerInformation->setZipCode($customerZipCode)->setLocality($customerCity);
      $myCustomerInformation->setPhoneNumber($customerPhoneNo);


      $myOrder->addCustomerDetails($myCustomerInformation);
      // We have now completed specifying the order, and wish to send the payment request to Svea. To do so, we first select a payment method.
      // For card orders, we recommend using the ->usePaymentMethod(Svea\WebPay\Constant\PaymentMethod::SVEACARDPAY).
      $myCardOrderRequest = $myOrder->usePaymentMethod(PaymentMethod::SVEACARDPAY_PF);
      $myOrder->setCountryCode("SE");

      // Then set any additional required request attributes as detailed below. (See Svea\PaymentMethodPayment and Svea\HostedPayment classes for details.)
      $myCardOrderRequest
        ->setCardPageLanguage("SV")                                     // ISO639 language code, i.e. "SV", "EN" etc. Defaults to English.
        ->setReturnUrl("http://fonstersida.se/" . $this->getPath() . "landing"); // The return url where we receive and process the finished request response

      // Get a payment form object which you can use to send the payment request to Svea
      $myCardOrderPaymentForm = $myCardOrderRequest->getPaymentForm();
      $fields = array(
        'merchantid' => $myCardOrderPaymentForm->rawFields['merchantid'],
        'message' => $myCardOrderPaymentForm->rawFields['message'],
        'mac' => $myCardOrderPaymentForm->rawFields['mac']
      );
      foreach ($cart as $key => $value) {
        //create order
        $order = new Order;
        $order->order_id = $cart_id;
        $order->user_id = Auth::check() ? Auth::user()->id : '' ;
        $order->customerName = $customerFirstName;
        $order->customerSurname = $customerLastName;
        $order->customerPhone = $customerPhoneNo;
        $order->customerEmail = Auth::check() ? Auth::user()->email : $customerEmail ;
        $order->customerAddress = $customerAddress;
        $order->customerCity = $customerCity;
        $order->customerZipCode = $customerZipCode;
        $order->customerCountry = $customerCountry;
        $order->clientOrderNumber = $clientOrderNumber;
        $order->status = 0;
        $order->quantity = $value['quantity'];
        $order->orderTotal = $value['price'];
        $order->widthValue = $value['width'];
        $order->heightValue = $value['height'];
        $order->save();
        // create order item 
        $orderItemsArrName = [
          'name',
          'pvc_select',
          'window_select',
          'handle_select',
          'color_select',
          'glass_select',
          'slat_select',
        ];

        $orderItemsArrPhoto = [
          'photo',
          'pvc_photo',
          'window_photo',
          'handle_photo',
          'color_photo',
          'glass_photo',
          'slat_photo',
        ];

        foreach ($orderItemsArrName as $key => $element) {
          $order_items = new OrderItem;
          $order_items->order_id = $order->id;
          $order_items->name = $value[$element];
          $order_items->photo = $value[$orderItemsArrPhoto[$key]];
          $order_items->save();
        }
        

        // create order item wing
        foreach ($value['wings'] as $key => $wing) {
          $order_items_wing = new OrderItemWing;
          $order_items_wing->wing_id = $wing->id;
          $order_items_wing->name = $wing->name;
          $order_items_wing->photo = $wing->photo;
          $order_items_wing->content = $wing->content;
          $order_items_wing->price = $wing->price;
          $order_items_wing->order_id = $order->id;
          $order_items_wing->save();
        }
      }
      
      return response()->json($myCardOrderPaymentForm->rawFields);

      // // Then send the form to Svea, and receive the response on the landingpage after the customer has completed the card checkout SveaCardPay
      // $client = new \GuzzleHttp\Client();
      // $response = $client->request('POST', $myCardOrderPaymentForm->rawFields['htmlFormAction'],[
      //   'form_params'=>['merchantid' => $myCardOrderPaymentForm->rawFields['merchantid'],
      //   'message' => $myCardOrderPaymentForm->rawFields['message'],
      //   'mac' => $myCardOrderPaymentForm->rawFields['mac']]
      // ]);
      // echo "<pre>";
      // print_r( "press submit to send the card payment request to Svea");
      // print_r( $myCardOrderPaymentForm->completeHtmlFormWithSubmitButton );
    } catch (Exception $e) {
      return redirect()->route('index');
    }
  }

  public function deneme(){
    return view('deneme');
  }
  
  public function denemePost(){
    $array = array( 
      "success" => "true"
    );
  
    echo json_encode($array);
  }

  public function getPath()
  {
    $myURL = $_SERVER['SCRIPT_NAME'];
    $myPath = explode('/', $myURL);
    unset($myPath[count($myPath) - 1]);
    $myPath = implode('/', $myPath);

    return $myPath;
  }
  public function confirm()
  {
    return view('confirm');
  }
  public function landing()
  {
    $myConfig = ConfigurationService::getTestConfig();

    // the raw request response is posted to the returnurl (this page) from Svea.
    $rawResponse = $_REQUEST;
    // decode the raw response by passing it through the Svea\WebPay\Response\SveaResponse class
    try {
      $myResponse = new SveaResponse($rawResponse, $countryCode = "SE", $myConfig);
      if ($myResponse->response->accepted == 1) {
        Order::where('clientOrderNumber', $myResponse->response->clientOrderNumber)->update([
          'status' => 1,
          'paymentMethod' => $myResponse->response->paymentMethod,
          'transactionId' => $myResponse->response->transactionId,
          'amount' => $myResponse->response->amount,
          'paidAt' => date('c')
        ]);
        session()->forget('cart');
        if(!Auth::check()){
          session()->forget('shippingAddress');
        }
        return redirect()->route('myOrders')->with('success','success');
      } else {
        return redirect()->route('myOrders')->with('error','Error');
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}




function examplePrintError(Exception $ex, $errorTitle)
{
  print_r('--------- ' . $errorTitle . ' ---------' . PHP_EOL);
  print_r('Error message -> ' . $ex->getMessage() . PHP_EOL);
  print_r('Error code -> ' . $ex->getCode() . PHP_EOL);
}



