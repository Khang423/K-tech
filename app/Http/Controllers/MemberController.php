<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Role;
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
        return view('member.index', [
            'name_role' => $name_role
        ]);
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
            ->where('name', 'like', '%' . $request->get('q') . '%')
            ->get([
                'id',
                'name',
            ]);
    }

    public function create()
    {
        $name_role = Role::query()->get();
        return view('member.create', [
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
        //
    }

    public function edit($member)
    {
        return view('member.edit', [
            'member' =>$this->model::query()->find($member),
        ]);
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        //
    }

    public function destroy($member)
    {

        $this->model->destroy($member);
        return redirect()->route('members.index');
    }
}
