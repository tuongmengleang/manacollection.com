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
    body.dark-layout .select2-container .select2-selection {
      border-color: #10163a;
    }
    .permission-select{
      position: absolute;
      top: -5px;
      right: 10px;
    }
    .permission-select a{
      font-size: 22px;
    }
  </style>
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
          <div class="card-content">
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active">
                  <section id="data-list-view" class="data-list-view-header">
                    <div class="row">
                      <!-- DataTable starts -->
                      <div class="table-responsive">
                        <table id="permissions-datatable" class="table data-list-view" width="100%">
                          <thead>
                          <tr>
                            <th>{{ __('general.name') }}</th>
                            <th>{{ __('general.display_name') }}</th>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- account setting page end -->
  <!-- Permission Modal -->
  <div class="modal fade" id="permissionModalForm" tabindex="-1" role="dialog" aria-labelledby="permissionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="permissionModalTitle">Permission Create</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
          <div class="modal-body">
            <input type="hidden" name="permission_hidden">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="permission_name">Permission Name<strong class="text-danger">*</strong></label>
                  <input type="text" id="permission_name" name="permission_name" class="form-control" placeholder="Permission Name">
                  <span id="permission_validate_error" class="validate text error-validate"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="display_name">Display Name</label>
                  <input type="text" id="permission_display_name" name="permission_display_name" class="form-control" placeholder="Display Name">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="permission-save" class="btn btn-primary btn-save">{{ __('general.save_changes') }}</button>
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
          "use strict";
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          // init list view datatable
          let permissionDataView = $("#permissions-datatable").DataTable({
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
                          //
                      },
                      className: "btn-outline-primary add-new-permission",
                  }
              ],
              processing: true,
              serverSide: true,
              ajax: '{{ route('admin.permission.datatable') }}',
              columns: [
                  // { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, class: 'text-center' },
                  { data: 'name', name: 'name' },
                  { data: 'display_name', name: 'display_name' },
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


          // To append actions dropdown before add new button
          var actionDropdown = $(".actions-dropodown")
          actionDropdown.insertBefore($(".top .actions .dt-buttons"))

          // Scrollbar
          if ($(".data-items").length > 0) {
              new PerfectScrollbar(".data-items", { wheelPropagation: false })
          }
          // Permission Ajax CRUD
          // Popup modal form
          $(document).on('click', '.add-new-permission', function () {
              $("[name='hidden']").removeAttr('value');
              $("[name='permission_name']").val('');
              $("[name='permission_display_name']").val('');
              $('#permission_validate_error').text('');
              $("[name='permission_name']").removeClass('validate-input-error');
              $('#permissionModalForm').modal('show');
          });
          //  Ajax store
          $(document).on('click', '#permission-save', function () {
              $('#permission_validate_error').text('');
              $("[name='permission_name']").removeClass('validate-input-error');

              let name = $("[name='permission_name']").val();
              let display_name = $("[name='permission_display_name']").val();
              let id = $("[name='permission_hidden']").val();
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
                      Notiflix.Loading.Remove();
                      if (data.errors){
                          $('#permission_validate_error').text(data.errors.name);
                          $("[name='permission_name']").addClass('validate-input-error');
                      }
                      else{
                          $('#permissionModalForm').modal('hide');
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
              $("#permissionModalTitle").text("Permission Update");
              $('#permission_validate_error').text('');
              $("[name='permission_name']").removeClass('validate-input-error');
              $('#permissionModalForm').modal('show');
              $.get("{{ route('admin.permission.edit') }}", {id: id}, function (response) {
                  $("[name='permission_name']").val(response.name);
                  $("[name='permission_display_name']").val(response.display_name);
                  $("[name='permission_hidden']").val(response.id);
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
                                  Notiflix.Notify.Success(data.message);
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

      });


  </script>
@endsection
