<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    if ($request->format_date)
      $settings->put('format_date', $request->format_date);

    // Socials
    $settings->put('social_twitter', trim($request->social_twitter));
    $settings->put('social_facebook', trim($request->social_facebook));
    $settings->put('social_linkedin', trim($request->social_linkedin));
    $settings->put('social_instagram', trim($request->social_instagram));

    if ($request->hasFile('logo')) {
      $logo = $request->file('logo');
      $logo_name = time() . '.' . $logo->getClientOriginalExtension();
      $logo_path = Storage::disk('uploads')->putFileAs('logo', $logo, $logo_name);
      $settings->put('logo', 'uploads/' . $logo_path);
    }

    notify()->success('Data has been update successfully!');
    return back();
  }
}
