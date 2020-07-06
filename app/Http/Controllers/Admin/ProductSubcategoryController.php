<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductSubcategoryController extends Controller
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
        $categories = ProductCategory::all()->groupBy('type_name');
        $breadcrumbs = [
            ['link'=>route('admin.dashboard'),'name'=> __('general.dashboard')], ['name'=> __('general.subcategories')]
        ];
        return view('admin.subcategory.index', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => $categories
        ]);
    }

    public function datatable(Request $request) {
        $subcategories = ProductSubcategory::all();
        return DataTables::of($subcategories)
            ->editColumn('created_at', function ($subcategory) {
                return formatLongDate($subcategory->created_at);
            })
            ->editColumn('type_name', function ($subcategory) {
              return $subcategory->categories->type_name;
            })
            ->editColumn('category_name', function ($subcategory) {
                return $subcategory->categories->category_name;
            })
            ->addColumn('checkbox', function ($subcategory) {
                return '';
            })
            ->addColumn('actions', function ($subcategory) {
                $actions = '';
                $actions .= '<a href="javascript:void(0)" id="edit" data-id="'.$subcategory->id.'" class="mr-1"><span class="text-warning"><i class="feather icon-edit"></i></span></a>';
                $actions .= '<a href="javascript:void(0)" id="delete" data-id="'.$subcategory->id.'"><span class="text-danger"><i class="feather icon-trash"></i></span></a>';
                return $actions;
            })
            ->rawColumns(['type_name', 'category_name', 'actions'])
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
          $rules = [
              'category_id' => 'required',
              'subcategory_name'     => 'required|max:255'
          ];
          $message = [
              'category_id.required' => "Please, select category...",
              'subcategory_name.required' => "Subcategory name cannot be blank!",
              'subcategory_name.max' => "Subcategory name must be less than 255 characters!",
          ];
          $validator = \Validator::make( $request->all(), $rules, $message);
          if ($validator->fails()){
              return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
          }

          $id = $request->input('id');
          if (! $request->input('id')){
              $subcategory = new ProductSubcategory();
              $subcategory->product_category_id = $request->input('category_id');
              $subcategory->subcategory_name = $request->input('subcategory_name');
              $subcategory->save();
              return response()->json([
                  'message' => "Your data was created.",
                  'status' => 201
              ]);
          }
          else{
              try{
                  $update_subcategory = ProductSubcategory::findOrFail($id);
                  $update_subcategory->product_category_id = $request->input('category_id');
                  $update_subcategory->subcategory_name = $request->input('subcategory_name');
                  $update_subcategory->save();
              }catch (ModelNotFoundException $e){
                  return response()->json(['message', "Subcategory Not Found!", 'status' => 403]);
              }
              return response()->json([
                  'message' => "Your data was updated.",
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
    public function edit(Request $request)
    {
        $id = $request->input('id');
        try{
            $category = ProductSubcategory::findOrFail($id);
        }catch (ModelNotFoundException $e){
            return response()->json(['message', "Subcategory Not Found!", 'status' => 403]);
        }
        return response()->json($category);
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
            $subcategory = ProductSubcategory::findOrFail($id);
            $subcategory->delete();
        }catch (ModelNotFoundException $e){
            return response()->json(['message', "Subcategory Not Found!", 'status' => 403]);
        }
        return response()->json(['message' => "The Subcategory has been removed."]);
    }
}
