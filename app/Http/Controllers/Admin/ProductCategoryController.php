<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductCategoryController extends Controller
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
            ['link'=>route('admin.dashboard'),'name'=> __('general.dashboard')], ['name'=> __('general.categories')]
        ];
        return view('admin.category.index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function datatable(Request $request) {
        $categories = ProductCategory::all();
        return DataTables::of($categories)
            ->editColumn('created_at', function ($category) {
                return formatLongDate($category->created_at);
            })
            ->addColumn('checkbox', function ($category) {
                return '';
            })
            ->addColumn('actions', function ($category) {
                $actions = '';
                $actions .= '<a href="javascript:void(0)" id="edit" data-id="'.$category->id.'" class="mr-1"><span class="text-warning"><i class="feather icon-edit"></i></span></a>';
                $actions .= '<a href="javascript:void(0)" id="delete" data-id="'.$category->id.'"><span class="text-danger"><i class="feather icon-trash"></i></span></a>';
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
        $rules = [
            'category_name' => 'required|max:255',
            'type_name'     => 'required'
        ];
        $message = [
            'category_name.required' => "Category name cannot be blank!",
            'category_name.max' => "Category name must be less than 255 characters!",
            'type_name.required' => "Please, select type name!",
        ];
        $validator = \Validator::make( $request->all(), $rules, $message);
        if ($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
        }

        $id = $request->input('id');
        if (! $request->input('id')){
            $category = new ProductCategory();
            $category->category_name = $request->input('category_name');;
            $category->type_name = $request->input('type_name');;
            $category->save();
            return response()->json([
                'message' => "Your data was created.",
                'status' => 201
            ]);
        }
        else{
            try{
                $update_category = ProductCategory::findOrFail($id);
                $update_category->category_name = $request->input('category_name');;
                $update_category->type_name = $request->input('type_name');;
                $update_category->save();
            }catch (ModelNotFoundException $e){
                return response()->json(['message', "Category Not Found!", 'status' => 403]);
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
            $category = ProductCategory::findOrFail($id);
        }catch (ModelNotFoundException $e){
            return response()->json(['message', "Category Not Found!", 'status' => 403]);
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
            $category = ProductCategory::findOrFail($id);
            $category->delete();
        }catch (ModelNotFoundException $e){
            return response()->json(['message', "Category Not Found!", 'status' => 403]);
        }
        return response()->json(['message' => "The Category has been removed."]);
    }
}
