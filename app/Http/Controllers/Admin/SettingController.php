<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings;
use Illuminate\Http\Request;
use Spatie\Valuestore\Valuestore;

class SettingController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function index() {
    $settings = Valuestore::make(storage_path('app/settings.json'));
    $breadcrumbs = [
      ['link'=>route('admin.dashboard'),'name'=> __('general.dashboard')], ['name'=> __('general.settings')]
    ];
    return view('admin.settings.index', [
      'breadcrumbs' => $breadcrumbs,
      'settings' => $settings
    ]);
  }

  public function update(Request $request, Settings $settings) {
    $settings->put('title', $request->title);
    return redirect()->back()->with(['notice' => 'Settings updated']);
  }
}
