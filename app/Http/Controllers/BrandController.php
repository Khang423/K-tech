<?php

namespace App\Http\Controllers;

use App\Http\Requests\brand\StoreRequest;
use App\Http\Requests\brand\UpdateRequest;
use App\Http\Requests\category\DestroyRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Brand();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('brand.index');
    }

    public function api()
    {
        return DataTables::of($this->model::query())
            ->addColumn('edit', function ($object) {
                return route('brand.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('brand.destroy', $object);
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
        return view('brand.create');
    }

    public function store(StoreRequest $request)
    {
        $this->model::query()->create($request->validated());
        return response()->json('success',200);
    }


    public function show( )
    {

    }

    public function edit($brandId)
    {
        $brand = $this->model::query()->find($brandId);
        return view('brand.edit',[
            'brand' => $brand
        ]);
    }

    public function update(UpdateRequest $request, $brandId)
    {
        $this->model::query()->where('id',$brandId)->update($request->validated());
        return response()->json('success',200);
    }

    public function destroy(DestroyRequest  $request, $brandId)
    {
        $this->model::query()->where('id',$brandId)->delete();
        return response()->json('success',200);
    }
}
