<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminsExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
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
      $breadcrumbs = [
          ['link'=>route('admin.dashboard'),'name'=> __('general.dashboard')], ['name'=> __('general.users_management')]
      ];
      return view('admin.users.index', [
          'breadcrumbs' => $breadcrumbs
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
        $actions .= '<a href="javascript:void(0)" class="mr-1"><span><i class="feather icon-edit"></i></span></a>';
        $actions .= '<a href="javascript:void(0)"><span><i class="feather icon-trash"></i></span></a>';
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

}
