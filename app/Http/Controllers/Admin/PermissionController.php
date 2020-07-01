<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link'=>route('admin.permission.index'),'name'=> __('general.dashboard')], ['name'=> __('general.permissions')]
        ];
        return view('admin.permissions.index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function datatable(Request $request)
    {
        $permissions = Permission::all();
        return DataTables::of($permissions)
            ->editColumn('created_at', function ($permission) {
                return formatLongDate($permission->created_at);
            })
            ->addColumn('checkbox', function ($permission) {
                return '';
            })
            ->addColumn('actions', function ($permission) {
                $actions = '';
                $actions .= '<a href="javascript:void(0)" data-id="'.$permission->id.'" class="mr-1 edit-permission"><span class="text-warning"><i class="feather icon-edit"></i></span></a>';
                $actions .= '<a href="javascript:void(0)" data-id="'.$permission->id.'"  class="delete-permission"><span class="text-danger"><i class="feather icon-trash"></i></span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
          'name'       => 'required|max:255',
        ];
        $message = [
          'name.required' => "Permission name cannot be blank!",
          'name.max' => "Permission name must be less than 255 characters!",
        ];
        $validator = \Validator::make( $request->all(), $rules, $message);
        if ($validator->fails()){
          return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
        }

        $id = $request->input('id');
        if (! $request->input('id')){
            $permission = new Permission();
            $guard_name = 'admin';
            $permission->name = $request->input('name');;
            $permission->display_name = $request->input('display_name');;
            $permission->guard_name = $guard_name;
            $permission->save();
            return response()->json([
                'message' => "Your data was created.",
                'status' => 201
            ]);
        }
        else{
            try{
                $update_permission = Permission::findOrFail($id);
                $update_permission->name = $request->input('name');;
                $update_permission->display_name = $request->input('display_name');;
                $update_permission->save();
            }catch (ModelNotFoundException $e){
                return response()->json(['message', "Permission Not Found!", 'status' => 403]);
            }
            return response()->json([
                'message' => "Your data was updated.",
                'status' => 201
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        try{
            $permission = Permission::findOrFail($id);
            $permission->delete();
        }catch (ModelNotFoundException $e){
            return response()->json(['message', "Permission Not Found!", 'status' => 403]);
        }
        return response()->json(['message' => "The Permission has been removed."]);
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        try{
            $permission = Permission::findOrFail($id);
        }catch (ModelNotFoundException $e){
            return response()->json(['message', "Permission Not Found!", 'status' => 403]);
        }
        return response()->json($permission);
    }

}
