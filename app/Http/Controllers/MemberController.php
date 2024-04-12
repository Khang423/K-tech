<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\StoreMemberRequest;
use App\Http\Requests\admin\UpdateMemberRequest;
use App\Models\Member;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
        $name_role = Role::pluck('name');
        return view('admin.member.index', [
            'name_role' => $name_role
        ]);
    }

    public function api()
    {
        return DataTables::of($this->model::query()->with('role'))
            ->editcolumn('roles_id', function ($object) {
                return $object->role->name;
            })
            ->editColumn('updated_at', function ($object) {
                return $object->updated_at->format('H:i:s d-m-Y');
            })
            ->editColumn('created_at', function ($object) {
                return $object->updated_at->format('H:i:s d-m-Y');
            })
            ->addColumn('edit', function ($object) {
                return route('members.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('members.destroy', $object);
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
        return view('admin.member.create', [
            'name_role' => $name_role
        ]);

    }

    public function store(StoreMemberRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('members.index');
    }

    public function show(Member $member)
    {
    }

    public function edit($member)
    {
        return view('admin.member.edit', [
            'member' =>$this->model::query()->find($member),
        ]);
    }

    public function update(Request $request,$memberId)
    {
        $object = $this->model::query()->find($memberId);
        $object->fill($request->all());
        $object->save();
        //$this->model->update($request->validated());
        return redirect()->route('members.index');
    }

    public function destroy($member)
    {
        $this->model->destroy($member);
        return redirect()->route('members.index');
    }
}
