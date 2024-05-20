<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\DestroyRequest;
use App\Http\Requests\admin\StoreRequest;
use App\Http\Requests\admin\UpdateRequest;
use App\Models\Member;
use App\Models\Order;
use App\Models\Role;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Member();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }

    public function index()
    {
        return view('account.admin.index');
    }

    public function api()
    {
        $data = $this->model::query()->where('role_id', 1);
        return DataTables::of($data)
            ->editcolumn('role_id', function ($object) {
                return $object->role->name;
            })
            ->editColumn('updated_at', function ($object) {
                return $object->updated_at->format('H:i:s d-m-Y');
            })
            ->editColumn('created_at', function ($object) {
                return $object->updated_at->format('H:i:s d-m-Y');
            })
            ->addColumn('edit', function ($object) {
                return route('admin.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.destroy', $object);
            })
            ->make(true);
    }

    public function apiName(Request $request)
    {
        return $this->model
            ->query()
            ->where('name', 'like', '%' . $request->get('q') . '%')
            ->get(['id', 'name']);
    }

    public function create()
    {
        $name_role = Role::query()->get();
        return view('account.admin.create', [
            'name_role' => $name_role,
        ]);
    }

    public function store(StoreRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->putFile('account/admin', $request->file('avatar'));
            $arr = $request->validated();
            $arr['avatar'] = $path;
        } else {
            $arr = $request->validated();
            $arr['avatar'] = '';
        }
        $arr['password'] = Hash::make($request->get('password'), [
            'rounds' => 12,
        ]);
        $this->model->query()->create($arr);
        //return redirect()->route('admin.index');
        return response()->json('success', 200);
    }

    public function show(Member $member)
    {
    }

    public function edit($member)
    {
        $name_role = Role::query()->get();
        return view('account.admin.edit', [
            'admin' => $this->model::query()->find($member),
            'name_role' => $name_role,
        ]);
    }

    public function update(UpdateRequest $request, $memberId)
    {
        $arr = $request->validated();
        if ($request->hasFile('avatar-new')) {
            Storage::disk('public')->delete($arr['avatar']);
            $path = Storage::disk('public')->putFile('account/admin', $arr['avatar-new']);
            $arr = $request->except(['_token', '_method', 'avatar-new']);
            $arr['avatar'] = $path;
        }
        $this->model->where('id', $memberId)->update($arr);
        return response()->json('success', 200);
    }

    public function destroy(DestroyRequest $request, $memberId)
    {
        $arr = $this->model->where('id', $memberId)->first();
        Storage::disk('public')->delete($arr->avatar);
        $this->model->find($memberId)->delete();
        $this->model->where('id', $memberId)->delete();
        return response()->json('success', 200);
    }

    public function demo()
    {
        return view('account.admin.demo');
    }

    public function chart(Request $request)
    {
        $max_date = $request->get('max_date');
        $results = Order::query()
            ->select(['order_details.product_id as id', 'products.name as name', DB::raw('DATE_FORMAT(orders.created_at, "%e-%m")as create_date'), DB::raw('sum(total_price) as total')])
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->where('orders.status', '=', 2)
            ->whereDate('orders.created_at', '>=', Carbon::now()->subDays($max_date))
            ->groupBy(['order_details.product_id', 'products.name', DB::raw('DATE_FORMAT(orders.created_at, "%e-%m")')])
            ->get();

        $arr = [];
        $last_month = date('m',strtotime('-1 month'));
        $today = date('d');
        $month = date('m');
        $date_number = $max_date - $today;
        $date_month_year_ago = date('Y-m-d', strtotime('-1 month'));
        $max_date_last_month = (new DateTime($date_month_year_ago))->format('t');
        $star_date_last_month = $max_date_last_month - $date_number;

        foreach ($results as $each) {
            $id = $each['id'];
            if (empty($arr[$id])) {
                $arr[$id] = [
                    'name' => $each['name'],
                    'y' => (float) $each['total'],
                    'drilldown' => (int) $id,
                ];
            } else {
                $arr[$id]['y'] += (double)$each['total'];
            }
        }
        $arr_details = [];
        foreach ($arr as $id => $each) {
            $arr_details[$id] = [
                'name' => $each['name'],
                'id' => $id,
            ];

            $arr_details[$id]['data'] = [];
            if ($today < $max_date) {
                for($j = $star_date_last_month; $j <= $max_date_last_month; $j++) {

                    $key = $j . '-' . $last_month;

                    $arr_details[$id]['data'][$key] = [
                        $key,
                        0
                    ];
                }
            }

            for ($i = 1; $i <= $today; $i++) {
                $key = $i . '-' . $month;

                $arr_details[$id]['data'][$key] = [
                    $key,
                    0
                ];
            }
        }

        foreach($results as $each)
        {
            $id = $each['id'];
            $key = $each['created_date'];
            $arr_details[$id]['data'][$key] = [
                $key,
                (double)$each['total'],
            ];
        }
        return response()->json([
            $arr,
            $arr_details,
        ], 200);
    }
}
