<?php
if (! function_exists('settings')) {
  function settings($key = null, $default = null) {
    if ($key === null) {
      return app(App\Settings::class);
    }
    return app(App\Settings::class)->get($key, $default);
  }
}

if (! function_exists('upload_path')) {
  function upload_path($main_path = 'uploads')
  {
    return $main_path . '/' . date('Y') . '/' . date('m');
  }
}

if (! function_exists('s3_url')) {
  function s3_url($url, $s3 = true)
  {
    $pretty_url = NULL;
    if ($s3 === true)
      $pretty_url = \Illuminate\Support\Facades\Storage::disk('s3')->url($url);
    else
      $pretty_url = asset($url);
    return $pretty_url;
  }
}

if (! function_exists('uuid')) {
  function uuid()
  {
    return (string) Illuminate\Support\Str::uuid();
  }
}

if (! function_exists('print_arrays')) {
  function print_arrays($data, $exit = false)
  {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if ($exit == true) {
      exit();
    }
  }
}

if (! function_exists('formatDate')) {
  function formatDate($date, $format = null)
  {
    if ($date) {
      if (!$format) {
        $format = settings('date_format');
      }
      return \Carbon\Carbon::parse($date)->format($format);
    }
    return null;
  }
}

if (! function_exists('formatLongDate')) {
  function formatLongDate($date, $format = null)
  {
    if ($date) {
      if (!$format) {
        $format = settings('date_format') . ' H:i:s';
      }
      return \Carbon\Carbon::parse($date)->format($format);
    }
    return null;
  }
}

if (! function_exists('formatDateToDB')) {
  function formatDateToDB($date, $format = 'Y-m-d')
  {
    if ($date) {
      return \Carbon\Carbon::parse($date)->format($format);
    }
    return null;
  }
}

if (! function_exists('formatLongDateToDB')) {
  function formatLongDateToDB($date, $format = 'Y-m-d H:i:s')
  {
    if ($date) {
      return \Carbon\Carbon::parse($date)->format($format);
    }
    return null;
  }
}

if (! function_exists('formatMoney')) {
  function formatMoney($number, $decimal = 2, $symbol = '$')
  {
    if ($number) {
      return $symbol . ' ' . number_format($number, $decimal);
    }
    return 0;
  }
}

if (! function_exists('formatDecimal')) {
  function formatDecimal($number, $decimal = 2)
  {
    if ($number) {
      return number_format($number, $decimal);
    }
    return 0;
  }
}

if(! function_exists('brand_image_path')){
  function brand_image_path($main_path = 'uploads'){
    return $main_path . '/' . 'brands' . '/' . date('Y') . '/' . date('m');
  }
}

if(! function_exists('product_image_path')){
  function product_image_path($main_path = 'uploads'){
    return $main_path . '/' . 'products' . '/'  . date('Y') . '/' . date('m');
  }
}
