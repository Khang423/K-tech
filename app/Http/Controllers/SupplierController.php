<?php

namespace App\Http\Controllers;

use App\Http\Requests\supplier\DestroyRequest;
use App\Http\Requests\supplier\StoreRequest;
use App\Http\Requests\supplier\UpdateRequest;
use App\Models\City;
use App\Models\Customer;
use App\Models\District;
use App\Models\Supplier;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Supplier();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('supplier.index');
    }

    public function api()
    {
        $data = $this->model::query();
        return DataTables::of($data)
            ->editColumn('address', function ($object) {
                $wardName = $object->ward && $object->ward->name ? ' ' . $object->ward->name : '';
                return $object->address.' - '.$wardName.' - ' .$object->district->name. ' - ' .$object->city->name;
            })
            ->addColumn('edit', function ($object) {
                return route('supplier.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('supplier.destroy', $object);
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
        $city = City::query()->get();
        $ward = Ward::query()->get();
        $district = District::query()->get();
        return view('supplier.create',[
            'city_name' => $city,
            'ward_name' => $ward,
            'district_name' => $district,
        ]);
    }
    public function store(StoreRequest $request)
    {
        $this->model->query()->create($request->validated());
        return response()->json('success',200);
    }


    public function show(Supplier $supplier)
    {

    }
    public function edit($supplier)
    {
        $city = City::query()->get();
        $ward = Ward::query()->get();
        $district = District::query()->get();
        return view('supplier.edit',[
            'supplier'=> $this->model::query()->find($supplier),
            'city_name' => $city,
            'ward_name' => $ward,
            'district_name' => $district,
        ]);
    }

    public function update(UpdateRequest $request,$supplier)
    {
        $this->model->where('id', $supplier)->update($request->validated());
        return response()->json('success', 200);
    }

    public function destroy(DestroyRequest $request,$supplierId)
    {
        $this->model::query()->where('id',$supplierId)->delete();
        return response()->json('success',200);
    }
}
