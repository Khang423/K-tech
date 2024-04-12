<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{

    private $model;
    public function __construct()
    {
        $this->model = new Role();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('admin.role.index');
    }

    public function api()
    {
        return DataTables::of($this->model::query())
            ->editColumn('updated_at', function ($object) {
                return $object->updated_at->format('H:i:s d-m-Y');
            })
            ->editColumn('created_at', function ($object) {
                return $object->updated_at->format('H:i:s d-m-Y');
            })
            ->addColumn('edit', function ($object) {
                return route('roles.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('roles.destroy', $object);
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
        return view('admin.role.create');
    }

    public function store(StoreRoleRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {

    }

    public function edit($role)
    {
        return view('admin.role.edit', [
            'role' =>$this->model::query()->find($role),
        ]);
    }

    public function update(Request $request,$role_id)
    {

        $object = $this->model::query()->find($role_id);
        $object->fill($request->all());
        $object->save();
        //$this->model->update($request->validated());
        return redirect()->route('roles.index');
    }

    public function destroy($role)
    {
        $this->model->destroy($role);
        return redirect()->route('roles.index');
            //response()->json('success',200);
            //
    }
}
