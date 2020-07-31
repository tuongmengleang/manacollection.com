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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        $subcategories = ProductSubcategory::all();
        $brands = Brand::all()->groupBy('category');
        $breadcrumbs = [
            ['link'=>route('admin.product.index'),'name'=> __('general.dashboard')], ['name'=> __('general.products')]
        ];
        return view('admin.product.index', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
        ]);
    }

    public function datatable(Request $request) {
        $products = Product::all();
        return DataTables::of($products)
            ->editColumn('created_at', function ($product) {
                return formatLongDate($product->created_at);
            })
            ->addColumn('checkbox', function ($product) {
                return '';
            })
//            ->addColumn('photos', function ($product) {
//              return '<a href="javascript:void(0)" id="upload_images" data-id="'.$product->id.'" class="mr-1 btn btn-outline-bitbucket"><span class="text-success"><i class="feather icon-image" style="font-size: 18px"></i>Photos</span></a>';
//            })
            ->addColumn('cost_price', function ($product){
                  return '$ ' . number_format($product->cost_price, 2);
            })
            ->addColumn('sale_price', function ($product){
              return '$ ' . number_format($product->sale_price, 2);
            })
            ->addColumn('discount', function ($product){
                if ($product->discount == 1){
                    $discount = '<a href="javascript:void(0)" class=""><span class="text-success"><i class="feather icon-check"></i></span></a>';
                }
                else{
                    $discount = '<a href="javascript:void(0)" class=""><span class="text-warning"><i class="feather icon-x"></i></span></a>';
                }
                return $discount;
            })
            ->addColumn('discount_amount', function ($product){
              return '% ' . number_format($product->discount_amount);
            })
            ->addColumn('status', function ($product){
                if ($product->status == 1){
                    $switch = '<div class="custom-control custom-switch mr-2 mb-1">
                                    <input type="checkbox" class="custom-control-input" data-id="'.$product->id.'" name="status" id="'.$product->id.'" checked>
                                    <label class="custom-control-label" for="'.$product->id.'">
                                        <span class="switch-text-left">On</span>
                                        <span class="switch-text-right">Off</span>
                                    </label>
                                </div>';
                }
                else{
                    $switch = '<div class="custom-control custom-switch mr-2 mb-1">
                                    <input type="checkbox" class="custom-control-input" data-id="'.$product->id.'" name="status" id="'.$product->id.'">
                                    <label class="custom-control-label" for="'.$product->id.'">
                                        <span class="switch-text-left">On</span>
                                        <span class="switch-text-right">Off</span>
                                    </label>
                                </div>';
                }
                return $switch;
            })
            ->addColumn('actions', function ($product) {
                $actions = '';
                $actions .= '<a href="javascript:void(0)" id="view" data-id="'.$product->id.'" class="mr-1"><span class="text-success"><i class="feather icon-eye"></i></span></a>';
                $actions .= '<a href="javascript:void(0)" id="edit" data-id="'.$product->id.'" class="mr-1"><span class="text-warning"><i class="feather icon-edit"></i></span></a>';
                $actions .= '<a href="javascript:void(0)" id="delete" data-id="'.$product->id.'"><span class="text-danger"><i class="feather icon-trash"></i></span></a>';
                return $actions;
            })
            ->rawColumns(['status', 'discount', 'actions'])
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
        $id = $request->input('id');
        $code = $request->input('code');
        $name = $request->input('name');
        $cost_price = $request->input('cost_price');
        $sale_price = $request->input('sale_price');
        $discount = $request->input('discount');
        $discount_amount = $request->input('discount_amount');
        $category = $request->input('category');
        $subcategory = $request->input('subcategory');
        $hidden_subcategory = $request->input('hidden_subcategory');
        $brand = $request->input('brand');
        $remark = $request->input('remark');
        $video_link = $request->input('video_link');
        if ($id == ''){
            if ($discount){
                $rules = [
                  "code" => "required",
                  "name" => "required",
                  "cost_price" => "required",
                  "sale_price" => "required",
                  "discount_amount" => "required",
                  "category" => "required",
                  "subcategory" => "required",
                  "brand" => "required",
                  "photos" => "required"
                ];
                $message = [
                  'code.required' => "Product code cannot be blank!",
                  'name.required' => "Product name cannot be blank!",
                  'cost_price.required' => "Please input cost price",
                  'sale_price.required' => "Please input sale price",
                  'discount_amount.required' => "Discount amount cannot be blank!",
                  'category.required' => "Please, select category...",
                  'subcategory.required' => "Please, select subcategory...",
                  'brand.required' => "Please, select brand...",
                  'photos.required' => "Product photo is required",
                  'photos.mimes' => "Only file with the following extensions is allowed : .jpeg .jpg .png .gif.",
                ];
            }
            else{
                $rules = [
                  "code" => "required",
                  "name" => "required",
                  "cost_price" => "required",
                  "sale_price" => "required",
                  "category" => "required",
                  "subcategory" => "required",
                  "brand" => "required",
                  "photos" => "required"
                ];
                $message = [
                  'code.required' => "Product code cannot be blank!",
                  'name.required' => "Product name cannot be blank!",
                  'cost_price.required' => "Please input cost price",
                  'sale_price.required' => "Please input sale price",
                  'category.required' => "Please, select category...",
                  'subcategory.required' => "Please, select subcategory...",
                  'brand.required' => "Please, select brand...",
                  'photos.required' => "Product photo is required",
                  'photos.mimes' => "Only file with the following extensions is allowed : .jpeg .jpg .png .gif.",
                ];
            }
            $validator = \Validator::make($request->all(), $rules, $message);
            if ($validator->fails()){
                return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
            }
            $product = new Product();
            // store foreign key
            $product->product_category_id = $category;
            $product->product_subcategory_id = $subcategory;
            $product->brand_id = $brand;
            // store local column
            $product->code = $code;
            $product->name = $name;
            $product->cost_price = trim($cost_price,'$');
            $product->sale_price = trim($sale_price, '$');
            if ($discount){
                $product->discount = 1;
                $product->discount_amount = trim($discount_amount, '%');
            }
            else{
              $product->discount = 0;
              $product->discount_amount = null;
            }
            $product->remark = $remark;
            $product->status = 1;
            $product->video_link = $video_link;
            $product->save();

            // store photos
            $product_id = $product->id;
            if ($request->hasFile('photos')){
                foreach ($request->file('photos') as $photo){
                    $filename = date('Y-m-d') . '-' . time() . '-' . $photo->getClientOriginalName() . '.' . $photo->getClientOriginalExtension();
                    $image_original = Image::make($photo->path());
                    $path = product_image_path().'/'.$filename;
                    $image_original->save($path);
                    ProductImage::create([
                      'product_id' => $product_id,
                      'original_images' => $filename,
                    ]);
                }
            }
            return response()->json([
                'message' => "Your product was created.",
                'status' => 201
            ]);
        }
        else{
            try{
                $update_product = Product::findOrFail($id);
                if  ($discount){
                  $rules = [
                    "code" => "required",
                    "name" => "required",
                    "cost_price" => "required",
                    "sale_price" => "required",
                    "discount_amount" => "required",
                    "category" => "required",
                    // "subcategory" => "required",
                    "brand" => "required",
                    // "photos" => "required"
                  ];
                  $message = [
                    'code.required' => "Product code cannot be blank!",
                    'name.required' => "Product name cannot be blank!",
                    'cost_price.required' => "Please input cost price",
                    'sale_price.required' => "Please input sale price",
                    'discount_amount.required' => "Discount amount cannot be blank!",
                    'category.required' => "Please, select category...",
                    'subcategory.required' => "Please, select subcategory...",
                    'brand.required' => "Please, select brand...",
                    'photos.required' => "Product photo is required",
                    'photos.mimes' => "Only file with the following extensions is allowed : .jpeg .jpg .png .gif.",
                  ];
                  $validator = \Validator::make($request->all(), $rules, $message);
                  if ($validator->fails()){
                    return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
                  }
                }
                else{
                  $rules = [
                    "code" => "required",
                    "name" => "required",
                    "cost_price" => "required",
                    "sale_price" => "required",
                    // "discount_amount" => "required",
                    "category" => "required",
                    // "subcategory" => "required",
                    "brand" => "required",
                    // "photos" => "required"
                  ];
                  $message = [
                    'code.required' => "Product code cannot be blank!",
                    'name.required' => "Product name cannot be blank!",
                    'cost_price.required' => "Please input cost price",
                    'sale_price.required' => "Please input sale price",
                    'discount_amount.required' => "Discount amount cannot be blank!",
                    'category.required' => "Please, select category...",
                    'subcategory.required' => "Please, select subcategory...",
                    'brand.required' => "Please, select brand...",
                    'photos.required' => "Product photo is required",
                    'photos.mimes' => "Only file with the following extensions is allowed : .jpeg .jpg .png .gif.",
                  ];
                  $validator = \Validator::make($request->all(), $rules, $message);
                  if ($validator->fails()){
                    return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
                  }
                }
                if ($hidden_subcategory){
                    $rules = [
                      "code" => "required",
                      "name" => "required",
                      "cost_price" => "required",
                      "sale_price" => "required",
                      // "discount_amount" => "required",
                      "category" => "required",
                      // "subcategory" => "required",
                      "brand" => "required",
                      // "photos" => "required"
                    ];
                    $message = [
                      'code.required' => "Product code cannot be blank!",
                      'name.required' => "Product name cannot be blank!",
                      'cost_price.required' => "Please input cost price",
                      'sale_price.required' => "Please input sale price",
                      'discount_amount.required' => "Discount amount cannot be blank!",
                      'category.required' => "Please, select category...",
                      'subcategory.required' => "Please, select subcategory...",
                      'brand.required' => "Please, select brand...",
                      'photos.required' => "Product photo is required",
                      'photos.mimes' => "Only file with the following extensions is allowed : .jpeg .jpg .png .gif.",
                    ];
                    $validator = \Validator::make($request->all(), $rules, $message);
                    if ($validator->fails()){
                      return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
                    }
                    // Update field
                    // store foreign key
                    $update_product->product_category_id = $category;
                    $update_product->product_subcategory_id = $hidden_subcategory;
                    $update_product->brand_id = $brand;
                    // store local column
                    $update_product->code = $code;
                    $update_product->name = $name;
                    $update_product->cost_price = trim($cost_price,'$');
                    $update_product->sale_price = trim($sale_price, '$');
                    if ($discount){
                      $update_product->discount = 1;
                      $update_product->discount_amount = trim($discount_amount, '%');
                    }
                    else{
                      $update_product->discount = 0;
                      $update_product->discount_amount = null;
                    }
                    $update_product->remark = $remark;
                    $update_product->video_link = $video_link;
                    $update_product->save();
                    // store photos
                    if ($request->hasFile('photos')){
                      foreach ($request->file('photos') as $photo){
                        $filename = date('Y-m-d') . '-' . time() . '-' . $photo->getClientOriginalName() . '.' . $photo->getClientOriginalExtension();
                        $image_original = Image::make($photo->path());
                        $path = product_image_path().'/'.$filename;
                        $image_original->save($path);
                        ProductImage::create([
                          'product_id' => $id,
                          'original_images' => $filename,
                        ]);
                      }
                    }
                }
                else{
                  $rules = [
                    "code" => "required",
                    "name" => "required",
                    "cost_price" => "required",
                    "sale_price" => "required",
                    // "discount_amount" => "required",
                    "category" => "required",
                    "subcategory" => "required",
                    "brand" => "required",
                    // "photos" => "required"
                  ];
                  $message = [
                    'code.required' => "Product code cannot be blank!",
                    'name.required' => "Product name cannot be blank!",
                    'cost_price.required' => "Please input cost price",
                    'sale_price.required' => "Please input sale price",
                    'discount_amount.required' => "Discount amount cannot be blank!",
                    'category.required' => "Please, select category...",
                    'subcategory.required' => "Please, select subcategory...",
                    'brand.required' => "Please, select brand...",
                    'photos.required' => "Product photo is required",
                    'photos.mimes' => "Only file with the following extensions is allowed : .jpeg .jpg .png .gif.",
                  ];
                  $validator = \Validator::make($request->all(), $rules, $message);
                  if ($validator->fails()){
                    return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
                  }
                  // Update field
                  // store foreign key
                  $update_product->product_category_id = $category;
                  $update_product->product_subcategory_id = $subcategory;
                  $update_product->brand_id = $brand;
                  // store local column
                  $update_product->code = $code;
                  $update_product->name = $name;
                  $update_product->cost_price = trim($cost_price,'$');
                  $update_product->sale_price = trim($sale_price, '$');
                  if ($discount){
                    $update_product->discount = 1;
                    $update_product->discount_amount = trim($discount_amount, '%');
                  }
                  else{
                    $update_product->discount = 0;
                    $update_product->discount_amount = null;
                  }
                  $update_product->remark = $remark;
                  $update_product->video_link = $video_link;
                  $update_product->save();
                  // store photos
                  if ($request->hasFile('photos')){
                    foreach ($request->file('photos') as $photo){
                      $filename = date('Y-m-d') . '-' . time() . '-' . $photo->getClientOriginalName() . '.' . $photo->getClientOriginalExtension();
                      $image_original = Image::make($photo->path());
                      $path = product_image_path().'/'.$filename;
                      $image_original->save($path);
                      ProductImage::create([
                        'product_id' => $id,
                        'original_images' => $filename,
                      ]);
                    }
                  }
                }
                return response()->json([
                  'message' => "Your product was updated.",
                  'status' => 201
                ]);
            }catch (ModelNotFoundException $e){
              return response()->json(['message', "Product Not Found!", 'status' => 403]);
            }
        }

    }

    public function imageUpload(Request $request){
        $file = $request->file('img');
//        \File::move(public_path('uploads/'), $file);
        return Storage::put('tmp', $file);
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
    public function edit(Request $request)
    {
        $id = $request->input('id');
        try{
            $product = Product::findOrFail($id);
            $product_images = ProductImage::where('product_id', $id)->get(['id', 'original_images', 'resize_image']);
            $category = $product->category;
            $subcategory = $product->subcategory;
            $brand = $product->brand;
        }catch(ModelNotFoundException $e){
            return response()->json(['message', "Product Not Found!", 'status' => 403]);
        }
        return response()->json(array(
            'product' => $product,
            'category' => $category,
            'subcategory' => $subcategory,
            'brand' => $brand,
            'product_images' => $product_images,
        ));
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
    public function destroy(Request $request)
    {
      $id = $request->input('id');
      try{
        $product = Product::findOrFail($id);
        $product->delete();
      }catch(ModelNotFoundException $e){
        return response()->json(['message', "Product Not Found!", 'status' => 403]);
      }
      return response()->json(['message' => "Product has been removed."]);
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

    public function deleteProductImage(Request $request){
        if(request()->ajax()){
            $id = $request->input('id');
            $image = ProductImage::findOrFail($id);
            try{
                $image_path = product_image_path().'/'.$image->original_images;
                unlink($image_path);
            }catch (\ErrorException $e){

            }
            $image->delete();
            return response()->json(['message'=> "Successfully deleted product image"]);
        }
    }

    public function find(Request $request){
      session()->forget('product_id');
      $id = $request->input('id');
      $pi = session()->get('product_id', $id);
      return response()->json($pi);
    }

    public function changeStatus(Request $request){
        if(request()->ajax()){
            $id = $request->input('id');
            $status = $request->input('status');
              $product = Product::where('id', $id)->first();
              $product->status = $status;
//                if($product->status === 0){
//                  $product->status = 1;
//                }
//                else{
//                  $product->status = 0;
//                }
            $product->save();
            if ($product->status == 1){
              return response()->json(['status_enabled' => "Your product is enabled."]);
            }
            else{
              return response()->json(['status_disabled' => "Your product is disabled."]);
            }
        }
    }

    public function upload(Request $request){
//        session()->forget('product_id');
        $id = $request->input('id');
        $product_id = $request->session()->get('product_id', $id);
//        if ($id){
            if($request->hasFile('images')) {
                $image = new ProductImage();
                $file = $request->file('images');
                $filename = date('Y-m-d') . '-' . time() . '-' . $file->getClientOriginalName();
                $image_original = Image::make($file->path());
                $image_original->save(public_path('uploads/' . $filename));
//                $image->product_id = $id;
//                $image->original_images = $filename;
//                $image->save();
//                DB::table('product_images')->insert([
//                    'product_id' => 1,
//                    'original_images' => $filename,
//                    'resize_image' => $filename,
//                    'created_at' => now(),
//                    'updated_at' => now()
//                ]);
                Photo::create([
                    'product_id' => 2,
                    'path' => $filename,
                ]);
//              DB::table('images')->insert([
//                'original_images' => $filename,
//                'session_id' => $product_id,
//              ]);
            }
//        }
      return response()->json($product_id);
    }

}
