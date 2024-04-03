<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    private  $model;

    public function __construct()
    {
        $this->model = new Member();
        $routeName = Route::currentRouteName();
        $arr = explode('.',$routeName);
        $arr = array_map('ucfirst',$arr);
        $title = implode(' - ',$arr);
        View::share('title',$title);
    }
    public function index()
    {
        return view('member.index');
    }

    public function api()
    {
        return DataTables::of($this->model::query())
            ->editColumn('updated_at', function ($object) {
                return $object->updated_at->format('H:i:s d-m-Y');
            })->editColumn('created_at', function ($object) {
                return $object->updated_at->format('H:i:s d-m-Y');
            })
            ->make(true);
    }

    public function apiName(Request $request) {
        return $this->model
            ->where('name', 'like', '%'.$request->get('q').'%')
            ->get([
                'id',
                'name',
            ]);
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $this->model->create($request);
        return redirect()->route('member.index')->with('success','Thêm thành công');
    }

    public function show(Member $member)
    {
        //
    }

    public function edit(Member $member)
    {
        //
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        //
    }

    public function destroy(Member $member)
    {
        //
    }
}
