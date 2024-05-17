<?php

namespace App\Http\Controllers;
use App\Http\Requests\customer\DestroyRequest;
use App\Http\Requests\customer\StoreCustomerRequest;
use App\Http\Requests\customer\UpdateCustomerRequest;
use App\Models\City;
use App\Models\Customer;
use App\Models\District;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Customer();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        $customer = Customer::query()->get();
        $ward = Ward::query()->get();
        $district = Ward::query()->get();
        $city = Ward::query()->get();
        return view('account.customer.index',[
            'customer' => $customer,
            'ward' => $ward,
            'district' => $district,
            'city' => $city,
        ]);
    }

    public function api()
    {
        
        $data = $this->model::query();
        return DataTables::of($data)
            ->editColumn('address', function ($object) {
                $wardName = $object->ward->name ?? '';
                $districtName = $object->district->name ?? '';
                $cityName = $object->city->name ?? '';
                return $object->address.' - '. $wardName. ' - ' .$districtName. ' - ' . $cityName;
            })
            ->editColumn('birthdate', function ($object) {
                return Carbon::parse($object->birthdate)->format('d/m/Y');
            })
            ->addColumn('edit', function ($object) {
                return route('customer.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('customer.destroy', $object);
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
        return view('account.customer.create',[
            'city_name' => $city,
            'ward_name' => $ward,
            'district_name' => $district,
        ]);
    }

    public function store(StoreCustomerRequest $request)
    {
        if($request->hasFile('avatar')) {
            $path = Storage::disk('public')->putFile('account/customer', $request->file('avatar'));
            $arr = $request->validated();
            $arr['avatar'] = $path;
            $arr['password'] = Hash::make($request->get('password'),[
                'rounds' => 12,
            ]);
        }else{
            $arr = $request->validated();
            $arr['avatar'] = '';
            $arr['password'] = Hash::make($request->get('password'),[
                'rounds' => 12,
            ]);
        }
        $this->model->query()->create($arr);
        return response()->json('success', 200);
    }

    public function show(Customer $customer)
    {
        //
    }

    public function edit($customer)
    {
        $city = City::query()->get();
        $ward = Ward::query()->get();
        $district = District::query()->get();
        return view('account.customer.edit',[
            'customer'=> $this->model::query()->find($customer),
            'city_name' => $city,
            'ward_name' => $ward,
            'district_name' => $district,
        ]);
    }

    public function update(UpdateCustomerRequest $request,$customer)
    {

        $arr = $request->validated();
        if ($request->hasFile('avatar-new')) {
            Storage::disk('public')->delete($arr['avatar']);
            $path = Storage::disk('public')->putFile('account/customer', $arr['avatar-new']);
            $arr = $request->except([
                '_token',
                '_method',
                'avatar-new',
            ]);
            $arr['avatar'] = $path;
        }
        $this->model->where('id', $customer)->update($arr);
        return response()->json('success', 200);
    }

    public function destroy(DestroyRequest $request, $customerId)
    {
        $arr = $this->model->where('id', $customerId)->first();
        Storage::disk('public')->delete($arr->avatar);
        $this->model->find($customerId)->delete();
        $this->model->where('id', $customerId)->delete();
        return response()->json('success', 200);
    }
}