<?php

namespace App\Http\Controllers;

use App\Http\Requests\staff\DestroyRequest;
use App\Http\Requests\staff\StoreRequest;
use App\Http\Requests\staff\UpdateRequest;
use App\Models\Member;
use App\Models\Role;
use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class StaffController extends Controller
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
        $name_role = Role::query()->get();
        return view('account.staff.index', [
            'name_role' => $name_role
        ]);
    }

    public function api()
    {
        $data = $this->model::query()->where('role_id', 2)->with('role');
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
                return route('staff.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('staff.destroy', $object);
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
        $name_role = Role::query()->get();
        return view('account.staff.create', [
            'name_role' => $name_role
        ]);

    }

    public function store(StoreRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->putFile('account/staff', $request->file('avatar'));
            $arr = $request->validated();
            $arr['avatar'] = $path;
            $arr['password'] = Hash::make($request->get('password'), [
                'rounds' => 12,
            ]);
        } else {
            $arr = $request->validated();
            $arr['avatar'] = '';
            $arr['password'] = Hash::make($request->get('password'), [
                'rounds' => 12,
            ]);
        }

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
        return view('account.staff.edit', [
            'staff' => $this->model::query()->find($member),
            'name_role' => $name_role,
        ]);
    }

    public function update(UpdateRequest $request, $staffId)
    {
        $arr = $request->validated();
        if ($request->hasFile('avatar-new')) {
            Storage::disk('public')->delete($arr['avatar']);
            $path = Storage::disk('public')->putFile('account/staff', $arr['avatar-new']);
            $arr = $request->except([
                '_token',
                '_method',
                'avatar-new',
            ]);
            $arr['avatar'] = $path;
        }
        $this->model->where('id', $staffId)->update($arr);
        return redirect()->route('staff.index');
    }

    public function destroy(DestroyRequest $request, $staffId)
    {
        $arr = $this->model->where('id', $staffId)->first();
        Storage::disk('public')->delete($arr->avatar);
        $this->model->find($staffId)->delete();
        $this->model->where('id', $staffId)->delete();
        return response()->json('success', 200);
    }
}
