<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
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

      if ($request->hasFile('photos')){
        $photos = $request->file(photos);
//        foreach ($request->file('photos') as $photo){
//          $filename =  $photo->getClientOriginalName();
//          $filename = date('Y-m-d') . '-' . time() . '-' . $filename;
//          $image_original = Image::make($photo->path());
//          $path = product_image_path().'/'.$filename;
//          $image_original->save($path);
//          return response()->json($filename);
//        }
        return response()->json($photos);
      }

//        $id = $request->input('id');
//        $code = $request->input('code');
//        $name = $request->input('name');
//        $cost_price = $request->input('cost_price');
//        $sale_price = $request->input('sale_price');
//        $discount = $request->input('discount');
//        $discount_amount = $request->input('discount_amount');
//        $category = $request->input('category');
//        $subcategory = $request->input('subcategory');
//        $brand = $request->input('brand');
//        $remark = $request->input('remark');
//        $video_link = $request->input('video_link');
//        if ($id == ''){
//            $rules = [
//                "code" => "required",
//                "name" => "required",
//                "cost_price" => "required",
//                "sale_price" => "required",
//                "category" => "required",
//                "subcategory" => "required",
//                "brand" => "required",
//                "photos" => "required|mimes:jpeg,jpg,png,gif"
//            ];
//            $message = [
//                'code.required' => "Product code cannot be blank!",
//                'name.required' => "Product name cannot be blank!",
//                'cost_price.required' => "Please input cost price",
//                'sale_price.required' => "Please input sale price",
//                'category.required' => "Please, select category...",
//                'subcategory.required' => "Please, select subcategory...",
//                'brand.required' => "Please, select brand...",
//                'photos.required' => "Product photo is required",
//                'photos.mimes' => "Only file with the following extensions is allowed : .jpeg .jpg .png .gif.",
//            ];
//            $validator = \Validator::make($request->all(), $rules, $message);
//            if ($validator->fails()){
//                return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
//            }
//            $product = new Product();
//            // store foreign key
//            $product->product_category_id = $category;
//            $product->product_subcategory_id = $subcategory;
//            $product->brand_id = $brand;
//            // store local column
//            $product->code = $code;
//            $product->name = $name;
//            $product->cost_price = trim($cost_price,'$');
//            $product->sale_price = trim($sale_price, '$');
//            if ($discount){
//                $product->discount = 1;
//                $product->discount_amount = trim($discount_amount, '%');
//            }
//            else{
//              $product->discount = 0;
//              $product->discount_amount = null;
//            }
//            $product->remark = $remark;
//            $product->status = 1;
//            $product->video_link = $video_link;
//            $product->save();
//
//            // store photos
//            $product_id = $product->id;
//            if ($request->hasFile('photos')){
//                foreach ($request->file('photos') as $photo){
//                    $filename =  $photo->getClientOriginalName();
//                    $filename = date('Y-m-d') . '-' . time() . '-' . $filename;
//                    $image_original = Image::make($photo->path());
//                    $path = product_image_path().'/'.$filename;
//                    $image_original->save($path);
//                    return response()->json($filename);
////                    DB::table('product_images')
////                        ->insert([
////                            'product_id' => $product_id,
////                            'original_images' => $filename,
////                        ]);
//
//                }
//            }
//        }
//        return response()->json([
//            'message' => "Your product was created.",
//            'status' => 201
//        ]);
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
