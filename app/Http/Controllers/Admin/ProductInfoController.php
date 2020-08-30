<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\ProductStock;
use Illuminate\Http\Request;

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
        $products = Product::with('category', 'subcategory', 'productImage')->orderBy('created_at', "DESC")->get();

        $breadcrumbs = [
            ['link'=>route('admin.product.info.index'),'name'=> __('general.product_info')], ['name'=> __('general.products')]
        ];

        return view('admin.product.product_info',[
            'breadcrumbs' => $breadcrumbs,
            'products' => $products
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
        if (request()->ajax()){
            $rules = [
                'color' => "required|max:255",
                'size' => "required|max:255",
                'quantity' => "required|max:255"
            ];
            $message = [
                "color.required" => "The color is required",
                "size.required" => "The size is required",
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
            $products = Product::with('category', 'subcategory', 'productImage')->orderBy('created_at', "DESC")->get();
            $total_quantity = ProductInfo::all()->groupBy('product_id')->map(function ($row){
                return $row->sum('quantity');
            });
            return response()->json(['products' => $products, 'total_quantity' => $total_quantity]);
        }
    }

}
