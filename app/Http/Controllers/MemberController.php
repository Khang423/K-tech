<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\DestroyRequest;
use App\Http\Requests\admin\StoreRequest;
use App\Http\Requests\admin\UpdateRequest;
use App\Models\Member;
use App\Models\Role;
use Illuminate\Http\Request;
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
            ->query()->where('name', 'like', '%' . $request->get('q') . '%')
            ->get([
                'id',
                'name',
            ]);
    }

    public function create()
    {
        $name_role = Role::query()->get();
        return view('account.admin.create', [
            'name_role' => $name_role
        ]);

    }

    public function store(StoreRequest $request)
    {
        if($request->hasFile('avatar')){
            $path = Storage::disk('public')->putFile('account/admin', $request->file('avatar'));
            $arr = $request->validated();
            $arr['avatar'] = $path;
        }else{
            $arr = $request->validated();
            $arr['avatar'] = '';
        }
        $arr['password'] = Hash::make($request->get('password'),[
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
            $arr = $request->except([
                '_token',
                '_method',
                'avatar-new',
            ]);
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
}
