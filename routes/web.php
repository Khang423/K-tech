<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\CheckLoginCustomer;
use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Support\Facades\Route;

//----------------------------------------------------------------ADMIN----------------------------------------------------------------
// route login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');
// route register
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'processRegister'])->name('process_register');

Route::group([
    'middleware' => CheckLoginMiddleware::class
], function () {
    Route::get('logout', [AuthController::class, 'logOut'])->name('logout');
    // route admin
    Route::resource('account/admin', MemberController::class)->except([
        'show',
    ]);
    Route::get('admin/api', [MemberController::class, 'api'])->name('admin.api');
    Route::get('admin/api/name', [MemberController::class, 'apiName'])->name('admin.api.name');
    // route staff
    Route::resource('account/staff', StaffController::class)->except([
        'show',
    ]);
    Route::get('staff/api', [StaffController::class, 'api'])->name('staff.api');
    Route::get('staff/api/name', [StaffController::class, 'apiName'])->name('staff.api.name');
    // route customer
    Route::resource('account/customer', CustomerController::class)->except([
        'show',
    ]);
    Route::get('customer/api', [CustomerController::class, 'api'])->name('customer.api');
    Route::get('customer/api/name', [CustomerController::class, 'apiName'])->name('customer.api.name');
    // route roles
    Route::resource('account/roles', RoleController::class)->except([
        'show',
    ]);
    Route::get('roles/api', [RoleController::class, 'api'])->name('roles.api');
    Route::get('roles/api/name', [RoleController::class, 'apiName'])->name('roles.api.name');
    // route cities
    Route::resource('address/cities', CityController::class)->except([
        'show',
    ]);
    Route::get('cities/api', [CityController::class, 'api'])->name('cities.api');
    Route::get('cities/api/name', [CityController::class, 'apiName'])->name('cities.api.name');

// route  districts
    Route::resource('address/districts', DistrictController::class)->except([
        'show',
    ]);
    Route::post('districts/loadDistrict', [DistrictController::class, 'loadDistrict'])->name('districts.loadDistrict');
    Route::get('districts/api', [DistrictController::class, 'api'])->name('districts.api');
    Route::get('districts/api/name', [DistrictController::class, 'apiName'])->name('districts.api.name');
    // route wards
    Route::resource('address/ward', WardController::class)->except([
        'show',
    ]);
    Route::post('ward/loadDistrict', [WardController::class, 'loadWard'])->name('ward.loadWard');
    Route::get('ward/api', [WardController::class, 'api'])->name('ward.api');
    Route::get('ward/api/name', [WardController::class, 'apiName'])->name('ward.api.name');
    // product routes
    Route::resource('product', ProductController::class)->except([
        'show',
    ]);
    Route::post('product/create/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('productdetail', [ProductController::class, 'viewProduct'])->name('product.view');
    Route::get('product/api', [ProductController::class, 'api'])->name('product.api');
    Route::get('product/api/name', [ProductController::class, 'apiName'])->name('product.api.name');
    // category routes
    Route::resource('product/category', CategoryController::class)->except([
        'show',
    ]);
    Route::get('category/api', [CategoryController::class, 'api'])->name('category.api');
    Route::get('category/api/name', [CategoryController::class, 'apiName'])->name('category.api.name');
    // supplier routes
    Route::resource('supplier', SupplierController::class)->except([
        'show',
    ]);
    Route::get('supplier/api', [SupplierController::class, 'api'])->name('supplier.api');
    Route::get('supplier/api/name', [SupplierController::class, 'apiName'])->name('supplier.api.name');
    // brand routes
    Route::resource('brand', BrandController::class)->except([
        'show',
    ]);
    Route::get('brand/api', [BrandController::class, 'api'])->name('brand.api');
    Route::get('brand/api/name', [BrandController::class, 'apiName'])->name('brand.api.name');
    // warehouse routes
    Route::resource('warehouse', WarehouseController::class)->except([
        'show',
    ]);
    Route::get('warehouse/api', [WarehouseController::class, 'api'])->name('warehouse.api');
    Route::get('warehouse/api/name', [WarehouseController::class, 'apiName'])->name('warehouse.api.name');
});

//----------------------------------------------------------------HOME----------------------------------------------------------------

Route::get('home', [HomeController::class, 'index'])->name('home.index');
// login customer route
Route::get('home/login', [AuthCustomerController::class, 'login'])->name('home.login');
Route::post('home/processLogin', [AuthCustomerController::class, 'processLogin'])->name('home.process_login');

// route cart
Route::group([
    'middleware' => CheckLoginCustomer::class
], function () {
    Route::get('signout', [AuthCustomerController::class, 'logOut'])->name('home.logout');
    Route::get('home/cart/', [HomeController::class, 'indexCart'])->name('home.cart');
    Route::get('home/up/{id}', [HomeController::class, 'upCart'])->name('home.upcart');
    Route::get('home/down/{id}', [HomeController::class, 'downCart'])->name('home.downcart');
    Route::get('home/destroy/{id}', [HomeController::class, 'cartDestroy'])->name('home.destroy');
    Route::get('home/addtocard/{id}', [HomeController::class, 'addToCartAction'])->name('home.addtocart');
});
// route product detail
Route::get('home/product/{product_id}', [HomeController::class, 'productDetail'])->name('home.product_detail');
// route order
Route::get('home/cart/order', [HomeController::class, 'indexOrder'])->name('home.order');
Route::get('home/cart/order/payment', [HomeController::class, 'indexPayment'])->name('home.payment');


