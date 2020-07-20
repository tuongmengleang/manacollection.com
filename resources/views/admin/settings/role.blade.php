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
    .select-all{
      position: absolute;
      top: -5px;
      right: 10px;
    }
    .select-all a{
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
                        <table id="roles-datatable" class="table data-list-view" width="100%">
                          <thead>
                          <tr>
                            <th>{{ __('general.name') }}</th>
                            <th>{{ __('general.display_name') }}</th>
                            <th>{{ __('general.permissions') }}</th>
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
  <!-- Role Modal -->
  <div class="modal fade" id="roleModalForm" tabindex="-1" role="dialog" aria-labelledby="permissionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="roleModalTitle">Create Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
          <div class="modal-body">
            <input type="hidden" name="role_hidden">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="role_name">Role Name<strong class="text-danger">*</strong></label>
                  <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Role Name">
                  <span id="role_validate_error" class="validate text error-validate"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="display_name">Display Name</label>
                  <input type="text" id="role_display_name" name="role_display_name" class="form-control" placeholder="Display name">
                </div>
              </div>
              <div class="col-12">
                <label for="permissions">Give Permission<strong class="text-danger">*</strong></label>
                <div class="form-group">
                  <div class="select-all">
                    <a href="javascript:void(0)" id="select-all" class="text-primary" title="Select All"><i class='feather icon-check'></i></a>
                    <a href="javascript:void(0)" id="deselect-all" class="text-danger" title="Deselect All"><i class='feather icon-x'></i></a>
                  </div>
                  <select name="permissions" id="permissions" class="select2 form-control" multiple="multiple" data-placeholder="Give permissions...">
                    @if(isset($permissions))
                      @foreach($permissions as $value => $permissions)
                        <option value="{{ $value }}" data-select2-id="{{ $value }}">{{ $permissions }}</option>
                      @endforeach
                    @endif
                  </select>
                  <span id="permissions_validate_error" class="validate text error-validate"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="role-save" class="btn btn-primary btn-save">{{ __('general.save_changes') }}</button>
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
          let roleDataView = $("#roles-datatable").DataTable({
              responsive: true,
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
                      className: "btn-outline-primary add-new-role",
                  }
              ],
              processing: true,
              serverSide: true,
              ajax: '{{ route('admin.role.datatable') }}',
              columns: [
                  // { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, class: 'text-center' },
                  { data: 'name', name: 'name' },
                  { data: 'display_name', name: 'display_name' },
                  { data: 'permissions', name: 'permissions', orderable: false, class: 'text-center' },
                  { data: 'created_at', name: 'created_at' },
                  { data: 'actions', name: 'actions', orderable: false, searchable: false, class: 'text-center' }
              ],
              initComplete: function(settings, json) {
                  $(".dt-buttons .btn").removeClass("btn-secondary")
              }
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

          $(document).on('click', "#select-all", function () {
              let $select2 = $(this).parent().siblings('.select2');
              $select2.find('option').prop('selected', 'selected');
              $select2.trigger('change');
          });
          $('#deselect-all').click(function () {
              let $select2 = $(this).parent().siblings('.select2');
              $select2.find('option').prop('selected', '');
              $select2.trigger('change');
          });

          // Permission Ajax CRUD
          // Popup modal form
          $(document).on('click', '.add-new-role', function () {
              $("[name='role_hidden']").removeAttr('value');
              $("[name='role_display_name']").val('');
              $("[name='role_name']").val('');
              $("[name='role_name']").removeClass('validate-input-error');
              $('#role_validate_error').text('');
              $('ul.select2-results__options li').attr("aria-selected", false);
              $("#permissions").val('');
              $('#permissions_validate_error').text('');
              $(".select2-selection").removeClass('validate-input-error');
              $('ul.select2-selection__rendered').empty();
              $("#roleModalForm").modal('show');
          });
          //  Ajax store
          $(document).on('click', '#role-save', function () {
              $('#role_validate_error').text('');
              $("[name='role_name']").removeClass('validate-input-error');
              $('#permissions_validate_error').text('');
              $(".select2-selection").removeClass('validate-input-error');
              $('ul.select2-selection__rendered').empty();

              let name = $("[name='role_name']").val();
              let display_name = $("[name='role_display_name']").val();
              let permissions = $("[name='permissions']").val();
              let id = $("[name='role_hidden']").val();
              console.log(permissions);
              Notiflix.Loading.Dots('Processing...');
              $.ajax({
                  url: "{{ route('admin.role.store') }}",
                  type: "post",
                  dataType: 'json',
                  data: {
                      id: id,
                      name: name,
                      display_name: display_name,
                      permissions : permissions
                  },
                  success: function (data) {
                      // console.log(data);
                      Notiflix.Loading.Remove();
                      if (data.errors){
                          if (data.errors.name){
                              $('#role_validate_error').text(data.errors.name);
                              $("[name='role_name']").addClass('validate-input-error');
                          }
                          if (data.errors.permissions){
                              $('#permissions_validate_error').text(data.errors.permissions);
                              $(".select2-selection").addClass('validate-input-error');
                          }
                      }
                      else{
                          $('#roleModalForm').modal('hide');
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
              $("#roleModalTitle").text("Role Update");
              $('#role_validate_error').text('');
              $("[name='role_name']").removeClass('validate-input-error');
              // $("#permissions").val('');
              $('#permissions_validate_error').text('');
              $("ul.select2-results__options li").addClass("test");
              $(".select2-selection").removeClass('validate-input-error');
              $('ul.select2-selection__rendered').empty();
              $('#roleModalForm').modal('show');
              $('#permissionModalTitle').html('Update Role');
              let html = '';
              $.get("{{ route('admin.role.edit') }}", {id: id}, function (response) {
                  $("[name='role_name']").val(response.name);
                  $("[name='role_display_name']").val(response.display_name);
                  $("[name='role_hidden']").val(response.id);
                  let select = '';
                  if (response.permissions){
                      let permission_length = response.permissions.length;
                      if (permission_length > 0){
                          let values = [];
                          for (let i = 0 ; i < permission_length ; i++){
                              let opt = response.permissions[i];
                              values.push(opt.name);
                              $(".select2-results__option").attr("aria-selected", false);
                              $("#permissions").val('').trigger('change');
                              $("#permissions").val(values).trigger('change');
                              select += '<li class="select2-selection__choice" title="'+ opt.display_name +'" data-select2-id="'+ opt.name +'">' +
                                  '<span class="select2-selection__choice__remove" role="presentation">×</span>'+ opt.display_name +'' +
                                  '</li>';
                              $('ul.select2-selection__rendered').html('');
                              $('ul.select2-selection__rendered').html(select);
                          }
                      }
                      else{
                          $("#permissions").val('').trigger('change');
                      }
                  }
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
                                  Notiflix.Notify.Success(data.message);
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
