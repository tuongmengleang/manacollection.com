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
              General
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex py-75" id="tab-pill-social" data-toggle="pill" href="#tab-vertical-social" aria-expanded="false">
              <i class="feather icon-camera mr-50 font-medium-3"></i>
              Social links
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex py-75" id="tab-pill-notifications" data-toggle="pill" href="#tab-vertical-notifications" aria-expanded="false">
              <i class="feather icon-message-circle mr-50 font-medium-3"></i>
              Notifications
            </a>
          </li>
        </ul>
      </div>
      <!-- right content section -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="tab-content">

                <div class="tab-pane active" id="tab-vertical-general" role="tabpanel" aria-labelledby="tab-pill-general" aria-expanded="false">
                  <form novalidate>
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="accountTextarea">Bio</label>
                          <textarea class="form-control" id="accountTextarea" rows="3" placeholder="Your Bio data here..."></textarea>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <div class="controls">
                            <label for="account-birth-date">Birth date</label>
                            <input type="text" class="form-control birthdate-picker" required placeholder="Birth date" id="account-birth-date" data-validation-required-message="This birthdate field is required">
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="accountSelect">Country</label>
                          <select class="form-control" id="accountSelect">
                            <option>USA</option>
                            <option>India</option>
                            <option>Canada</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="languageselect2">Languages</label>
                          <select class="form-control" id="languageselect2" multiple="multiple">
                            <option value="English" selected>English</option>
                            <option value="Spanish">Spanish</option>
                            <option value="French">French</option>
                            <option value="Russian">Russian</option>
                            <option value="German">German</option>
                            <option value="Arabic" selected>Arabic</option>
                            <option value="Sanskrit">Sanskrit</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <div class="controls">
                            <label for="account-phone">Phone</label>
                            <input type="text" class="form-control" id="account-phone" required placeholder="Phone number" value="(+656) 254 2568" data-validation-required-message="This phone number field is required">
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account-website">Website</label>
                          <input type="text" class="form-control" id="account-website" placeholder="Website address">
                        </div>
                      </div>

                      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                          changes</button>
                        <button type="reset" class="btn btn-outline-warning">Cancel</button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="tab-pane fade " id="tab-vertical-social" role="tabpanel" aria-labelledby="tab-pill-social" aria-expanded="false">
                  <form>
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account-twitter">Twitter</label>
                          <input type="text" id="account-twitter" class="form-control" placeholder="Add link" value="https://www.twitter.com">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account-facebook">Facebook</label>
                          <input type="text" id="account-facebook" class="form-control" placeholder="Add link">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account-google">Google+</label>
                          <input type="text" id="account-google" class="form-control" placeholder="Add link">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account-linkedin">LinkedIn</label>
                          <input type="text" id="account-linkedin" class="form-control" placeholder="Add link" value="https://www.linkedin.com">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account-instagram">Instagram</label>
                          <input type="text" id="account-instagram" class="form-control" placeholder="Add link">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="account-quora">Quora</label>
                          <input type="text" id="account-quora" class="form-control" placeholder="Add link">
                        </div>
                      </div>
                      <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                          changes</button>
                        <button type="reset" class="btn btn-outline-warning">Cancel</button>
                      </div>
                    </div>
                  </form>
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
                      <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                        changes</button>
                      <button type="reset" class="btn btn-outline-warning">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
