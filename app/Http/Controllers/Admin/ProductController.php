<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::all()->groupBy('type_name');
        $brands = Brand::all()->groupBy('category');
        $breadcrumbs = [
            ['link'=>route('admin.product.index'),'name'=> __('general.dashboard')], ['name'=> __('general.products')]
        ];
        return view('admin.product.index', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function datatable(Request $request) {
        $products = Product::all();
        return DataTables::of($products)
            ->editColumn('created_at', function ($brand) {
                return formatLongDate($brand->created_at);
            })
            ->addColumn('checkbox', function ($brand) {
                return '';
            })
            ->addColumn('actions', function ($brand) {
                $actions = '';
                $actions .= '<a href="javascript:void(0)" id="view" data-id="'.$brand->id.'" class="mr-1"><span class="text-success"><i class="feather icon-eye"></i></span></a>';
                $actions .= '<a href="javascript:void(0)" id="edit" data-id="'.$brand->id.'" class="mr-1"><span class="text-warning"><i class="feather icon-edit"></i></span></a>';
                $actions .= '<a href="javascript:void(0)" id="delete" data-id="'.$brand->id.'"><span class="text-danger"><i class="feather icon-trash"></i></span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
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
        if ($images = $request->hasFile('images')){
          return response()->json($images);
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

    public function getSubcategory(Request $request){
        $id = $request->input('id');
        try{
          $subcategory = ProductSubcategory::select('subcategory_name','id')->where('product_category_id', $id)->get();
        }catch (ModelNotFoundException $e){
          return response()->json(['message', "Product Brand Not Found!", 'status' => 403]);
        }
        return response()->json($subcategory);
    }
}
