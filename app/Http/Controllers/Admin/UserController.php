<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminsExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function index(){
      $roles = Role::get()->pluck('display_name', 'name');
      $breadcrumbs = [
          ['link'=>route('admin.dashboard'),'name'=> __('general.dashboard')], ['name'=> __('general.users_management')]
      ];
      return view('admin.users.index', [
          'breadcrumbs' => $breadcrumbs,
          'roles' => $roles,
      ]);
  }

  public function datatable(Request $request) {
    $admins = Admin::all();
    return DataTables::of($admins)

      ->editColumn('created_at', function ($admin) {
        return formatLongDate($admin->created_at);
      })
      ->editColumn('avatar', function ($admin) {
        return '<div class="avatar avatar-lg">
                    <img src="'. $admin->avatar .'" alt="'. $admin->name .'">
                </div>';
      })
      ->editColumn('active', function ($admin) {
        return $admin->active_badge;
      })
      ->addColumn('checkbox', function ($admin) {
        return '';
      })
      ->addColumn('role', function ($admin) {
        return $admin->role_badge;
      })
      ->addColumn('actions', function ($admin) {
        $actions = '';
        $actions .= '<a href="javascript:void(0)" data-id="'.$admin->id.'" class="mr-1 edit text-warning"><span><i class="feather icon-edit"></i></span></a>';
        $actions .= '<a href="javascript:void(0)" data-id="'.$admin->id.'" class="delete text-danger"><span><i class="feather icon-trash"></i></span></a>';
        return $actions;
      })
      ->rawColumns(['avatar', 'active', 'role', 'actions'])
      ->make(true);
  }

  public function export($type)
  {
    if ($type == 'pdf') {
        $rows = Admin::all();
        $pdf = PDF::loadView('admin.users.export', compact('rows'));

        return $pdf->download('admins_'.time().'.pdf');

//      return view('admin.users.export')->withRows($rows);
//      return (new AdminsExport)->download('admins_'.time().'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    } else {
      return Excel::download(new AdminsExport, 'admins_'.time().'.xlsx');
    }
  }

  public function store(Request $request){
    $id = $request->input('id');
    $password = bcrypt($request->input('password'));
    if (! $request->input('id')){
      $rules = [
        'name'  => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'assign_role' => 'required',
      ];
      $message = [
        'name.required' => "Name cannot be blank!",
        'name.max' => "Name must be less than 255 characters!",
        'email.required' => "Email cannot be blank!",
        'email.email' => "Email is invalid!",
        'email.unique' => "Email has already!",
        'password.required' => "Password cannot be empty!",
        'password.min' => "Password must be at least 8 characters",
        'assign_role.required' => "Please select role to assign!",
      ];
      $validator = \Validator::make( $request->all(), $rules, $message);
      if ($validator->fails()){
        return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
      }
      $admin = new Admin();
      $active = 1;
      $admin->name = $request->input('name');;
      $admin->email = $request->input('email');;
      $admin->password = $password;
      $admin->active = $active;
      $admin->save();
      $roles = $request->input('assign_role');
      $admin->assignRole($roles);
      return response()->json([
        'message' => "Your data was created.",
        'status' => 201
      ]);
    }
    else{
      $rules = [
        'name'  => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'assign_role' => 'required',
      ];
      $message = [
        'name.required' => "Name cannot be blank!",
        'name.max' => "Name must be less than 255 characters!",
        'email.required' => "Email cannot be blank!",
        'email.email' => "Email is invalid!",
        'email.unique' => "Email has already!",
        'assign_role.required' => "Please select role to assign!",
      ];
      $validator = \Validator::make( $request->all(), $rules, $message);
      if ($validator->fails()){
        return response()->json(['errors'=> $validator->getMessageBag()->toarray(), 'status' => 403]);
      }
      try{
        $update_admin = Admin::findOrFail($id);
        $update_admin->name = $request->input('name');;
        $update_admin->email = $request->input('email');;
        $update_admin->password = $password;
        $update_admin->save();
        $roles = $request->input('assign_role');
        $update_admin->syncRoles($roles);
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
      $admin = Admin::findOrFail($id);
      $userRole = $admin->roles->pluck('display_name', 'name')->all();
    }catch (ModelNotFoundException $e){
      return response()->json(['message', "User Not Found!", 'status' => 403]);
    }
    return response()->json(['user' => $admin]);
  }

  public function destroy(Request $request)
  {
    $id = $request->input('id');
    try{
      $admin = Admin::findOrFail($id);
      $admin->delete();
    }catch (ModelNotFoundException $e){
      return response()->json(['message', "User Not Found!", 'status' => 403]);
    }
    return response()->json(['message' => "The User has been removed."]);
  }


}
