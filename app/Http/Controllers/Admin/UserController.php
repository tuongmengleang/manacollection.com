<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // 1 Column
    public function index(){
        $breadcrumbs = [
            ['link'=>route('admin.dashboard'),'name'=>"Dashboard"], ['name'=> __('general.users_management')]
        ];
        return view('admin.users.index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
