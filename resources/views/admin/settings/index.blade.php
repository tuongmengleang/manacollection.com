@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.settings'))

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/datatables.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/notiflix/notiflix-2.1.2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/sweetalert2-dark/dark.min.css') }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/plugins/forms/validation/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('admin/css/pages/data-list-view.css')) }}">


  <style>
    .validate.text{
      font-size: 13px;
      font-family: "Comic Sans MS";
    }
    .validate.text.error-validate{
      color: red;
    }

    .validate-input-error{
      border: 2px solid 	#FA8072 !important;
    }
  </style>
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
          <li class="nav-item">
            <a class="nav-link d-flex py-75" id="tab-pill-notifications" data-toggle="pill" href="#tab-vertical-permission" aria-expanded="false">
              <i class="feather icon-lock mr-50 font-medium-3"></i>
              {{ __('general.permissions') }}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex py-75" id="tab-pill-notifications" data-toggle="pill" href="#tab-vertical-role" aria-expanded="false">
              <i class="feather icon-tag mr-50 font-medium-3"></i>
              {{ __('general.roles') }}
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

                <!-- tab permission form -->
                <div class="tab-pane fade " id="tab-vertical-permission" role="tabpanel" aria-labelledby="tab-pill-social" aria-expanded="false">
                  <section id="data-list-view" class="data-list-view-header">
                    <div class="row">
                      <!-- DataTable starts -->
                      <div class="table-responsive">
                        <table id="permissions-datatable" class="table data-list-view" width="100%">
                          <thead>
                          <tr>
                            <th>{{ __('general.name') }}</th>
                            <th>{{ __('general.display_name') }}</th>
                            <th>{{ __('general.guard_name') }}</th>
                            <th>{{ __('general.created_at') }}</th>
                            <th>{{ __('general.actions')}}</th>
                          </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <!-- DataTable ends -->
                    </div>
                  </section>
                </div>
                <!-- end tab permission form -->

                <!-- tab role form -->
                <div class="tab-pane fade " id="tab-vertical-role" role="tabpanel" aria-labelledby="tab-pill-social" aria-expanded="false">
                  <section id="data-list-view" class="data-list-view-header">
                    <div class="row">
                      <!-- DataTable starts -->
                      <div class="table-responsive">
                        <table id="roles-datatable"  class="table data-list-view" width="100%">
                          <thead>
                          <tr>
                            <th>{{ __('general.name') }}</th>
                            <th>{{ __('general.display_name') }}</th>
                            <th>{{ __('general.guard_name') }}</th>
                            <th>{{ __('general.created_at') }}</th>
                            <th>{{ __('general.actions')}}</th>
                          </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <!-- DataTable ends -->
                    </div>
                  </section>
                </div>
                <!-- end tab role form -->

              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </section>
  <!-- account setting page end -->

  <!-- Permission Modal -->
  <div class="modal fade" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="permissionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="permissionModalTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
          <div class="modal-body">
            <input type="hidden" name="hidden">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="name" ><strong class="text-danger">*</strong></label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                  <span class="validate text error-validate"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="display_name"></label>
                  <input type="text" id="display_name" name="display_name" class="form-control" placeholder="Display name">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-save">{{ __('general.save_changes') }}</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('general.cancel') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset('admin/vendors/js/forms/select/select2.full.min.js') }}"></script>
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
      $(document).ready(function() {
          "use strict"
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          // init list view datatable
          var permissionDataView = $("#permissions-datatable").DataTable({
              responsive: false,
              dom:
                  '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
              oLanguage: {
                  sLengthMenu: "_MENU_",
                  sSearch: ""
              },
              aLengthMenu: [[10, 15, 20, 50], [10, 15, 20, 50]],
              order: [[1, "desc"]],
              bInfo: false,
              buttons: [
                  {
                      text: "<i class='feather icon-plus'></i> Add New",
                      action: function() {
                          $('#inlineForm').modal('show');
                          $(".btn-save").attr('id', 'permission-save');
                          $("#permissionModalTitle").text('Permission Create');
                          $("[for='name']").text('Permission Name');
                          $("[for='display_name']").text('Display Name');
                          $("[name='hidden']").removeAttr('value');
                          $("[name='name']").val('');
                          $("[name='display_name']").val('');
                          $('.error-validate').text('');
                          $("[name='name']").removeClass('validate-input-error');
                      },
                      className: "btn-outline-primary",
                  }
              ],
              processing: true,
              serverSide: true,
              ajax: '{{ route('admin.permission.datatable') }}',
              columns: [
                  // { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, class: 'text-center' },
                  { data: 'name', name: 'name' },
                  { data: 'display_name', name: 'display_name' },
                  { data: 'guard_name', name: 'guard_name' },
                  { data: 'created_at', name: 'created_at' },
                  { data: 'actions', name: 'actions', orderable: false, searchable: false, class: 'text-center' }
              ],
              initComplete: function(settings, json) {
                  $(".dt-buttons .btn").removeClass("btn-secondary")
              }
          });

          var roleDataView = $("#roles-datatable").DataTable({
              responsive: false,
              dom:
                  '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
              oLanguage: {
                  sLengthMenu: "_MENU_",
                  sSearch: ""
              },
              aLengthMenu: [[10, 15, 20, 50], [10, 15, 20, 50]],
              order: [[1, "desc"]],
              bInfo: false,
              buttons: [
                  {
                      text: "<i class='feather icon-plus'></i> Add New",
                      action: function() {
                          $('#inlineForm').modal('show');
                          $(".btn-save").attr('id', 'role-save');
                          $("#permissionModalTitle").text('Role Create');
                          $("[for='name']").text('Role Name');
                          $("[for='display_name']").text('Display Name');
                          $("[name='hidden']").removeAttr('value');
                          $("[name='name']").val('');
                          $("[name='display_name']").val('');
                          $('.error-validate').text('');
                          $("[name='name']").removeClass('validate-input-error');
                      },
                      className: "btn-outline-primary",
                  }
              ],
              processing: true,
              serverSide: true,
              ajax: '{{ route('admin.role.datatable') }}',
              columns: [
                  // { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, class: 'text-center' },
                  { data: 'name', name: 'name' },
                  { data: 'display_name', name: 'display_name' },
                  { data: 'guard_name', name: 'guard_name' },
                  { data: 'created_at', name: 'created_at' },
                  { data: 'actions', name: 'actions', orderable: false, searchable: false, class: 'text-center' }
              ],
              initComplete: function(settings, json) {
                  $(".dt-buttons .btn").removeClass("btn-secondary")
              }
          });

          permissionDataView.on('draw.dt', function(){
              setTimeout(function(){
                  if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                      $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
                  }
              }, 50);
          });
          roleDataView.on('draw.dt', function(){
              setTimeout(function(){
                  if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                      $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
                  }
              }, 50);
          });

          // To append actions dropdown before add new button
          var actionDropdown = $(".actions-dropodown")
          actionDropdown.insertBefore($(".top .actions .dt-buttons"))

          // Scrollbar
          if ($(".data-items").length > 0) {
              new PerfectScrollbar(".data-items", { wheelPropagation: false })
          }

          // Permission Ajax CRUD
          //  Ajax store
          $(document).on('click', '#permission-save', function () {
              let name = $("[name='name']").val();
              let display_name = $("[name='display_name']").val();
              let id = $("[name='hidden']").val();
              Notiflix.Loading.Dots('Processing...');
              $.ajax({
                  url: "{{ route('admin.permission.store') }}",
                  type: "post",
                  dataType: 'json',
                  data: {
                      id: id,
                      name: name,
                      display_name: display_name
                  },
                  success: function (data) {
                      // console.log(data);
                      Notiflix.Loading.Remove();
                      if (data.errors){
                          $('.error-validate').text(data.errors.name);
                          $("[name='name']").addClass('validate-input-error');
                      }
                      else{
                          $('#inlineForm').modal('hide');
                          Notiflix.Notify.Success(data.message);
                          permissionDataView.ajax.reload();
                      }
                  },
                  error: function (data) {
                      console.log('Error', data);
                  }
              });
          });

          // Ajax update
          $(document).on('click', '.edit-permission', function () {
              const id = $(this).data('id');
              $('.error-validate').text('');
              $("[name='name']").removeClass('validate-input-error');
              $("[for='name']").text('Permission Name');
              $("[for='display_name']").text('Display Name');
              $('#inlineForm').modal('show');
              $('#permissionModalTitle').html('Update Permission');
              $.get("{{ route('admin.permission.edit') }}", {id: id}, function (response) {
                  $("[name='name']").val(response.name);
                  $("[name='display_name']").val(response.display_name);
                  $("[name='hidden']").val(response.id);
                  // console.log(response.name);
              });
          });

          // Ajax Delete
          $(document).on('click', '.delete-permission', function () {
              const id = $(this).data('id');

              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                  if (result.value) {
                      Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                      );
                      $.ajax({
                          url: "{{ route('admin.permission.delete') }}",
                          type: "post",
                          data: { id:id },
                          dataType: 'json',
                          success: function (data) {
                              // console.log(data);
                              if (data.message){
                                  Notiflix.Notify.Warning(data.message);
                              }
                              permissionDataView.ajax.reload();
                          },
                          error: function (data) {
                              console.log("Error", data);
                          }
                      });
                  }
              });
          });

          // Role Ajax CRUD
          //  Ajax store
          $(document).on('click', '#role-save', function () {
              let name = $("[name='name']").val();
              let display_name = $("[name='display_name']").val();
              let id = $("[name='hidden']").val();
              Notiflix.Loading.Dots('Processing...');
              $.ajax({
                  url: "{{ route('admin.role.store') }}",
                  type: "post",
                  dataType: 'json',
                  data: {
                      id: id,
                      name: name,
                      display_name: display_name
                  },
                  success: function (data) {
                      // console.log(data);
                      Notiflix.Loading.Remove();
                      if (data.errors){
                          $('.error-validate').text(data.errors.name);
                          $("[name='name']").addClass('validate-input-error');
                      }
                      else{
                          $('#inlineForm').modal('hide');
                          Notiflix.Notify.Success(data.message);
                          roleDataView.ajax.reload();
                      }
                  },
                  error: function (data) {
                      console.log('Error', data);
                  }
              });
          });

          // Ajax update
          $(document).on('click', '.edit-role', function () {
              const id = $(this).data('id');
              $('.error-validate').text('');
              $("[name='name']").removeClass('validate-input-error');
              $("[for='name']").text('Role Name');
              $("[for='display_name']").text('Display Name');
              $('#inlineForm').modal('show');
              $('#permissionModalTitle').html('Update Role');
              $.get("{{ route('admin.role.edit') }}", {id: id}, function (response) {
                  $("[name='name']").val(response.name);
                  $("[name='display_name']").val(response.display_name);
                  $("[name='hidden']").val(response.id);
                  // console.log(response.name);
              });
          });

          // Ajax Delete
          $(document).on('click', '.delete-role', function () {
              const id = $(this).data('id');

              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                  if (result.value) {
                      Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                      );
                      $.ajax({
                          url: "{{ route('admin.role.delete') }}",
                          type: "post",
                          data: { id:id },
                          dataType: 'json',
                          success: function (data) {
                              // console.log(data);
                              if (data.message){
                                  Notiflix.Notify.Warning(data.message);
                              }
                              roleDataView.ajax.reload();
                          },
                          error: function (data) {
                              console.log("Error", data);
                          }
                      });
                  }
              });
          });


      });

  </script>
@endsection
