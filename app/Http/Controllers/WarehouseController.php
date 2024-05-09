<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\City;
use App\Models\District;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\warehouse;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Warehouse();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('warehouse.index');
    }

    public function api()
    {
        $data = $this->model::query();
        return DataTables::of($data)
            ->editcolumn('product_id', function ($object) {
                return $object->product->name;
            })
            ->editcolumn('supplier_id', function ($object) {
                return $object->supplier->name;
            })
            ->editcolumn('price', function ($object) {
                return number_format($object->price, 0, ',', '.');
            })
            ->addColumn('total_price', function ($object) {
                $totalPrice = $object->stock_quantity * $object->price;
                return number_format($totalPrice, 0, ',', '.');
            })
            ->addColumn('edit', function ($object) {
                return route('warehouse.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('warehouse.destroy', $object);
            })
            ->make(true);
    }

    public function apiName(Request $request)
    {
        return $this->model
            ->query()->where('name', 'like', '%' . $request->get('q') . '%')
            ->get([
                'id',
                'name',
            ]);
    }

    public function create()
    {
        $product = Product::query()->get();
        $supplier = Supplier::query()->get();
        return view('warehouse.create',[
            'product' => $product,
            'supplier' => $supplier,
        ]);
    }
    public function store(StoreWarehouseRequest $request)
    {
        $warehouse = $request->get('price');
        $price['price'] = $warehouse;
        Product::query()->where('id',$request->get('product_id'))->update($price);
        $this->model->query()->create($request->validated());
        return response()->json('success',200);
    }

    public function show(warehouse $warehouse)
    {

    }
    public function edit($warehouse)
    {
        $product = Product::query()->get();
        $supplier = Supplier::query()->get();
        return view('warehouse.edit',[
            'product' => $product,
            'supplier' => $supplier,
            'warehouse' => $this->model::query()->find($warehouse),
        ]);
    }

    public function update(UpdateWarehouseRequest $request,$warehouseId)
    {
        $warehouse = $request->get('price');
        $price['price'] = $warehouse;
        Product::query()->where('id',$request->get('product_id'))->update($price);
        $this->model->where('id', $warehouseId)->update($request->validated());
        return response()->json('success', 200);
    }

    public function destroy(Request $request,$warehouseId)
    {
        $this->model::query()->where('id',$warehouseId)->delete();
        return response()->json('success',200);
    }
}
