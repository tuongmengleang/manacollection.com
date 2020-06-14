@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.settings'))

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/forms/select/select2.min.css') }}">
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
      <div class="col-md-3 mb-2 mb-md-0">
        <ul class="nav nav-pills flex-column mt-md-0 mt-1">
          <li class="nav-item">
            <a class="nav-link d-flex py-75 active" id="tab-pill-general" data-toggle="pill" href="#tab-vertical-general" aria-expanded="true">
              <i class="feather icon-globe mr-50 font-medium-3"></i>
              {{ __('general.general') }}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex py-75" id="tab-pill-social" data-toggle="pill" href="#tab-vertical-social" aria-expanded="false">
              <i class="feather icon-camera mr-50 font-medium-3"></i>
              {{ __('general.social_links') }}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex py-75" id="tab-pill-notifications" data-toggle="pill" href="#tab-vertical-notifications" aria-expanded="false">
              <i class="feather icon-message-circle mr-50 font-medium-3"></i>
              {{ __('general.notifications') }}
            </a>
          </li>
        </ul>
      </div>
      <!-- right content section -->
      <div class="col-md-9">
        <div class="card">
          {!! Form::open([ 'url' => route('admin.setting.update'), 'method' => 'POST', 'files' => true ]) !!}
          <div class="card-content">
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab-vertical-general" role="tabpanel" aria-labelledby="tab-pill-general" aria-expanded="false">
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

                <div class="tab-pane fade " id="tab-vertical-social" role="tabpanel" aria-labelledby="tab-pill-social" aria-expanded="false">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account-twitter">Twitter</label>
                          <input type="text" name="social_twitter" class="form-control" placeholder="Add link" value="{{ settings('social_twitter') }}">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Facebook</label>
                          <input type="text" name="social_facebook" class="form-control" placeholder="Add link" value="{{ settings('social_facebook') }}">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account-linkedin">LinkedIn</label>
                          <input type="text" name="social_linkedin" class="form-control" placeholder="Add link" value="{{ settings('social_linkedin') }}">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Instagram</label>
                          <input type="text" name="social_instagram" class="form-control" placeholder="Add link" value="{{ settings('social_instagram') }}">
                        </div>
                      </div>
                      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">{{ __('general.save_changes') }}</button>
                        <button type="reset" class="btn btn-outline-warning">{{ __('general.cancel') }}</button>
                      </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-vertical-notifications" role="tabpanel" aria-labelledby="tab-pill-notifications" aria-expanded="false">
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
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </section>
  <!-- account setting page end -->

@endsection
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset('admin/vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
@endsection

@section('page-script')
  <script>

  </script>
@endsection
