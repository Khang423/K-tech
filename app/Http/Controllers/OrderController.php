<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\DestroyRequest;
use App\Http\Requests\order\StoreOrderRequest;
use App\Http\Requests\order\UpdateOrderRequest;
use App\Models\Member;
use App\Models\Order;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Order();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }

    public function index()
    {
        $order = Order::query()->get();
        return view('order.index', [
            'order' => $order
        ]);
    }

    public function api()
    {

        $data = $this->model::query()->whereIn('status', [1, 2,3]);
        return DataTables::of($data)
            ->editColumn('address', function ($object) {
                $wardName = $object->ward->name ?? '';
                $districtName = $object->district->name ?? '';
                $cityName = $object->city->name ?? '';
                return $object->address . ' - ' . $wardName . ' - ' . $districtName . ' - ' . $cityName;
            })
            ->editColumn('status', function ($object) {
                if ($object->status == 1) {
                    return 'Chưa duyệt';
                } else if ($object->status == 2) {
                    return 'Đã duyệt';
                } else if ($object->status == 3) {
                    return 'Đã hủy';
                } else if ($object->status == 0) {
                    return 'Chưa đặt';
                }
            })
            ->editColumn('customer_id', function ($object) {
                return $object->customer->name;
            })
            ->addColumn('destroy', function ($object) {
                return route('order.destroy', $object);
            })
            ->editColumn('accept', function ($object) {
                return route('order.accept', $object->id);
            })
            ->editColumn('created_at', function ($object) {
                return Carbon::parse($object->created_at)->format('H:i:s d-m-Y');
            })
            ->make(true);
    }

    public function apiName(Request $request)
    {
        return $this->model
            ->query()->where('receive_name', 'like', '%' . $request->get('q') . '%')
            ->get([
                'id',
                'receive_name',
            ]);
    }

    public function store(StoreOrderRequest $request)
    {
        $customer_id = session()->get('id');
        $order_id = Order::query()->where('customer_id', $customer_id)->latest()->first();
        $arr = [];
        $arr['receive_name'] = $request->get('receive_name');
        $arr['receive_phone'] = $request->get('receive_phone');
        $arr['city_id'] = $request->get('city_id');
        $arr['district_id'] = $request->get('district_id');
        $arr['address'] = $request->get('address');
        $arr['wards_id'] = $request->get('wards_id');
        $arr['customer_id'] = session()->get('id');
        $arr['total_price'] = $request->get('total_price');
        $arr['status'] = 1;
        $this->model::query()->where('id', $order_id->id)
            ->where('customer_id', $customer_id)
            ->update($arr);
        return response()->json('success', 200);
    }

    public function accept(Request $request, $id)
    {
        $arr = [];
        $arr['status'] = 2;
        $this->model::query()->where('id', $id)->update($arr);
        return response()->json('success', 200);
    }

    public function destroy(Request $request, $id)
    {
        $arr = [];
        $arr['status'] = 3;
        $this->model::query()->where('id', $id)->update($arr);
        return response()->json('success', 200);
    }
}
