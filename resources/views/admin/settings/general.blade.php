@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.settings'))

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/datatables.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/notiflix/notiflix-2.1.2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/sweetalert2-dark/dark.min.css') }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('content')

  <!-- account setting page start -->
  <section id="page-account-settings">
    <div class="row">
      <!-- left menu section -->
      @include('admin.settings.setting_tap')
      <!-- right content section -->
      <div class="col-md-9">
        <div class="card">
          {!! Form::open([ 'url' => route('admin.setting.update'), 'method' => 'POST', 'files' => true ]) !!}
          <div class="card-content">
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <div class="controls">
                            <label>{{ __('general.site_logo') }}</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                            <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF, PNG or SVG. Max size of 800kB</small></p>
                            @if (settings('logo'))
                              <img src="{{ s3_url(settings('logo')) }}" class="rounded mr-75" alt="profile image" height="100" width="100">
                            @endif
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-group">
                          <label>{{ __('general.date_format') }}</label>
                          {!! Form::select('date_format', array('Y/m/d' => 'Y/m/d', 'd/m/Y' => 'd/m/Y'), settings('date_format'), ['class' => 'form-control']) !!}
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-group">
                          <div class="controls">
                            <label>{{ __('general.app_title') }}</label>
                            <input type="text" name="app_title" class="form-control" placeholder="App Title" value="{{ settings('app_title') }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-group">
                          <div class="controls">
                            <label>{{ __('general.email') }}</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ settings('email') }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-group">
                          <div class="controls">
                            <label>{{ __('general.phone_number') }}</label>
                            <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ settings('phone_number') }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-group">
                          <div class="controls">
                            <label>{{ __('general.address') }}</label>
                            <input type="text" name="address" class="form-control" placeholder="Address" value="{{ settings('address') }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">{{ __('general.save_changes') }}</button>
                        <button type="reset" class="btn btn-outline-warning">{{ __('general.cancel') }}</button>
                      </div>

                    </div>
                </div>

              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </section>
  <!-- account setting page end -->

@endsection
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset('admin/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>

  <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.min.js')) }}"></script>
  <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('admin/vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
  <script src="{{ asset(mix('admin/vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script>
  <script src="{{ asset(mix('admin/vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset('admin/vendors/js/notiflix/notiflix-2.1.2.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endsection

@section('page-script')
  <script>


  </script>
@endsection