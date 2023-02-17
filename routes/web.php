<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, "index"])->name('index');
Route::get('/logga-in', [\App\Http\Controllers\HomeController::class, "login"])->name('giris');
Route::get('/registrera', [\App\Http\Controllers\HomeController::class, "register"])->name('kayit');
Route::get('/product/{slug}', [\App\Http\Controllers\HomeController::class, "productView"])->name('productView');
Route::post('hesap',  [\App\Http\Controllers\HomeController::class, "hesap"])->name('hesap');
Route::get('/kontakta-oss', [\App\Http\Controllers\HomeController::class, "contact"])->name('contact');
Route::post('/kontakta-oss', [\App\Http\Controllers\HomeController::class, "contactPost"])->name('contactPost');

/** SVEA */

Route::get('/token-get', [\App\Http\Controllers\HomeController::class, "getToken"]);


/** SVEA */

Route::get('cart', [\App\Http\Controllers\HomeController::class, "cart"])->name('cart');
Route::get('cart/address', [\App\Http\Controllers\HomeController::class, "cartAddress"])->name('cartAddress');
Route::post('cart/address', [\App\Http\Controllers\HomeController::class, "cartAddressPost"])->name('cartAddressPost');
Route::get('guest/cart/address', [\App\Http\Controllers\HomeController::class, "guestCartAddress"])->name('guestCartAddress');
Route::post('guest/cart/address', [\App\Http\Controllers\HomeController::class, "guestCartAddressPost"])->name('guestCartAddressPost');
Route::post('add-to-cart', [\App\Http\Controllers\HomeController::class, "addToCart"])->name('addCart');
Route::patch('update-cart', [\App\Http\Controllers\HomeController::class, "cartUpdate"]);
Route::delete('remove-from-cart', [\App\Http\Controllers\HomeController::class, "cartRemove"]);

Route::get('item-delete/{id}',  [\App\Http\Controllers\HomeController::class, "cartDelete"])->name('cartDelete');
Route::get('/category/{slug}', [\App\Http\Controllers\HomeController::class, "categoryView"])->name('categoryView');
Route::get('/sub/category/{slug}', [\App\Http\Controllers\HomeController::class, "subCategoryView"])->name('subCategoryView');
Route::get('/shop/orders',  [\App\Http\Controllers\HomeController::class, "myOrders"])->name('myOrders');
Route::get('/shop/order/{id}',  [\App\Http\Controllers\HomeController::class, "orderDetail"])->name('orderDetail');
Route::get('/profile', [\App\Http\Controllers\HomeController::class, "profile"])->name('profile');
Route::get('/profile/edit-address/{id}', [\App\Http\Controllers\HomeController::class, "editAddress"])->name('editAddress');
Route::post('/profile/update-address', [\App\Http\Controllers\HomeController::class, "updateAdress"])->name('updateAdress');
Route::get('/blogg/{slug}', [\App\Http\Controllers\HomeController::class, "blogView"])->name('blogView');
Route::get('/legal/{slug}', [\App\Http\Controllers\HomeController::class, "legalView"])->name('legalView');
Route::post('/profile/update', [\App\Http\Controllers\HomeController::class , "profile_update"])->name('profile.update');
Route::get('/new-adress', [\App\Http\Controllers\HomeController::class, "newAdress"])->name('newAdress');
Route::post('/new-adress', [\App\Http\Controllers\HomeController::class , "newAdressPost"])->name('newAdressPost');
Route::post('/adress-delete', [\App\Http\Controllers\HomeController::class , "adressDelete"])->name('adressDelete');
Route::post('/change-password', [\App\Http\Controllers\HomeController::class , "changePassword"])->name('change.password');
Route::get('/search', [\App\Http\Controllers\HomeController::class , "search"])->name('search');
Route::post('/calculate', [\App\Http\Controllers\HomeController::class , "calculate"])->name('calculate');
Route::post('/oder/payment/post', [\App\Http\Controllers\HomeController::class , "order_payment"])->name('orderPayment');
Route::get('vanliga-fragor', [\App\Http\Controllers\HomeController::class , "faq"])->name('faq');
Route::get('betalning', [\App\Http\Controllers\HomeController::class , "payment"])->name('payment');
Route::get('om-oss', [\App\Http\Controllers\HomeController::class , "aboutUs"])->name('aboutUs');
Route::get('testapi', [\App\Http\Controllers\HomeController::class , "testApi"])->name('testApi');
Route::get('/landing', [\App\Http\Controllers\HomeController::class, 'landing'])->name('landing');
Route::get('checkout/confirm', [\App\Http\Controllers\HomeController::class , "confirm"])->name('confirm');
Route::get('deneme', [\App\Http\Controllers\HomeController::class , "deneme"])->name('deneme');
Route::post('denemepost', [\App\Http\Controllers\HomeController::class , "denemePost"])->name('denemePost');


