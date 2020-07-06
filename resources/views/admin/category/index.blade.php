@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.categories'))

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/datatables.min.css')) }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/notiflix/notiflix-2.1.2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/sweetalert2-dark/dark.min.css') }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset(mix('admin/css/plugins/file-uploaders/dropzone.css')) }}">
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
    #select2-type_name-container:first-letter{
      text-transform: uppercase !important;
    }
  </style>
@endsection

@section('content')

  <!-- Data list view starts -->
  <section id="data-list-view" class="data-list-view-header">
    <div class="action-btns d-none">
      <div class="btn-dropdown mr-1 mb-1">
        <div class="btn-group dropdown actions-dropodown">
          <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('admin.user.export', 'excel') }}" id="dt-export__excel"><i class="fa fa-file-excel-o"></i>Excel</a>
            <a class="dropdown-item" href="{{ route('admin.user.export', 'pdf') }}" id="dt-export__pdf"><i class="fa fa-file-pdf-o"></i>Pdf</a>
            {{--            <a class="dropdown-item" href="#" id="dt-export__print"><i class="feather icon-file"></i>Print</a>--}}
          </div>
        </div>
      </div>
    </div>

    <!-- DataTable starts -->
    <div class="table-responsive">
      <table class="table data-list-view" width="100%">
        <thead>
        <tr>
          <th>Category name</th>
          <th>Type name</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <!-- DataTable ends -->

  </section>
  <!-- Data list view end -->

  <!-- Modal -->
  <div class="modal fade" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="permissionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="permissionModalTitle">Category Create</h5>
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
                  <label for="category_name">Category name<strong class="text-danger">*</strong></label>
                  <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Category name">
                  <span id="category_name_error" class="validate text error-validate"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="type_name">Type name<strong class="text-danger">*</strong></label>
                  <select id="type_name" name="type_name" class="select2 form-control" data-placeholder="Select a type name...">
                    <option value="" selected></option>
                    <option value="women">Women</option>
                    <option value="men">Men</option>
                    <option value="beauty">Beauty</option>
                  </select>
                  <span id="type_name_error" class="validate text error-validate"></span>
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
    <script src="{{ asset('admin/vendors/js/forms/select/select2.full.js') }}"></script>
  <script>
      $(document).ready(function() {
          "use strict"
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          // init list view datatable
          var dataListView = $(".data-list-view").DataTable({
              responsive: false,
              dom:
                  '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
              oLanguage: {
                  sLengthMenu: "_MENU_",
                  sSearch: ""
              },
              aLengthMenu: [[10, 15, 20, 50], [10, 15, 20, 50]],
              order: [1, "desc"],
              bInfo: false,
              buttons: [
                  {
                      text: "<i class='feather icon-plus'></i> Add New",
                      action: function() {
                          $('#inlineForm').modal('show');
                          $("[name='hidden']").removeAttr('value');
                          $("[name='category_name']").val('');
                          $("[name='type_name'] option[value='']").prop('selected', true);
                          $(".select2-selection__rendered").text("Select a type name...");
                          $('#category_name_error').text('');
                          $("[name='category_name']").removeClass('validate-input-error');
                          $('#type_name_error').text('');
                          $(".select2").removeClass('validate-input-error');
                      },
                      className: "btn-outline-primary"
                  }
              ],
              processing: true,
              serverSide: true,
              ajax: '{{ route('admin.product.category.datatable') }}',
              columns: [
                  { data: 'category_name', name: 'category_name' },
                  { data: 'type_name', name: 'type_name' },
                  { data: 'created_at', name: 'created_at' },
                  { data: 'actions', name: 'actions', orderable: false, searchable: false, class: 'text-center' }
              ],
              initComplete: function(settings, json) {
                  $(".dt-buttons .btn").removeClass("btn-secondary")
              }
          });

          dataListView.on('draw.dt', function(){
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

          // Category Ajax CRUD
          //  Ajax store
          $(document).on('click', '.btn-save', function () {
              let category_name = $("[name='category_name']").val();
              let type_name = $("[name='type_name'] :selected").val();
              const id = $("[name='hidden']").val();
              Notiflix.Loading.Dots('Processing...');
              $.ajax({
                  url: "{{ route('admin.product.category.store') }}",
                  type: "post",
                  dataType: 'json',
                  data: {
                      id: id,
                      category_name: category_name,
                      type_name: type_name
                  },
                  success: function (data) {
                      // console.log(data);
                      Notiflix.Loading.Remove();
                      if (data.errors){
                          console.log(data.errors);
                          if (data.errors.category_name && data.errors.type_name){
                              $('#type_name_error').text(data.errors.type_name);
                              $(".select2").addClass('validate-input-error');
                              $('#category_name_error').text(data.errors.category_name);
                              $("[name='category_name']").addClass('validate-input-error');
                          }
                          else if (data.errors.category_name){
                              $('#category_name_error').text(data.errors.category_name);
                              $("[name='category_name']").addClass('validate-input-error');
                              $('#type_name_error').text('');
                              $(".select2").removeClass('validate-input-error');
                          }
                          else if(data.errors.type_name){
                              $('#type_name_error').text(data.errors.type_name);
                              $(".select2").addClass('validate-input-error');
                              $('#category_name_error').text('');
                              $("[name='category_name']").removeClass('validate-input-error');
                          }
                      }
                      else{
                          $('#inlineForm').modal('hide');
                          Notiflix.Notify.Success(data.message);
                          dataListView.ajax.reload();
                      }
                  },
                  error: function (data) {
                      console.log('Error', data);
                  }
              });
          });

          // Ajax update
          $(document).on('click', '#edit', function () {
              const id = $(this).data('id');
              $('#category_name_error').text('');
              $("[name='category_name']").removeClass('validate-input-error');
              $('#type_name_error').text('');
              $(".select2").removeClass('validate-input-error');
              $('#inlineForm').modal('show');
              $('#permissionModalTitle').html('Category Update');
              $.get("{{ route('admin.product.category.edit') }}", {id: id}, function (response) {
                  $("[name='category_name']").val(response.category_name);
                  $("#select2-type_name-container").text(response.type_name);
                  $("[name='type_name']").val(response.display_name);
                  if (response.type_name == 'women'){
                      $("[name='type_name'] option[value='women']").prop('selected', true);
                  }
                  else if (response.type_name == 'men'){
                      $("[name='type_name'] option[value='men']").prop('selected', true);
                  }
                  else{
                      $("[name='type_name'] option[value='beauty']").prop('selected', true);
                  }
                  $("[name='hidden']").val(response.id);
                  // console.log(response);
              });
          });

          // Ajax Delete
          $(document).on('click', '#delete', function () {
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
                          url: "{{ route('admin.product.category.delete') }}",
                          type: "post",
                          data: { id:id },
                          dataType: 'json',
                          success: function (data) {
                              if (data.message){
                                  Notiflix.Notify.Success(data.message);
                              }
                              dataListView.ajax.reload();
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
