<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Customer;
use App\Models\District;
use App\Models\Image;
use App\Models\Member;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Role;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    // main page
    public function index()
    {
        $brand = Brand::query()->get();
        $p = Product::query()->get();
        return view('home.index', [
            'p' => $p,
            'brand' => $brand,
        ]);
    }

    // page product detail
    public function productDetail($product_id)
    {

        $p_image = Image::query()->where('product_id', $product_id)->get();
        $p_detail = ProductDetail::query()->where('product_id', $product_id)->first();
        $p = Product::query()->find($product_id);
        $brand1 = Brand::query()->where('id', $p->brand_id)->first();
        $category = Category::query()->where('id', $p->category_id)->first();
        $brand = Brand::query()->get();
        return view('home.product_detail', [
            'category' => $category,
            'brand' => $brand,
            'brand1' => $brand1,
            'p_image' => $p_image,
            'p_detail' => $p_detail,
            'p' => $p
        ]);
    }

    // ------------------------- handler cart---------------------------------------
    // page my cart
    public function indexCart()
    {
        $customer_id = session()->get('id');

        $order = Order::query()->where('customer_id', $customer_id)->first();
        if(!isset($order->customer_id))
        {
            $arr = [];
            $arr['customer_id'] = $customer_id;
            Order::query()->create($arr);
            return redirect()->route('home.cart');
        }

        $order_detail = Order_detail::query()
            ->where('order_id', $order->id)
            ->addSelect([
                'order_details.*',
                'product_name' => Product::query()->select('name')
                    ->whereColumn('id', 'order_details.product_id')
                    ->limit(1),
                'image' => Product::query()->select('outsite_image')
                    ->whereColumn('id', 'order_details.product_id')
                    ->limit(1),
            ])
            ->get();
        $brand = Brand::query()->get();
        return view('home.cart', [
            'order_detail' => $order_detail,
            'brand' => $brand,
        ]);
    }

    //  add products to cart
    public function addToCartAction($product_id)
    {
        $customer_id = session()->get('id');
        $order = Order::query()->where('customer_id', $customer_id)->first();
        $price = Product::query()->where('id', $product_id)->first();
        $order_detail = Order_detail::query()->where('product_id', $product_id)->where('order_id', $order->id)->first();
        $exists = Order_detail::query()->where('product_id', $product_id)->where('order_id', $order->id)->first();
        $arr = [];
        $arr['order_id'] = $order->id;
        $arr['product_id'] = $product_id;
        $arr['quantity'] = 1;
        $arr['price'] = $price->price;
        if ($exists) {
            $arrnew['quantity'] = $order_detail->quantity += 1;
            Order_detail::query()->where('product_id', $product_id)->where('order_id', $order->id)->update($arrnew);
        } else {
            Order_detail::query()->where('order_id', $order->id)->create($arr);
        }

        return redirect()->route('home.cart');
    }

    //  delete product from my cart
    public function cartDestroy($product_id)
    {
        $customer_id = session()->get('id');
        $order = Order::query()->where('customer_id', $customer_id)->first();
        Order_detail::query()
            ->where('product_id', $product_id)
            ->where('order_id', $order->id)
            ->delete();
        return redirect()->route('home.cart');
    }

    public function upCart($product_id)
    {
        $customer_id = session()->get('id');
        $order = Order::query()->where('customer_id', $customer_id)->first();
        $order_detail = Order_detail::query()->where('product_id', $product_id)->where('order_id', $order->id)->first();
        $arrnew['quantity'] = $order_detail->quantity += 1;
        Order_detail::query()->where('product_id', $product_id)->where('order_id', $order->id)->update($arrnew);
        return redirect()->route('home.cart');
    }

    public function downCart($product_id)
    {
        $customer_id = session()->get('id');
        $order = Order::query()->where('customer_id', $customer_id)->first();
        $order_detail = Order_detail::query()->where('product_id', $product_id)->where('order_id', $order->id)->first();
        if ($order_detail->quantity > 1) {
            $arrnew['quantity'] = $order_detail->quantity - 1;
            Order_detail::query()->where('product_id', $product_id)->where('order_id', $order->id)->update($arrnew);
        } else {
            echo 'Quantity has been reduced to a limit';
        }
        return redirect()->route('home.cart');
    }

    // ------------------------- handler cart ---------------------------------------

    public function indexOrder()
    {
        $customer_id = session()->get('id');
        $order = Order::query()->where('customer_id', $customer_id)->first();
        $order_detail = Order_detail::query()
            ->where('order_id', $order->id)
            ->addSelect([
                'order_details.*',
                'product_name' => Product::query()->select('name')
                    ->whereColumn('id', 'order_details.product_id')
                    ->limit(1),
                'image' => Product::query()->select('outsite_image')
                    ->whereColumn('id', 'order_details.product_id')
                    ->limit(1),
            ])
            ->get();
        $customer = Customer::query()->where('id', $customer_id)->first();

        $city = City::query()->get();
        $ward = Ward::query()->get();
        $district = District::query()->get();
        $brand = Brand::query()->get();
        return view('home.pageOrder', [
            'customer' => $customer,
            'order_detail' => $order_detail,
            'city_name' => $city,
            'ward_name' => $ward,
            'district_name' => $district,
            'brand' => $brand,
        ]);
    }

    public function indexPayment()
    {
        $customer_id = session()->get('id');
        $order = Order::query()->where('customer_id', $customer_id)->first();
        $order_detail = Order_detail::query()
            ->where('order_id', $order->id)
            ->addSelect([
                'order_details.*',
                'product_name' => Product::query()->select('name')
                    ->whereColumn('id', 'order_details.product_id')
                    ->limit(1),
                'image' => Product::query()->select('outsite_image')
                    ->whereColumn('id', 'order_details.product_id')
                    ->limit(1),
            ])
            ->get();
        $customer = Customer::query()->where('id', $customer_id)->first();
        $sum_quantity = Order_detail::query()->where('order_id', $order->id)->sum('quantity');
        $city = City::query()->get();
        $ward = Ward::query()->get();
        $district = District::query()->get();
        $brand = Brand::query()->get();
        return view('home.pagePayment', [
            'customer' => $customer,
            'order_detail' => $order_detail,
            'city_name' => $city,
            'ward_name' => $ward,
            'district_name' => $district,
            'sum_quantity' => $sum_quantity,
            'brand' => $brand,
        ]);
    }

    //  signout

    public function productBrand($request)
    {
        $brand_id = Brand::query()->where('name', $request)->first();
        $nameBrand = $request;
        $p = Product::query()->where('brand_id', $brand_id->id)->get();
        $brand = Brand::query()->get();
        return view('home.brand', [
            'p' => $p,
            'brand' => $brand,
            'nameBrand' => $nameBrand
        ]);
    }

    public function infoCustomer()
    {
        $customer_id = session()->get('id');
        $customer = Customer::query()->where('id', $customer_id)->first();
        $brand = Brand::query()->get();
        $city = City::query()->get();
        $ward = Ward::query()->get();
        $district = District::query()->get();
        return view('home.info_customer', [
            'brand' => $brand,
            'customer' => $customer,
            'city_name' => $city,
            'ward_name' => $ward,
            'district_name' => $district,
        ]);
    }

    public function infoUpdate(request $request){
        $id = session()->get('id');
        $arr = [];
        $arr['gender'] = $request->get('gender');
        $arr['name'] = $request->get('name');
        $arr['phone'] = $request->get('phone');
        $arr['birthdate'] = $request->get('birthdate');
        $arr['city_id'] = $request->get('city_id');
        $arr['district_id'] = $request->get('district_id');
        $arr['wards_id'] = $request->get('wards_id');
        $arr['address'] = $request->get('address');
        Customer::query()->where('id',$id)->update($arr);
        return response()->json('success',200);
    }
}
