@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.products'))

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
  <!-- filepond for file upload -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/filepond/filepond-plugin-image-preview.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/filepond/filepond.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/filepond/filepond_custom.css') }}">
  <!-- filepond for file upload -->
  <link rel="stylesheet" href="{{ asset(mix('admin/css/pages/data-list-view.css')) }}">
  <link rel="stylesheet" href="{{ asset('admin/css/own.css') }}">
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
    body.dark-layout .modal .modal-content .form-control,
    body.dark-layout .modal .modal-body .form-control{
      background-color: #262c49 !important;
    }
    #select2-type_name-container:first-letter, .select2-results__group:first-letter{
      text-transform: uppercase !important;
    }
    .select2-results__group{
      color: dodgerblue;
    }
    .subcategory-note{
      display: none;
      position: absolute;
      top: -22px;
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
            {{--            <a class="dropdown-item" href="{{ route('admin.user.export', 'excel') }}" id="dt-export__excel"><i class="fa fa-file-excel-o"></i>Excel</a>--}}
            {{--            <a class="dropdown-item" href="{{ route('admin.user.export', 'pdf') }}" id="dt-export__pdf"><i class="fa fa-file-pdf-o"></i>Pdf</a>--}}
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
          <th>Code</th>
          <th>Name</th>
          <th>Cost Price</th>
          <th>Sale Price</th>
          <th>Discount</th>
          <th>Discount Amount</th>
          <th>Status</th>
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="permissionModalTitle">Product Create</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="product-form" method="POST" enctype="multipart/form-data">
          <div class="modal-body product">

            <section id="floating-label-layouts">
              <div class="row match-height">
                <div class="col-md-12 col-12">
                  <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-content">
                      <div class="card-body">
                        <div class="form-body">
                          <input type="hidden" name="id">
                          <div class="row">
                            <div class="col-6">
                              <div class="form-label-group">
                                <input type="text" id="code" class="form-control" placeholder="Code" name="code">
                                <label for="code">Code</label>
                                <span id="code_validate_error" class="validate text error-validate"></span>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-label-group">
                                <input type="text" id="name" class="form-control" name="name" placeholder="Name">
                                <label for="name">Name</label>
                                <span id="name_validate_error" class="validate text error-validate"></span>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-label-group">
                                <input type="text" id="cost_price" class="form-control currency" name="cost_price" data-a-sign="$ " placeholder="Cost Price">
                                <label for="cost_price">Cost Price</label>
                                <span id="cost_price_validate_error" class="validate text error-validate"></span>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-label-group">
                                <input type="text" id="sale_price" class="form-control currency" name="sale_price" data-a-sign="$ " placeholder="Sale Price">
                                <label for="sale_price ">Sale Price</label>
                                <span id="sale_price_validate_error" class="validate text error-validate"></span>
                              </div>
                            </div>
                            <div class="form-group col-4">
                              <fieldset class="checkbox">
                                <div class="vs-checkbox-con vs-checkbox-primary">
                                  <input type="checkbox" name="discount" id="discount">
                                  <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                  </span>
                                  <span class="">Discount?</span>
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-8">
                              <div class="form-label-group">
                                <input type="text" id="discount_amount" class="form-control currency" name="discount_amount" data-a-sign="% " data-v-max="100" data-v-min="0" placeholder="Discount Amount(%)" disabled>
                                <label for="discount_amount ">Discount Amount</label>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-label-group">
                                <select class="select2 form-control" name="category" id="category" data-placeholder="Select a category...">
                                  <option selected></option>
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
                                <span id="category_validate_error" class="validate text error-validate"></span>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-label-group">
                                <select class="select2 form-control" name="subcategory" id="subcategory" data-placeholder="Select a subcategory..." disabled="disabled">
                                  <!-- get data using Ajax -->
                                </select>
                                <span id="subcategory_validate_error" class="validate text error-validate"></span>
                                <p class="text-warning subcategory-note">Select <code>Category</code> first before select subcategory.</p>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-label-group">
                                <select class="select2 form-control" name="brand" id="brand" data-placeholder="Select a brand...">
                                  <option selected></option>
                                  @if(isset($brands))
                                    @foreach($brands as $keys => $brand)
                                      <optgroup label="{{ $keys }}">
                                        @foreach($brand as $item )
                                          <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                        @endforeach
                                      </optgroup>
                                    @endforeach
                                  @endif
                                </select>
                                <span id="brand_validate_error" class="validate text error-validate"></span>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-label-group">
                                <input type="text" id="video_link" class="form-control" name="video_link" placeholder="Youtube Link">
                                <label for="video_link">Youtube link</label>
                              </div>
                            </div>
                            <div class="col-6">
                              <fieldset class="form-label-group">
                                <textarea class="form-control" id="remark" name="remark" rows="3" placeholder="Remark"></textarea>
                                <label for="remark">Remark</label>
                              </fieldset>
                            </div>
                            <div class="col-12">
                              <input type="file" class="filepond" name="photos" id="product_images" multiple data-max-file-size="10MB" data-max-files="30" accept="image/*" />
                              <span id="photos_validate_error" class="validate text error-validate"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-save">{{ __('general.save_changes') }}</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('general.cancel') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset('admin/vendors/js/jquery.stepper.min.js') }}"></script>
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
  <script src="{{ asset('admin/vendors/js/forms/select/form-select2.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/fileuploader/fileuploader.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/forms/currency/autoNumeric.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/forms/currency/currency-form.js') }}"></script>
  <!-- filepond for file upload -->
  <script src="{{ asset('admin/vendors/js/filepond/filepond-plugin-file-encode.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/filepond/filepond-plugin-file-validate-size.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/filepond/filepond-plugin-image-exif-orientation.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/filepond/filepond-plugin-image-preview.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/filepond/filepond.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/filepond/filepond_custom.js') }}"></script>
  <!-- filepond for file upload -->
  <script>
      $(document).ready(function() {
          "use strict"
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          // global vairable for input field
          let code_input = $("#code");
          let name_input = $("#name");
          let cost_price_input = $("#cost_price");
          let sale_price_input = $("#sale_price");
          let category_input = $("#category");
          let subcategory_input = $("#subcategory");
          let brand_input = $("#brand");
          // init list view datatable
          var dataListView = $(".data-list-view").DataTable({
              responsive: true,
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
                          code_input.removeClass('is-invalid');
                          $('#code_validate_error').text('');
                          name_input.removeClass('is-invalid');
                          $('#name_validate_error').text('');
                          cost_price_input.removeClass('is-invalid');
                          $('#cost_price_validate_error').text('');
                          sale_price_input.removeClass('is-invalid');
                          $('#sale_price_validate_error').text('');
                          $('#category_validate_error').text('');
                          $('#subcategory_validate_error').text('');
                          $('#brand_validate_error').text('');
                          $('#photos_validate_error').text('');
                          $('#inlineForm').modal('show');
                      },
                      className: "btn-outline-primary"
                  }
              ],
              processing: true,
              serverSide: true,
              ajax: '{{ route('admin.product.datatable') }}',
              columns: [
                  { data: 'code', name: 'code' },
                  { data: 'name', name: 'name' },
                  { data: 'cost_price', name: 'cost_price'},
                  { data: 'sale_price', name: 'sale_price'},
                  { data: 'discount', name: 'discount', orderable: false, searchable: false, class: 'text-center' },
                  { data: 'discount_amount', name: 'discount_amount'},
                  { data: 'status', name: 'status', orderable: false, searchable: false, class: 'text-center' },
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

          // Discount Checkbox
          $("#discount").change(function (e) {
              e.preventDefault();
              if (this.checked){
                  $("#discount_amount").prop('disabled', false);
              }else{
                  $("#discount_amount").prop('disabled', true);
              }
          });

          // Change select option category value
          $("#category").change(function (e) {
              e.preventDefault();
              const id = $(this).val();
              let html = '';
              let selected = $("#category option").is(':selected');
              $.get("{{ route('admin.product.get.subcategory') }}", {id: id}, function (response) {
                  // console.log(response);
                  if (selected == true){
                      if (id !== ''){
                          $("#subcategory").prop('disabled', false);
                          html += '<option selectedtion>';
                          response.forEach(function (value) {
                              // console.log(value);
                              html+= '<option value="'+ value.id +'"> '+ value.subcategory_name +'</option>';
                          });
                          $("#subcategory").html('');
                          $("#subcategory").append(html);
                      }
                  }else{
                      $("#subcategory").prop('disabled', true);
                  }
              });
          });
          // Category Ajax CRUD
          //  Ajax store
          $("#product-form").submit(function (e) {
              e.preventDefault();
              let formData = new FormData(this);
              console.log($("#product_images")[0].files);
              // remove validate error
              code_input.removeClass('is-invalid');
              $('#code_validate_error').text('');
              name_input.removeClass('is-invalid');
              $('#name_validate_error').text('');
              cost_price_input.removeClass('is-invalid');
              $('#cost_price_validate_error').text('');
              sale_price_input.removeClass('is-invalid');
              $('#sale_price_validate_error').text('');
              $('#category_validate_error').text('');
              $('#subcategory_validate_error').text('');
              $('#brand_validate_error').text('');
              $('#photos_validate_error').text('');
              // end
              Notiflix.Loading.Dots('Processing...');
              $.ajax({
                  url: "{{ route('admin.product.store') }}",
                  method: "POST",
                  data: formData,
                  contentType: false,
                  cache: false,
                  processData: false,
                  dataType: "json",
                  success: function (data) {
                      console.log(data);
                      Notiflix.Loading.Remove();
                      if (data.errors){
                          if (data.errors.code){
                              code_input.addClass('is-invalid');
                              $('#code_validate_error').text(data.errors.code);
                          }
                          if (data.errors.name){
                              name_input.addClass('is-invalid');
                              $('#name_validate_error').text(data.errors.name);
                          }
                          if (data.errors.cost_price){
                              cost_price_input.addClass('is-invalid');
                              $('#cost_price_validate_error').text(data.errors.cost_price);
                          }
                          if (data.errors.sale_price){
                              sale_price_input.addClass('is-invalid');
                              $('#sale_price_validate_error').text(data.errors.sale_price);
                          }
                          if (data.errors.category){
                              $('#category_validate_error').text(data.errors.category);
                          }
                          if (data.errors.subcategory){
                              $('#subcategory_validate_error').text(data.errors.subcategory);
                          }
                          if (data.errors.brand){
                              $('#brand_validate_error').text(data.errors.brand);
                          }
                          if (data.errors.photos){
                              $('#photos_validate_error').text(data.errors.photos);
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
          let publicPath = '{{ URL::to('') }}';
          let brand_image_path = '{!! brand_image_path() !!}';
          $(document).on('click', '#edit', function () {
              const id = $(this).data('id');
              $("#brand-form")[0].reset();
              $('#inlineForm').modal('show');
              $('#permissionModalTitle').html('Brand Update');
              $.get("{{ route('admin.product.edit') }}", {id: id}, function (response) {
                  $("#brand_name").val(response.brand_name);
                  if (response.category == 'fashion'){
                      $("[name='category'] option[value='fashion']").prop('selected', true);
                  }
                  else{
                      $("[name='category'] option[value='beauty']").prop('selected', true);
                  }
                  $(".select2-selection__rendered").text(upperFirstLetter(response.category));
                  $("[name='about']").val(response.about);
                  $("#url").val(response.url);
                  $("[name='id']").val(response.id);
                  $(".thumbnail").removeClass('d-none');
                  $(".thumbnail img").attr('src', publicPath + '/' + brand_image_path + '/' + response.brand_image);
                  $("#hidden_image").attr('src', publicPath + '/' + brand_image_path + '/' +response.brand_image);
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
                          url: "{{ route('admin.product.delete') }}",
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

          //  function uppercase firstcase
          function upperFirstLetter(str) {
              str = str.toLowerCase().replace(/\b[a-z]/g, function(replace_latter) {
                  return replace_latter.toUpperCase();
              });  //Can use also /\b[a-z]/g
              return str;  //First letter capital in each word
          }
      });
  </script>
@endsection
