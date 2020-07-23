@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.subcategories'))

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
    #select2-type_name-container:first-letter, .select2-results__group:first-letter{
      text-transform: uppercase !important;
    }
    .select2-results__group{
      color: 	dodgerblue;
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
          <th>Type name</th>
          <th>Category name</th>
          <th>Subcategory name</th>
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
                  <label for="subcategory_name">Category name<strong class="text-danger">*</strong></label>
                  <select name="category_id" data-placeholder="Select a category..." class="select2-icons form-control" id="select2-icons">
                    <option value="" selected></option>
                      @if(isset($categories))
                        @foreach($categories as $keys => $category)
                          <optgroup label="{{ $keys }}">
                            @foreach($category as $item )
                              <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach
                          </optgroup>
                        @endforeach
                      @endif
                  </select>
                  <span id="category_id_error" class="validate text error-validate"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="subcategory_name">Subcategory name<strong class="text-danger">*</strong></label>
                  <input type="text" id="subcategory_name" name="subcategory_name" class="form-control" placeholder="Subcategory name">
                  <span id="subcategory_name_error" class="validate text error-validate"></span>
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
{{--  <script src="{{ asset('admin/vendors/js/forms/select/form-select2.js') }}"></script>--}}
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
                          $("[name='subcategory_name']").val('');
                          $("[name='category_id'] option[value='']").prop('selected', true);
                          $(".select2-selection__rendered").text("Please select category...");
                          $('#subcategory_name_error').text('');
                          $("[name='subcategory_name']").removeClass('validate-input-error');
                          $('#category_id_error').text('');
                          $(".select2").removeClass('validate-input-error');
                      },
                      className: "btn-outline-primary"
                  }
              ],
              processing: true,
              serverSide: true,
              ajax: '{{ route('admin.product.subcategory.datatable') }}',
              columns: [
                  { data: 'type_name', name: 'type_name' },
                  { data: 'category_name', name: 'category_name' },
                  { data: 'subcategory_name', name: 'subcategory_name' },
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
              let category_id = $("[name='category_id'] :selected").val();
              let subcategory_name = $("[name='subcategory_name']").val();
              const id = $("[name='hidden']").val();
              Notiflix.Loading.Dots('Processing...');
              $.ajax({
                  url: "{{ route('admin.product.subcategory.store') }}",
                  type: "post",
                  dataType: 'json',
                  data: {
                      id: id,
                      category_id: category_id,
                      subcategory_name: subcategory_name
                  },
                  success: function (data) {
                      // console.log(data);
                      Notiflix.Loading.Remove();
                      if (data.errors){
                          console.log(data.errors);
                          if (data.errors.category_id && data.errors.subcategory_name){
                              $('#category_id_error').text(data.errors.category_id);
                              $(".select2").addClass('validate-input-error');
                              $('#subcategory_name_error').text(data.errors.subcategory_name);
                              $("[name='subcategory_name']").addClass('validate-input-error');
                          }
                          else if (data.errors.category_id){
                              $('#category_id_error').text(data.errors.category_id);
                              $("[name='category_id']").addClass('validate-input-error');
                              $('#subcategory_name_error').text('');
                              $(".select2").removeClass('validate-input-error');
                          }
                          else if(data.errors.subcategory_name){
                              $('#subcategory_name_error').text(data.errors.subcategory_name);
                              $(".select2").removeClass('validate-input-error');
                              $('#category_id_error').text('');
                              $("[name='subcategory_name']").addClass('validate-input-error');
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

          // set selected
          function initSelect2(control, key, value){
              var data = {
                  id: key,
                  text: value
              };
              var initOption = new Option(data.text, data.id, false, false);
              control.append(initOption);
              control.val(value).trigger('change');
          }
          // Ajax update
          $(document).on('click', '#edit', function () {
              $('#category_id_error').text('');
              $(".select2").removeClass('validate-input-error');
              $('#subcategory_name_error').text('');
              $("[name='subcategory_name']").removeClass('validate-input-error');

              const id = $(this).data('id');
              $('#category_name_error').text('');
              $("[name='category_name']").removeClass('validate-input-error');
              $('#type_name_error').text('');
              $(".select2").removeClass('validate-input-error');
              $('#inlineForm').modal('show');
              $('#permissionModalTitle').html('Category Update');
              $.get("{{ route('admin.product.subcategory.edit') }}", {id: id}, function (response) {
                  $("[name='hidden']").val(response.id);
                  $("[name='subcategory_name']").val(response.subcategory_name);
                  $("#select2-type_name-container").text(response.product_category_id);
                  $("[name='category_id']").val(response.product_category_id).prop('selected', true);
                  initSelect2( $("[name='category_id']"), response.product_category_id, response.product_category_id);
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
                          url: "{{ route('admin.product.subcategory.delete') }}",
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
