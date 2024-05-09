<?php

namespace App\Http\Controllers;

use App\Http\Requests\category\DestroyRequest;
use App\Http\Requests\category\StoreRequest;
use App\Http\Requests\category\UpdateRequest;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Category();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('product.category.index');
    }

    public function api()
    {
        return DataTables::of($this->model::query())
            ->addColumn('edit', function ($object) {
                return route('category.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('category.destroy', $object);
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
        return view('product.category.create');
    }

    public function store(StoreRequest $request)
    {
        $this->model::query()->create($request->validated());
        return response()->json('success',200);
    }


    public function show(Category $product_category)
    {

    }

    public function edit($categoryId)
    {
        $category = $this->model::query()->find($categoryId);
        return view('product.category.edit',[
            'category' => $category
        ]);
    }

    public function update(UpdateRequest $request, $categoryId)
    {
        $this->model::query()->where('id',$categoryId)->update($request->validated());
        return response()->json('success',200);
    }

    public function destroy(DestroyRequest  $request, $categoryId)
    {
        $this->model::query()->where('id',$categoryId)->delete();
        return response()->json('success',200);
    }
}
