<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Sabberworm\CSS\Value\URL;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:admin');
  }


  public function index(){
    $breadcrumbs = [
      ['link'=>route('admin.product.brand.index'),'name'=> __('general.dashboard')], ['name'=> __('general.brands')]
    ];
    return view('admin.brand.index', [
      'breadcrumbs' => $breadcrumbs
    ]);
  }

  public function datatable(Request $request) {
    $brands = Brand::all();
    return DataTables::of($brands)
      ->editColumn('created_at', function ($brand) {
        return formatLongDate($brand->created_at);
      })
      ->editColumn('brand_image', function ($brand) {
        $url = asset('uploads/brands/'. $brand->brand_image);
        return '<img width="100%" src="'. $url .'" alt="'. $brand->brand_name .'">';
      })
      ->editColumn('about', function ($brand){
        return Str::limit($brand->about, 100, '...');
      })
      ->addColumn('checkbox', function ($brand) {
        return '';
      })
      ->addColumn('actions', function ($brand) {
        $actions = '';
        $actions .= '<a href="javascript:void(0)" id="edit" data-id="'.$brand->id.'" class="mr-1"><span class="text-warning"><i class="feather icon-edit"></i></span></a>';
        $actions .= '<a href="javascript:void(0)" id="delete" data-id="'.$brand->id.'"><span class="text-danger"><i class="feather icon-trash"></i></span></a>';
        return $actions;
      })
      ->rawColumns(['brand_image', 'about', 'actions'])
      ->make(true);
  }

  public function store(Request $request){
    $rules = [
      'brand_name' => 'required|max:255',
      'category'     => 'required',
      'brand_image' => 'required'
    ];
    $message = [
      'category.required' => "Please, select category...",
      'brand_name.required' => "Brand name cannot be blank!",
      'brand_name.max' => "Brand name must be less than 255 characters!",
      'brand_image.required' => "Brand image is required",
    ];
    $validator = \Validator::make($request->all(), $rules, $message);
    if ($validator->fails()){
      return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
    }

    $brand = new Brand();
    $brand->brand_name = $request->input('brand_name');
    $brand->category = $request->input('category');
    $brand->about = $request->input('about');
    $brand->url = $request->input('url');
    if($request->hasFile('brand_image')){
      $image = $request->file('brand_image');
      $filename =  $image->getClientOriginalName();
      $filename = date('Y-m-d') . '-' . time() . '-' . $filename;
      $image->move(public_path('uploads/brands'), $filename);
      $brand->brand_image = $filename;
    }
    $brand->save();
    return response()->json([
      'message' => "Your data was created.",
      'status' => 201
    ]);
  }
}
