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
                  <div class="tab-pane">
                    <div class="row">
                      <h6 class="m-1">Activity</h6>
                      <div class="col-12 mb-1">
                        <div class="custom-control custom-switch custom-control-inline">
                          <input type="checkbox" class="custom-control-input" checked id="accountSwitch1">
                          <label class="custom-control-label mr-1" for="accountSwitch1"></label>
                          <span class="switch-label w-100">Email me when someone comments
                                                                onmy
                                                                article</span>
                        </div>
                      </div>
                      <div class="col-12 mb-1">
                        <div class="custom-control custom-switch custom-control-inline">
                          <input type="checkbox" class="custom-control-input" checked id="accountSwitch2">
                          <label class="custom-control-label mr-1" for="accountSwitch2"></label>
                          <span class="switch-label w-100">Email me when someone answers on
                                                                my
                                                                form</span>
                        </div>
                      </div>
                      <div class="col-12 mb-1">
                        <div class="custom-control custom-switch custom-control-inline">
                          <input type="checkbox" class="custom-control-input" id="accountSwitch3">
                          <label class="custom-control-label mr-1" for="accountSwitch3"></label>
                          <span class="switch-label w-100">Email me hen someone follows
                                                                me</span>
                        </div>
                      </div>
                      <h6 class="m-1">Application</h6>
                      <div class="col-12 mb-1">
                        <div class="custom-control custom-switch custom-control-inline">
                          <input type="checkbox" class="custom-control-input" checked id="accountSwitch4">
                          <label class="custom-control-label mr-1" for="accountSwitch4"></label>
                          <span class="switch-label w-100">News and announcements</span>
                        </div>
                      </div>
                      <div class="col-12 mb-1">
                        <div class="custom-control custom-switch custom-control-inline">
                          <input type="checkbox" class="custom-control-input" id="accountSwitch5">
                          <label class="custom-control-label mr-1" for="accountSwitch5"></label>
                          <span class="switch-label w-100">Weekly product updates</span>
                        </div>
                      </div>
                      <div class="col-12 mb-1">
                        <div class="custom-control custom-switch custom-control-inline">
                          <input type="checkbox" class="custom-control-input" checked id="accountSwitch6">
                          <label class="custom-control-label mr-1" for="accountSwitch6"></label>
                          <span class="switch-label w-100">Weekly blog digest</span>
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
