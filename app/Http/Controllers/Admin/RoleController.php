<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function index(){
        $breadcrumbs = [
            ['link'=>route('admin.role.index'),'name'=> __('general.dashboard')], ['name'=> __('general.permissions')]
        ];
        return view('admin.roles.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function datatable(Request $request) {
        $roles = Role::all();
        return DataTables::of($roles)
            ->editColumn('created_at', function ($role) {
                return formatLongDate($role->created_at);
            })
            ->addColumn('checkbox', function ($role) {
                return '';
            })
            ->addColumn('permissions', function ($role) {
                $options = '';
                foreach ($role->permissions->pluck('display_name') as $permission) {
//                    $options .= '<span class="badge badge-info">'. $permission .'</span>' . '</br>';
                    $options .=
                        '<div class="chip chip-info">
                            <div class="chip-body">
                                <div class="chip-text">'. $permission .'</div>
                            </div>
                        </div>';
                }
                return $options;
            })
            ->addColumn('actions', function ($role) {
                $actions = '';
                $actions .= '<a href="javascript:void(0)" data-id="'.$role->id.'" class="mr-1 edit-role"><span class="text-warning"><i class="feather icon-edit"></i></span></a>';
                $actions .= '<a href="javascript:void(0)" data-id="'.$role->id.'" class="delete-role"><span class="text-danger"><i class="feather icon-trash"></i></span></a>';
                return $actions;
            })
            ->rawColumns(['permissions', 'actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'permissions' => 'required'
        ];
        $message = [
            'name.required' => "Role name cannot be blank!",
            'name.max' => "Role name must be less than 255 characters!",
            'permissions.required' => "Please select Permissions",
        ];
        $validator = \Validator::make( $request->all(), $rules, $message);
        if ($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
        }

        $id = $request->input('id');
        $permissions = $request->input('permissions');
        if (! $request->input('id')){
            $role = new Role();
            $guard_name = 'admin';
            $role->name = $request->input('name');;
            $role->display_name = $request->input('display_name');;
            $role->guard_name = $guard_name;
            $role->save();
            $role->givePermissionTo($permissions);
            return response()->json([
                'message' => "Your data was created.",
                'status' => 201
            ]);
        }
        else{
            try{
                $update_role = Role::findOrFail($id);
                $update_role->name = $request->input('name');;
                $update_role->display_name = $request->input('display_name');;
                $update_role->save();
                $update_role->syncPermissions($permissions);
            }catch (ModelNotFoundException $e){
                return response()->json(['message', "Permission Not Found!", 'status' => 403]);
            }
            return response()->json([
                'message' => "Your data was updated.",
                'status' => 201
            ]);
        }
    }

    public function edit(Request $request)
    {
      $id = $request->input('id');
      try{
        $role = Role::findOrFail($id);
        $permissions = $role->permissions->pluck('display_name', 'name')->all();
      }catch (ModelNotFoundException $e){
        return response()->json(['message', "Role Not Found!", 'status' => 403]);
      }
      return response()->json($role);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        try{
            $permission = Role::findOrFail($id);
            $permission->delete();
        }catch (ModelNotFoundException $e){
            return response()->json(['message', "Role Not Found!", 'status' => 403]);
        }
        return response()->json(['message' => "The Role has been removed."]);
    }

    public function getPermissions(){
        $permissions = Permission::get()->pluck('display_name', 'name');
        return response()->json($permissions);
    }
}
