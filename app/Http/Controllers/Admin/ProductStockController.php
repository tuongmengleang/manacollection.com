<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductStock;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;

class ProductStockController extends Controller
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
          ['link'=>route('admin.product.stock.index'),'name'=> __('general.product_stock')], ['name'=> __('general.products')]
        ];

        $products = Product::orderBy('created_at', "DESC")->get();
        $product_stocks = ProductStock::all();
        $count_quantity = $product_stocks->groupBy('product_id')->map(function ($row){
          return $row->sum('quantity');
        });
        $brands = Brand::orderBy("created_at", "DESC")->get();
        $subcategories = ProductSubCategory::orderBy("created_at", "DESC")->get();
        $types = ProductCategory::with('subcategories')->get()->groupBy('type_name');
        return view('admin.product.stock',[
          'breadcrumbs' => $breadcrumbs,
          'products' => $products,
          'product_stocks' => $product_stocks,
          'count_quantity' => $count_quantity,
          'brands' => $brands,
          'subcategories' => $subcategories,
          'types' => $types,
        ]);
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
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $rules = [
          "quantity" => "required|max:255"
        ];
        $message = [
          "quantity.required" => "Product quantity is required"
        ];
        $validator = \Validator::make($request->all(), $rules, $message);
        if ($validator->fails()){
          return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
        }
        $addStock = new ProductStock();

        $stock = ProductStock::where('product_id', $product_id)->first();
        if($stock){
          $stock->increment('quantity', $quantity);
        }
        else{
          $addStock->product_id = $product_id;
          $addStock->quantity = $quantity;
          $addStock->save();
        }

        return response()->json([
          'message' => "You successfully confirm bought product.",
          'status' => 201
        ]);
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
    //          $products = Product::where('id', '>', $request->id)->get();
            $products = Product::with('category', 'subcategory', 'productImage', 'productStock')->orderBy('created_at', "DESC")->get();
            $count_quantity = ProductStock::all()->groupBy('product_id')->map(function ($row){
              return $row->sum('quantity');
            });
            return response()->json($products);
        }
      }

    public function countStock(Request $request)
    {
        if (request()->ajax()){
            $id = $request->input('id');
            $product_stocks = ProductStock::where('product_id', $id)->get();
            foreach ($product_stocks as $product_stock){
              $quantity = $product_stock->quantity;
            }
            $data = $product_stocks->groupBy('product_id')->map(function ($row){
                return $row->sum('quantity');
            });
            return response()->json($quantity);
        }

    }

    public function filterByBrand(Request $request){
        if (request()->ajax()){
            $subcategory_id = $request->input('subcategory_id');
            $brand_ids = $request->input('brand_ids');
            if ($brand_ids != ''){
              $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')->whereIn('brand_id', $brand_ids)->get();
            }
            elseif ($subcategory_id != ''){
              $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')->where('product_subcategory_id', $subcategory_id)->get();
            }
            elseif ($brand_ids != '' && $subcategory_id != ''){
              $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')
                ->where('product_subcategory_id', $subcategory_id)
                ->where('brand_id', $brand_ids)
                ->get();
            }
            else{
              $getProducts = Product::with('category', 'subcategory', 'productImage', 'productStock')->orderBy('created_at', "DESC")->get();
            }
            return response()->json($getProducts);
        }
    }

}
