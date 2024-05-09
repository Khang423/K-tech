<?php

namespace App\Http\Controllers;

use App\Http\Requests\district\StoreDistrictRequest;
use App\Http\Requests\district\UpdateDistrictRequest;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class DistrictController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new District();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        return view('address.district.index');
    }

    public function api()
    {
        return DataTables::of($this->model::query())
//            ->addColumn('edit', function ($object) {
//                return route('roles.edit', $object);
//            })
//            ->addColumn('destroy', function ($object) {
//                return route('roles.destroy', $object);
//            })
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

    public function loadDistrict(Request $request){
        $city_id = $request->input('city_id');
        $arr =  District::query()->where('city_id',$city_id)->get();
        return response()->json(
            $arr,200);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\district\StoreDistrictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistrictRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\district\UpdateDistrictRequest  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistrictRequest $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        //
    }
}
