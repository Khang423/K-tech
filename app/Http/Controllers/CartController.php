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

class CartController extends Controller
{
    public function index()
    {
        // lấy id khách hàng từ session id
        $customer_id = session()->get('id');
        $order = Order::query()->latest()->where('customer_id', $customer_id)->first();
        // kiểm tra xem trong order có customer_id chưa nếu không có thì thêm vào
        if (!isset($order->customer_id)) {
            $arr = [];
            $arr['customer_id'] = $customer_id;
            Order::query()->create($arr);
            return redirect()->route('cart.index');
        }
        if (isset($order->total_price)) {
            $arr = [];
            $arr['customer_id'] = $customer_id;
            Order::query()->create($arr);
            return redirect()->route('cart.index');
        }
        // truy vấn tn sản phẩm và ảnh của  sản phẩm
        $order_detail = Order_detail::query()
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('order_id', $order->id)
            ->where('customer_id', $order->customer_id)
            ->where('orders.status', 0)
            ->addSelect(['order_details.*', 'product_name' => Product::query()->select('name')->whereColumn('id', 'order_details.product_id')->limit(1), 'image' => Product::query()->select('outsite_image')->whereColumn('id', 'order_details.product_id')->limit(1)])
            ->get();
        $brand = Brand::query()->get();
        return view('home.cart', [
            'order_detail' => $order_detail,
            'brand' => $brand,
            'order' => $order,
        ]);
    }

    //  add products to cart
    public function addToCart(Request $request)
    {
        $product_id = $request->get('id');
        $customer_id = session()->get('id');
        $order = Order::query()->latest()->where('customer_id', $customer_id)->first();
        $price = Product::query()->where('id', $product_id)->first();
        $order_detail = Order_detail::query()
            ->where('product_id', $product_id)
            ->where('order_id', $order->id)
            ->first();
        $exists = Order_detail::query()
            ->where('product_id', $product_id)
            ->where('order_id', $order->id)
            ->first();
        $arr = [];
        $arr['order_id'] = $order->id;
        $arr['product_id'] = $product_id;
        $arr['quantity'] = 1;
        $arr['price'] = $price->price;
        if ($exists) {
            $arrnew['quantity'] = $order_detail->quantity += 1;
            Order_detail::query()
                ->where('product_id', $product_id)
                ->where('order_id', $order->id)
                ->update($arrnew);
        } else {
            Order_detail::query()
                ->where('order_id', $order->id)
                ->create($arr);
        }
        return response()->json('success', 200);
    }

    //  delete product from my cart
    public function Destroy(Request $request)
    {
        $customer_id = session()->get('id');
        $order = Order::query()->latest()->where('customer_id', $customer_id)->first();
        Order_detail::query()
            ->where('product_id', $request->id)
            ->where('order_id', $order->id)
            ->delete();
        return response()->json('success', 200);
    }

    public function up(Request $request)
    {
        $customer_id = session()->get('id');
        $order = Order::query()->latest()->where('customer_id', $customer_id)->first();
        $order_detail = Order_detail::query()
            ->where('product_id', $request->id)
            ->where('order_id', $order->id)
            ->first();
        $arrnew['quantity'] = $order_detail->quantity += 1;
        Order_detail::query()
            ->where('product_id', $request->id)
            ->where('order_id', $order->id)
            ->update($arrnew);
        return response()->json('success', 200);
    }

    public function down(Request $request)
    {
        $customer_id = session()->get('id');
        $order = Order::query()->latest()->where('customer_id', $customer_id)->first();
        $order_detail = Order_detail::query()
            ->where('product_id', $request->id)
            ->where('order_id', $order->id)
            ->first();
        if ($order_detail->quantity > 1) {
            $arrnew['quantity'] = $order_detail->quantity - 1;
            Order_detail::query()
                ->where('product_id',  $request->id)
                ->where('order_id', $order->id)
                ->update($arrnew);
        } else {
            return response()->json([
                'error' => 'Số lượng đã tới mức tối thiểu.'
            ]);
        }
        return response()->json('success', 200);
    }
}
