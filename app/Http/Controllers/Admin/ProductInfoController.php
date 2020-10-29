<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\ProductStock;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductInfoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link'=>route('admin.product.info.index'),'name'=> __('general.product_info')], ['name'=> __('general.products')]
        ];

        $products = Product::with('category', 'subcategory', 'productImage')->orderBy('created_at', "DESC")->paginate(12);
        $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
            return $row->sum('quantity');
        });
        $brands = Brand::orderBy("created_at", "DESC")->get();
        $subcategories = ProductSubCategory::orderBy("created_at", "DESC")->get();

        return view('admin.product.product_info',[
            'breadcrumbs' => $breadcrumbs,
            'products' => $products,
            'brands' => $brands,
            'subcategories' => $subcategories,
            'total_quantity' => $total_quantity,
        ]);
    }

    public function pagination(Request $request){
        if($request->ajax())
        {
            $products = Product::with('category', 'subcategory', 'productImage')->orderBy('created_at', "DESC")->paginate(12);
            $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
                return $row->sum('quantity');
            });
            return view('admin.product.load_products_data', compact('products', 'total_quantity'))->render();
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (request()->ajax()){
            $rules = [
                'quantity' => "required|max:255"
            ];
            $message = [
                "quantity.required" => "The quantity is required",
            ];
            $validator = \Validator::make($request->all(), $rules, $message);
            if ($validator->fails()){
                return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
            }
            $product_id = $request->input('product_id');
            $color = $request->input('color');
            $size = $request->input('size');
            $quantity = $request->input('quantity');
            $new_product_info = new ProductInfo();
            $new_product_info->product_id = $product_id;
            $new_product_info->color = $color;
            $new_product_info->size = $size;
            $new_product_info->quantity = $quantity;
            $new_product_info->save();
            return response()->json([
                'message' => "You successfully confirm bought product.",
                'status' => 201
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fetchData(Request $request){
        if (request()->ajax()){
            $products = Product::with('category', 'subcategory', 'productImage')->orderBy('created_at', "DESC")->paginate(12);
            $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
                return $row->sum('quantity');
            });
            return response()->json(['products' => $products, 'total_quantity' => $total_quantity]);
        }
    }


    public function countStock(Request $request)
    {
        if (request()->ajax()){
            $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
              return $row->sum('quantity');
            });
            return response()->json($total_quantity);
        }
    }

    public function filterProductByname(Request $request){
        if (request()->ajax()){
            $product_name = $request->input('product_name');
            if ($product_name != ''){
                $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')->where('name', 'LIKE',"%{$product_name}%")->get();
                $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
                    return $row->sum('quantity');
                });
            }
            else{
                $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')->orderBy('created_at', "DESC")->get();
                $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
                    return $row->sum('quantity');
                });
            }
            return response()->json(['products' => $getProducts, 'total_quantity' => $total_quantity]);
        }
    }

    public function filterProductByBrand(Request $request){
        if (request()->ajax()){
            $brand_ids = $request->input('brand_ids');
            if ($brand_ids != ''){
                $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')->whereIn('brand_id', $brand_ids)->get();
                $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
                  return $row->sum('quantity');
                });
            }
            else{
                $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')->orderBy('created_at', "DESC")->get();
                $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
                  return $row->sum('quantity');
                });
            }
            return response()->json(['products' => $getProducts, 'total_quantity' => $total_quantity]);
        }
    }

    public function filterProductBySubcategory(Request $request){
        if (request()->ajax()){
            $subcategory_id = $request->input('subcategory_id');
            if ($subcategory_id != ''){
                $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')->where('product_subcategory_id', $subcategory_id)->get();
                $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
                    return $row->sum('quantity');
                });
            }
            else{
                $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')->orderBy('created_at', "DESC")->get();
                $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
                    return $row->sum('quantity');
                });
            }
            return response()->json(['products' => $getProducts, 'total_quantity' => $total_quantity]);
        }
    }

}
