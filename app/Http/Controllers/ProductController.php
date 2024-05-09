<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\StoreProductRequest;
use App\Http\Requests\product\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Product();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }

    public function index()
    {
        return view('product.index');
    }

    public function api()
    {
        $data = $this->model::query();
        return DataTables::of($data)
            ->editcolumn('price', function ($object) {
                return number_format($object->price, 0, ',', '.');
            })
            ->addColumn('quantity', function ($object) {
                return $object->quantity;
            })
            ->editColumn('created_at', function ($object) {
                return $object->created_at->format('H:i:s d-m-Y');
            })
            ->addColumn('edit', function ($object) {
                return route('product.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('product.destroy', $object);
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
        $brand = Brand::query()->get();
        $supplier = Supplier::query()->get();
        $category = Category::query()->get();
        return view('product.create', [
            'category' => $category,
            'supplier' => $supplier,
            'brand' => $brand,
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $arrProduct = [];
            $arrProduct['name'] = $request->get('name');
            $arrProduct['price'] = $request->get('price');
            $arrProduct['category_id'] = $request->get('category_id');
            $arrProduct['brand_id'] = $request->get('brand_id');
            $arrProduct['member_id'] = session()->get('id');
            $this->model::query()->create($arrProduct);

            $product_id = $this->model->query()
                ->where('member_id', session()->get('id'))
                ->max('id');
            DB::beginTransaction();

            $arr = [];
            if ($request->file('outsite_image') !== null) {
                $path = Storage::disk('public')->putFile('product/' . $product_id, $request->file('outsite_image'));
                $arr['outsite_image'] = $path;
                $this->model::query()->where('id', $product_id)->update($arr);
            }

            $arrProductDetail = [];
            $arrProductDetail['product_id'] = $product_id;
            $arrProductDetail['graphic_card'] = $request->get('graphic_card');
            $arrProductDetail['cpu'] = $request->get('cpu');
            $arrProductDetail['ram'] = $request->get('ram');
            $arrProductDetail['ram_type'] = $request->get('ram_type');
            $arrProductDetail['ram_slot'] = $request->get('ram_slot');
            $arrProductDetail['ssd'] = $request->get('ssd');
            $arrProductDetail['touchscreen'] = $request->get('touchscreen');
            $arrProductDetail['bg_plate'] = $request->get('bg_plate');
            $arrProductDetail['scan_frequency'] = $request->get('scan_frequency');
            $arrProductDetail['screen_size'] = $request->get('screen_size');
            $arrProductDetail['screen_tech'] = $request->get('screen_tech');
            $arrProductDetail['screen_resolution'] = $request->get('screen_resolution');
            $arrProductDetail['keyboard_light'] = $request->get('keyboard_light');
            $arrProductDetail['webcam'] = $request->get('webcam');
            $arrProductDetail['operating_system'] = $request->get('operating_system');
            $arrProductDetail['bluetooth'] = $request->get('bluetooth');
            $arrProductDetail['wifi'] = $request->get('wifi');
            $arrProductDetail['audio_tech'] = $request->get('audio_tech');
            $arrProductDetail['security'] = $request->get('security');
            $arrProductDetail['connectivity'] = $request->get('connectivity');
            $arrProductDetail['describe'] = $request->get('describe');
            $arrProductDetail['weight'] = $request->get('weight');
            $arrProductDetail['battery'] = $request->get('battery');
            $arrProductDetail['cooling_system'] = $request->get('cooling_system');
            $arrProductDetail['color'] = $request->get('color');
            $arrProductDetail['material'] = $request->get('material');
            $arrProductDetail['dimension'] = $request->get('dimension');
            $arrProductDetail['release_date'] = $request->get('release_date');
            ProductDetail::query()->create($arrProductDetail);

            $arrImage = [];
            $arrImage['product_id'] = $product_id;
            $arrImage['image'] = null;
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $path = Storage::disk('public')->putFile('product/' . $product_id . '/images', $image);
                    $arrImage['image'] = $path;
                    Image::query()->create($arrImage);
                }
            }
            DB::commit();
            session()->flash('success', 'Thêm thành công !');
            return response()->json('success', 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show(Product $product)
    {

    }

    public function edit($product)
    {
        $image = Image::query()->where('product_id', $product)->get();
        $productDetail = ProductDetail::query()->where('product_id', $product)->first();
        $category = Category::query()->get();
        $brand = Brand::query()->get();
        return view('product.edit', [
                'product' => $this->model::query()->find($product),
                'category' => $category,
                'productDetail' => $productDetail,
                'image' => $image,
                'brand' => $brand,
            ]
        );
    }

    public function update(Request $request, $product)
    {
        try {
            $arrProduct = [];
            $arrProduct['name'] = $request->get('name');
            $arrProduct['price'] = $request->get('price');
            $arrProduct['category_id'] = $request->get('category_id');
            $arrProduct['brand_id'] = $request->get('brand_id');
            $arrProduct['member_id'] = session()->get('id');
            $this->model->query()->where('id', $product)->update($arrProduct);

            DB::beginTransaction();
            $img_old = $request;
            $arr = [];
            if ($request->file('outsite_image_new') !== null) {
                Storage::disk('public')->delete($img_old['outsite_image']);
                $path = Storage::disk('public')->putFile('product/' . $product, $request->file('outsite_image_new'));
                $arr['outsite_image'] = $path;
            }
            $this->model::query()->where('id', $product)->update($arr);

            $arrProductDetail = [];
            $arrProductDetail['product_id'] = $product;
            $arrProductDetail['graphic_card'] = $request->get('graphic_card');
            $arrProductDetail['cpu'] = $request->get('cpu');
            $arrProductDetail['ram'] = $request->get('ram');
            $arrProductDetail['ram_type'] = $request->get('ram_type');
            $arrProductDetail['ram_slot'] = $request->get('ram_slot');
            $arrProductDetail['ssd'] = $request->get('ssd');
            $arrProductDetail['touchscreen'] = $request->get('touchscreen');
            $arrProductDetail['bg_plate'] = $request->get('bg_plate');
            $arrProductDetail['scan_frequency'] = $request->get('scan_frequency');
            $arrProductDetail['screen_size'] = $request->get('screen_size');
            $arrProductDetail['screen_tech'] = $request->get('screen_tech');
            $arrProductDetail['screen_resolution'] = $request->get('screen_resolution');
            $arrProductDetail['keyboard_light'] = $request->get('keyboard_light');
            $arrProductDetail['webcam'] = $request->get('webcam');
            $arrProductDetail['operating_system'] = $request->get('operating_system');
            $arrProductDetail['bluetooth'] = $request->get('bluetooth');
            $arrProductDetail['wifi'] = $request->get('wifi');
            $arrProductDetail['audio_tech'] = $request->get('audio_tech');
            $arrProductDetail['security'] = $request->get('security');
            $arrProductDetail['connectivity'] = $request->get('connectivity');
            $arrProductDetail['describe'] = $request->get('describe');
            $arrProductDetail['weight'] = $request->get('weight');
            $arrProductDetail['battery'] = $request->get('battery');
            $arrProductDetail['cooling_system'] = $request->get('cooling_system');
            $arrProductDetail['color'] = $request->get('color');
            $arrProductDetail['material'] = $request->get('material');
            $arrProductDetail['dimension'] = $request->get('dimension');
            $arrProductDetail['release_date'] = $request->get('release_date');
            ProductDetail::query()->where('product_id', $product)->update($arrProductDetail);
            // kiểm tra xem có ảnh mới không
            if ($request->hasFile('image_new')) {
                $img_id = $request->get('id');
                foreach ($img_id as $key => $i) {
                    if ($request->file('image_new')[$key]) {
                        $old_image = $request->get('image')[$key];
                        Storage::disk('public')->delete($old_image);
                        $path = Storage::disk('public')->putFile('product/' . $product ,$request->file('image_new')[$key]);
                        $arr['image'] = $path;
                        Image::query()->where('id', $i)->where('product_id',$product)->update($arr);
                    }
                }
            }

            DB::commit();
            session()->flash('success', 'Thêm thành công !');
            return response()->json('success', 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 400);
        }

    }

    public function destroy(Request $request, $productId)
    {
        $product_id = $productId;
        Storage::disk('public')->deleteDirectory('product/' . $product_id);
        ProductDetail::where('product_id', $product_id)->delete();
        Image::where('product_id', $product_id)->delete();
        $this->model->where('id', $product_id)->delete();
        return response()->json('success', 200);
    }

    public function viewProduct(Product $product)
    {
        $view = ProductDetail::query()->get();
        return view('product.view', [
            'view' => $view,
            'product' => $this->model::query()->get(),
        ]);
    }
}
