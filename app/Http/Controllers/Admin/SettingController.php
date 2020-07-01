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
//    dd(Storage::url(settings('logo')));
    return view('admin.settings.index', [
      'breadcrumbs' => $breadcrumbs,
      'settings' => $settings
    ]);
  }

  public function update(Request $request, Settings $settings) {

    // General
    if ($request->hasFile('logo')) {
//      $request->validate([
//        'logo' => 'required|mimes:jpeg,svg,png|size:1024',
//      ]);
      $logo = $request->file('logo');
      $logo_name = time() . '.' . $logo->getClientOriginalExtension();
//      $logo_path = Storage::disk('uploads')->putFileAs('logo', $logo, $logo_name);

      $path = Storage::disk('s3')->put(upload_path(), $logo, 'public');

      $settings->put('logo', $path);
    }
    if ($request->date_format){
      $settings->put('date_format', $request->date_format);
    }
    if ($request->app_title){
      $settings->put('app_title', trim($request->app_title));
    }
    if ($request->email){
      $settings->put('email', trim($request->email));
    }
    if ($request->phone_number){
      $settings->put('phone_number', trim($request->phone_number));
    }
    if ($request->address){
      $settings->put('address', trim($request->address));
    }

    // Socials
    if ($request->social_twitter){
      $settings->put('social_twitter', trim($request->social_twitter));
    }

    if ($request->social_facebook){
      $settings->put('social_facebook', trim($request->social_facebook));
    }
    if ($request->social_linkedin){
      $settings->put('social_linkedin', trim($request->social_linkedin));
    }
    if ($request->social_instagram){
      $settings->put('social_instagram', trim($request->social_instagram));
    }

    notify()->success('Data updated successfully!');
    return back();
  }
}