Auth::routes();

/** Admin */
Route::group(['prefix' => 'admin', 'as' => 'admin.', "middleware" => ["auth"]], function () {
    Route::get("/", [\App\Http\Controllers\admin\DashboardController::class, "index"])->name("index");

    Route::resource('sliders', \App\Http\Controllers\admin\slider\SliderController::class)->middleware("CheckPermissionManagers");
    Route::resource('categories', \App\Http\Controllers\admin\category\CategoryController::class)->middleware("CheckPermissionManagers");
    Route::resource('brands', \App\Http\Controllers\admin\brand\BrandController::class)->middleware("CheckPermissionManagers");
    Route::resource('campaigns', \App\Http\Controllers\admin\campaign\CampaignController::class)->middleware("CheckPermissionManagers");
    Route::resource('contents', \App\Http\Controllers\admin\content\ContentController::class)->middleware("CheckPermissionManagers");
    Route::resource('blogs', \App\Http\Controllers\admin\blog\BlogController::class)->middleware("CheckPermissionManagers");
    Route::resource('legals', \App\Http\Controllers\admin\legal\LegalController::class)->middleware("CheckPermissionManagers");
    Route::resource('discounts', \App\Http\Controllers\admin\discount\DiscountController::class)->middleware("CheckPermissionManagers");
    Route::resource('contacts', \App\Http\Controllers\admin\contact\ContactController::class)->middleware("CheckPermissionManagers");
    Route::resource('banks', \App\Http\Controllers\admin\bank\BankController::class)->middleware("CheckPermissionManagers");
    Route::resource('products', \App\Http\Controllers\admin\product\ProductController::class)->middleware("CheckPermissionManagers");
    Route::resource('gains', \App\Http\Controllers\admin\gain\GainController::class)->middleware("CheckPermissionManagers");
    Route::resource('stores', \App\Http\Controllers\admin\store\StoreController::class)->middleware("CheckPermissionManagers");
    Route::resource('accessories', \App\Http\Controllers\admin\accessory\AccessoryController::class)->middleware("CheckPermissionManagers");
    Route::resource('kinds', \App\Http\Controllers\admin\kind\KindController::class)->middleware("CheckPermissionManagers");    
    Route::resource('wings', \App\Http\Controllers\admin\wing\WingController::class)->middleware("CheckPermissionManagers");


    Route::resource('slats', \App\Http\Controllers\admin\slat\SlatController::class)->middleware("CheckPermissionManagers");
    Route::get('/products/slat/{id}', [\App\Http\Controllers\admin\product\ProductController::class , "product_slats"])->name('products.slats');
    Route::post('/products/slat/update', [\App\Http\Controllers\admin\product\ProductController::class , "product_slats_store"])->name('products.slat.store');
    
    
    
    Route::resource('pvcs', \App\Http\Controllers\admin\pvc\PvcController::class)->middleware("CheckPermissionManagers");
    Route::get('/products/pvc/{id}', [\App\Http\Controllers\admin\product\ProductController::class , "product_pvcs"])->name('products.pvcs');
    Route::post('/products/pvc/update', [\App\Http\Controllers\admin\product\ProductController::class , "product_pvcs_store"])->name('products.pvc.store');
    
    Route::resource('handles', \App\Http\Controllers\admin\handle\HandleController::class)->middleware("CheckPermissionManagers");
    Route::get('/products/handle/{id}', [\App\Http\Controllers\admin\product\ProductController::class , "product_handles"])->name('products.handles');
    Route::post('/products/handle/update', [\App\Http\Controllers\admin\product\ProductController::class , "product_handles_store"])->name('products.handle.store');
    
    Route::resource('glass-features', \App\Http\Controllers\admin\glass_feature\GlassFeatureController::class)->middleware("CheckPermissionManagers");
    Route::get('/products/glass-feature/{id}', [\App\Http\Controllers\admin\product\ProductController::class , "product_glass_features"])->name('products.glass_features');
    Route::post('/products/glass-feature/update', [\App\Http\Controllers\admin\product\ProductController::class , "product_glass_features_store"])->name('products.glass_feature.store');
    
    Route::resource('colors', \App\Http\Controllers\admin\color\ColorController::class)->middleware("CheckPermissionManagers");
    Route::get('/products/color/{id}', [\App\Http\Controllers\admin\product\ProductController::class , "product_colors"])->name('products.colors');
    Route::post('/products/color/update', [\App\Http\Controllers\admin\product\ProductController::class , "product_colors_store"])->name('products.color.store');
    


    Route::get('/products/wings/default/{id}', [\App\Http\Controllers\admin\product\ProductController::class , "default_wings"])->name('default.wings');
    Route::post('/products/wings/default/store', [\App\Http\Controllers\admin\product\ProductController::class , "default_wings_store"])->name('default.wings.store');





    Route::resource('windows', \App\Http\Controllers\admin\window\WindowController::class)->middleware("CheckPermissionManagers");
    Route::get('/products/window/{id}', [\App\Http\Controllers\admin\product\ProductController::class , "product_windows"])->name('products.windows');
    Route::post('/products/window/update', [\App\Http\Controllers\admin\product\ProductController::class , "product_windows_store"])->name('products.window.store');

    
    Route::get('/products/wings/{id}', [\App\Http\Controllers\admin\product\ProductController::class , "product_wings"])->name('products.wings');
    Route::get('/products/wings/create/{id}', [\App\Http\Controllers\admin\product\ProductController::class , "product_wings_create"])->name('products.wing.create');
    Route::post('/store/products.wings.store', [\App\Http\Controllers\admin\product\ProductController::class , "product_wings_store"])->name('products.wings.store');    
    Route::post('/products/images/delete', [\App\Http\Controllers\admin\product\ProductController::class , "image_destroy"])->name('products.image.destroy');    


    Route::resource('orders', \App\Http\Controllers\admin\order\OrderController::class)->middleware("CheckPermissionManagers");











































































    //Kullanıcı yönetimi
    Route::resource('users', \App\Http\Controllers\admin\user\UserController::class)->middleware("CheckPermissionAdmin");

    Route::middleware("CheckPermissionManagers")->group(function () {
        //Yönetici yönetimi
        Route::resource('managers', \App\Http\Controllers\admin\manager\ManagerController::class);
        Route::get("/consultants", [\App\Http\Controllers\admin\manager\ManagerController::class, "consultants"])->name("manager.consultants");

        //Personel yönetimi
        Route::resource('staffs', \App\Http\Controllers\admin\staff\StaffController::class);
    });

    //Müsteri yönetimi
    Route::resource('customers', \App\Http\Controllers\admin\customer\CustomerController::class);
    Route::post('/customers/projects', [\App\Http\Controllers\admin\customer\CustomerController::class, "customerProjects"])->name('customer.projects.update');
    Route::post('/customer/filter/project', [\App\Http\Controllers\admin\customer\CustomerController::class, "customerFilter"])->name('customer.filter');
    Route::post('/customer/filter/bids', [\App\Http\Controllers\admin\customer\CustomerController::class, "priceFilter"])->name('customer.price.filter');

    Route::get("/my-customers", [\App\Http\Controllers\admin\customer\CustomerController::class, "my_customers"])->name("customer.my_customers");
    Route::group(['prefix' => 'customers', 'as' => 'customer.'], function () {
        //Genel bilgileri, adres, sosyal mediya
        Route::post("/update-customer-info/{customer_id}", [\App\Http\Controllers\admin\customer\CustomerController::class, "update_customer_info"])->name("update_customer_info");
        // Müsterinin teklif yönetimi
        Route::group(['prefix' => '{customer_id}/meeting/{meeting_id}/offers', 'as' => 'offer.'], function () {
            Route::get("/", [\App\Http\Controllers\admin\customer\CustomerOfferController::class, "index"])->name("index");
            Route::get("/create", [\App\Http\Controllers\admin\customer\CustomerOfferController::class, "create"])->name("create");
            Route::post("/store", [\App\Http\Controllers\admin\customer\CustomerOfferController::class, "store"])->name("store");
            Route::get("/{offer_id}", [\App\Http\Controllers\admin\customer\CustomerOfferController::class, "show"])->name("show");
            Route::put("/{offer_id}/update", [\App\Http\Controllers\admin\customer\CustomerOfferController::class, "update"])->name("update");
            Route::delete("/{offer_id}", [\App\Http\Controllers\admin\customer\CustomerOfferController::class, "delete"])->name("delete");
        });

        //Müsterinin notu yönetimi
        Route::group(['prefix' => '{customer_id}/notes', 'as' => 'notes.'], function () {
            Route::post("/store", [\App\Http\Controllers\admin\customer\CustomerNoteController::class, "store"])->name("store");
            Route::get("/{note_id}", [\App\Http\Controllers\admin\customer\CustomerNoteController::class, "show"])->name("show");
            Route::put("/{note_id}/update", [\App\Http\Controllers\admin\customer\CustomerNoteController::class, "update"])->name("update");
            Route::delete("/{note_id}", [\App\Http\Controllers\admin\customer\CustomerNoteController::class, "delete"])->name("delete");
        });

        // Doküman yönetimi
        Route::group(['prefix' => '{customer_id}/documents', 'as' => 'documents.'], function () {
            Route::post("/store", [\App\Http\Controllers\admin\customer\CustomerDocumentController::class, "store"])->name("store");
            Route::get("/{doc_id}", [\App\Http\Controllers\admin\customer\CustomerDocumentController::class, "show"])->name("show");
            Route::put("/{doc_id}/update", [\App\Http\Controllers\admin\customer\CustomerDocumentController::class, "update"])->name("update");
            Route::delete("/{doc_id}", [\App\Http\Controllers\admin\customer\CustomerDocumentController::class, "delete"])->name("delete");
            Route::get("/{doc_id}/download", [\App\Http\Controllers\admin\customer\CustomerDocumentController::class, "download"])->name("download");
        });
    });

    Route::resource('sales', \App\Http\Controllers\admin\sale\SaleController::class)->middleware("CheckPermissionManagers");
    Route::get('/get-projects/{id}', [\App\Http\Controllers\admin\sale\SaleController::class, "get_project"])->name('get_project');
    Route::get('/get-floors/{id}', [\App\Http\Controllers\admin\sale\SaleController::class, "get_floor"])->name('get_floor');
    Route::get('/get-apartments/{id}', [\App\Http\Controllers\admin\sale\SaleController::class, "get_apartments"])->name('get_apartments');



    Route::get('/get-district-list', [App\Http\Controllers\admin\address\AddressController::class, "getDistrictList"])->name('getDistrictList');
    Route::get('/get-neighborhood-list', [App\Http\Controllers\admin\address\AddressController::class, "getNeighborhoodList"])->name('getNeighborhoodList');

    /** Şübe Yönetimi */
    Route::resource('branchs', \App\Http\Controllers\admin\branch\BranchController::class)->middleware("CheckPermissionManagers");
    Route::get("/my-branchs", [\App\Http\Controllers\admin\branch\BranchController::class, "my_branchs"])->name("branchs.my_branchs");


    /** Durum Yönetimi */
    Route::resource('statuses', \App\Http\Controllers\admin\status\StatusController::class)->middleware("CheckPermissionManagers");
    Route::get('/statuses/create', [\App\Http\Controllers\admin\status\StatusController::class, "create"])->name('status.create');

    /** Cephe Yönetimi */
    Route::resource('facades', \App\Http\Controllers\admin\facade\FacadeController::class)->middleware("CheckPermissionManagers");
    Route::get('/facades/create', [\App\Http\Controllers\admin\facade\FacadeController::class, "create"])->name('facade.create');

    /** Konut Tipleri Yönetimi */
    Route::resource('types', \App\Http\Controllers\admin\type\TypeController::class)->middleware("CheckPermissionManagers");
    Route::get('/types/create', [\App\Http\Controllers\admin\type\TypeController::class, "create"])->name('type.create');

    /** Blok Yönetimi */
    Route::resource('blocks', \App\Http\Controllers\admin\block\BlockController::class)->middleware("CheckPermissionManagers");

    /** Blok Yönetimi */
    Route::resource('blocks', \App\Http\Controllers\admin\block\BlockController::class)->middleware("CheckPermissionManagers");
    Route::get('get-floor/{id}', [\App\Http\Controllers\admin\block\BlockController::class, "get_floors"])->name('get_floors');
    Route::get('/blocks/create', [\App\Http\Controllers\admin\block\BlockController::class, "create"])->name('block.create');


    

    Route::resource('projects', \App\Http\Controllers\admin\project\ProjectController::class)->middleware("CheckPermissionManagers");
    Route::get('/project/create', [\App\Http\Controllers\admin\project\ProjectController::class, "create"])->name('project.create');

    Route::resource('apartments', \App\Http\Controllers\admin\apartment\ApartmentController::class)->middleware("CheckPermissionManagers");
    Route::get('/apartment/interior-features/{id}', [\App\Http\Controllers\admin\apartment\ApartmentController::class, "interior"])->name('int.features.index');
    Route::post('/apartment/interior-features', [\App\Http\Controllers\admin\apartment\ApartmentController::class, "interiorPost"])->name('apartments.interior.store');
    Route::get('/apartment/exterior-features/{id}', [\App\Http\Controllers\admin\apartment\ApartmentController::class, "exterior"])->name('ext.features.index');
    Route::post('/apartment/exterior-features', [\App\Http\Controllers\admin\apartment\ApartmentController::class, "exteriorPost"])->name('apartments.exterior.store');
    Route::get('apartment/view/{id}', [\App\Http\Controllers\admin\apartment\ApartmentController::class, "view"])->name('apartments.view');
    /** Kat Yönetimi */
    Route::resource('floors', \App\Http\Controllers\admin\floor\FloorController::class)->middleware("CheckPermissionManagers");
    Route::get('/floor/create', [\App\Http\Controllers\admin\floor\FloorController::class, "create"])->name('floor.create');



    

    //Görüşme yönetimi
    Route::resource('meetings', \App\Http\Controllers\admin\meeting\MeetingController::class);
    Route::get("/my-meetings", [\App\Http\Controllers\admin\meeting\MeetingController::class, "my_meetings"])->name("meetings.my_meetings");

    // Müsterinin sonraki görüşme yönetimi
    Route::resource('next-meetings', \App\Http\Controllers\admin\customer\IncomeMeetingController::class)->parameters([
        "next-meetings" =>"meeting_id"
    ])->only("index");

    /** Profil Bilgilerimi Düzenle */
    Route::group(['namespace' => 'profile', 'prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/{id}', [\App\Http\Controllers\admin\profile\ProfileController::class, "index"])->name('index');
        Route::post('/{id}', [\App\Http\Controllers\admin\profile\ProfileController::class, "update"])->name('update');
    });

    Route::group(['namespace' => 'profile', 'prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/{id}', [\App\Http\Controllers\admin\profile\ProfileController::class, "index"])->name('index');
        Route::post('/{id}', [\App\Http\Controllers\admin\profile\ProfileController::class, "update"])->name('update');
    });
});

/** Şifremi Unuttum */
Route::group(['namespace' => 'forgot_password', 'prefix' => 'forgot_password', 'as' => 'forgot_password.'], function () {
    /*Route::get('/index', 'indexController@index')->name('index')->name("showForm");
    Route::post('/create', 'indexController@create')->name('create');
    Route::get('/reset_password/{email}', 'indexController@resetPassword')->name('resetPassword');
    Route::post('/rest_password/{email}', 'indexController@updatePassword')->name('updatePassword');*/
});
