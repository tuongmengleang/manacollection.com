<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }
  public function index(){
      $breadcrumbs = [
          ['link'=>route('admin.dashboard'),'name'=>"Dashboard"], ['name'=> __('general.users_management')]
      ];
      return view('admin.users.index', [
          'breadcrumbs' => $breadcrumbs
      ]);
  }

  public function datatable(Request $request) {
    $admins = Admin::all();
    return DataTables::of($admins)
      ->editColumn('created_at', function ($admin) {
        return $admin->created_at;
      })
      ->editColumn('avatar', function ($admin) {
        return '<img src="' . $admin->avatar . '" height="64" width="64">';
      })
      ->editColumn('active', function ($admin) {
        if ($admin->active == 1) {
          $active_txt = '<span class="badge badge-success">' . __('general.active') . '</span>';
        } else {
          $active_txt = '<span class="badge badge-danger">' . __('general.inactive') . '</span>';
        }
        return $active_txt;
      })
      ->addColumn('role', function ($admin) {
        return '<span class="badge badge-info">' . $admin->role_names . '</span>';
      })
      ->addColumn('actions', function ($admin) {
        $actions = '';
        $actions .= '<a href="javascript:void(0)" class="mr-1"><span class="action-edit"><i class="feather icon-edit"></i></span></a>';
        $actions .= '<a href="javascript:void(0)"><span class="action-delete"><i class="feather icon-trash"></i></span></a>';
        return $actions;
      })
      ->rawColumns(['avatar', 'active', 'role', 'actions'])
      ->make(true);
  }

}
