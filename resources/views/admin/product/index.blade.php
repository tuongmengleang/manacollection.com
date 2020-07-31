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
  <!-- image-uploader -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/image-uploader/image-uploader.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/image-uploader/custom.css') }}">
{{--  <link rel='stylesheet' href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>--}}
{{--  <link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css'>--}}
  <!-- image-uploader -->
  <!-- photoswipe -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/default-skin/default-skin.min.css'>
  <!-- photoswipe -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/magnific/custom.css') }}">
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

    /* Icons Font Face*/
    @font-face {
      font-family: 'Image Uploader Icons';
      /*src: url('../fonts/iu.eot');*/
      src: url('{{ asset('admin/vendors/css/image-uploader/fonts/iu.eot') }}');
      /*src: url('../fonts/iu.eot') format('embedded-opentype'),*/
      src: url('{{ asset('admin/vendors/css/image-uploader/fonts/iu.eot') }}') format('embedded-opentype'),
        /*url('../fonts/iu.ttf') format('truetype'),*/
      url('{{ asset('admin/vendors/css/image-uploader/fonts/iu.ttf') }}') format('truetype'),
        /*url('../fonts/iu.woff') format('woff'),*/
      url('{{ asset('admin/vendors/css/image-uploader/fonts/iu.woff') }}') format('woff'),
        /*url('../fonts/iu.svg') format('svg');*/
      url('{{ asset('admin/vendors/css/image-uploader/fonts/iu.svg') }}') format('svg');
      font-weight: normal;
      font-style: normal;
    }
    body.dark-layout .custom-switch .custom-control-label:before{
      background-color: #10163a;
    }
    .pswp__img{
      /*width: 445px !important;*/
      height: auto !important;
    }
    .video.youtube iframe{
      width: 70%;
      height: 500px;
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

  <!-- Modal Product -->
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
                              <div class="checkbox">
                                <div class="vs-checkbox-con vs-checkbox-primary">
                                  <input type="checkbox" name="discount" id="discount">
                                  <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                  </span>
                                  <span class="">Discount?</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-8">
                              <div class="form-label-group">
                                <input type="text" id="discount_amount" class="form-control currency" name="discount_amount" data-a-sign="% " data-v-max="100" data-v-min="0" placeholder="Discount Amount(%)" disabled>
                                <label for="discount_amount ">Discount Amount</label>
                                <span id="discountAmount_validate_error" class="validate text error-validate"></span>
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
                                <input type="hidden" name="hidden_subcategory" />
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
                                <label for="video_link">Youtube iFrame</label>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-label-group">
                                <textarea class="form-control" id="remark" name="remark" rows="3" placeholder="Remark"></textarea>
                                <label for="remark">Remark</label>
                              </div>
                            </div>
                            <div class="col-12">
{{--                              <label for="">Product Photos<strong class="text-danger">*</strong></label>--}}
                              <div class="input-images"></div>
                              <span id="photos_validate_error" class="validate text error-validate"></span>
                            </div>
                            <div id="previewPanel" class="col-12 mt-1 d-none">
                              <h6 class="text-center">Product Images Preview</h6>
                              <div class="image-uploader mb-4">
                                <div class="uploaded" id="imagesPreview">
                                </div>
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

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-save">{{ __('general.save_changes') }}</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('general.cancel') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Upload Image -->
  <div class="modal fade" id="imageForm" tabindex="-1" role="dialog" aria-labelledby="permissionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="permissionModalTitle">Product Create</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="uploadForm" action="{{ route('admin.product.upload') }}" method="POST" enctype="multipart/form-data">
          <div class="modal-body product-image">
            <section id="floating-label-layouts">
              <div class="row match-height">
                <div class="col-md-12 col-12">
                  <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-content">
                      <div class="card-body">
                        <div class="form-body">
                          <input type="hidden" name="product_id" id="product_id">
                          <div class="row">
                            <div class="col-12">
                              <input type="file" name="images" multiple data-max-files="10" accept="image/png, image/jpeg, image/jpg, image/gif"/>
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
            <button type="submit" id="upload" class="btn btn-primary">{{ __('general.save_changes') }}</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('general.cancel') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal View -->
  <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Product Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body product-detail">

          <section id="knowledge-base-content">
            <div class="row search-content-info">
              <div class="col-md-12 col-sm-12 col-12 search-content">
                <div class="card">
                  <div class="card-body text-center">
                    <div class="row">
                      <div class="col-6">
                        <label for="">
                          {{ __('Product Code') }}:<h4 id="code_view"></h4>
                        </label>
                      </div>
                      <div class="col-6">
                        <label for="">
                          {{ __('Product Name') }}: <h4 id="name_view"></h4>
                        </label>
                      </div>
                    </div>
                    <hr/>
                    <div class="row">
                      <div class="col-6">
                        <label for="">
                          {{ __('Cost Price') }}: <i class="fa fa-usd"></i> <h4 id="costPrice_view"></h4>
                        </label>
                      </div>
                      <div class="col-6">
                        <label for="">
                          {{ __('Sale Price') }}: <i class="fa fa-usd"></i> <h4 id="salePrice_view"></h4>
                        </label>
                      </div>
                    </div>
                    <hr/>
                    <div class="row">
                      <div class="col-6">
                        <label for="">
                          {{ __('Discount') }}:<h4 id="discount_view"></h4>
                        </label>
                      </div>
                      <div class="col-6">
                        <label for="">
                          {{ __('Discount Amount') }}: <i class="feather icon-percent"></i> <h4 id="discountAmount_view"></h4>
                        </label>
                      </div>
                    </div>
                    <hr/>
                    <div class="row">
                      <div class="col-6">
                        <label for="">
                          {{ __('Remark') }}:<h6 id="remark_view"></h6>
                        </label>
                      </div>
                      <div class="col-6">
                        <label for="">
                          {{ __('Status') }}:
                          <h4 id="status_view">

                          </h4>
                        </label>
                      </div>
                    </div>
                    <hr/>
                    <div class="row">
                      <div class="col-4">
                        <label for="">
                          {{ __('Product Type') }}:
                        </label>
                        <br>
                        <div class="chip chip-primary mr-1">
                          <div class="chip-body">
                            <div class="avatar">
                              <i class="feather icon-align-left"></i>
                            </div>
                            <span id="type_view" class="chip-text"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <label for="">
                          {{ __('Product Category') }}:
                        </label>
                        <br>
                        <div class="chip chip-primary mr-1">
                          <div class="chip-body">
                            <div class="avatar">
                              <i class="feather icon-align-left"></i>
                            </div>
                            <span id="category_view" class="chip-text"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <label for="">
                          {{ __('Product Subcategory') }}:
                        </label>
                        <br>
                        <div class="chip chip-primary mr-1">
                          <div class="chip-body">
                            <div class="avatar">
                              <i class="feather icon-align-left"></i>
                            </div>
                            <span id="subcategory_view" class="chip-text"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr/>
                    <div class="row">
                      <div class="col-12">
                        <div class="gallery" itemscope="" itemtype="http://schema.org/ImageGallery">
                          <!-- append data by ajax -->
                        </div>
                        <!-- Root element of PhotoSwipe. Must have class pswp.-->
                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                          <!--
                          Background of PhotoSwipe.
                          It's a separate element as animating opacity is faster than rgba().
                          -->
                          <div class="pswp__bg"></div>
                          <!-- Slides wrapper with overflow:hidden.-->
                          <div class="pswp__scroll-wrap">
                            <!--
                            Container that holds slides.
                            PhotoSwipe keeps only 3 of them in the DOM to save memory.
                            Don't modify these 3 pswp__item elements, data is added later on.
                            -->
                            <div class="pswp__container">
                              <div class="pswp__item"></div>
                              <div class="pswp__item"></div>
                              <div class="pswp__item"></div>
                            </div>
                            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
                            <div class="pswp__ui pswp__ui--hidden">
                              <div class="pswp__top-bar">
                                <!-- Controls are self-explanatory. Order can be changed.-->
                                <div class="pswp__counter"></div>
                                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                <button class="pswp__button pswp__button--share" title="Share"></button>
                                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR-->
                                <!-- element will get class pswp__preloader--active when preloader is running-->
                                <div class="pswp__preloader">
                                  <div class="pswp__preloader__icn">
                                    <div class="pswp__preloader__cut">
                                      <div class="pswp__preloader__donut"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                <div class="pswp__share-tooltip"></div>
                              </div>
                              <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                              <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                              <div class="pswp__caption">
                                <div class="pswp__caption__center"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-12">
                        <div class="video youtube">

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
          <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
        </div>
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
  <script src="{{ asset('admin/vendors/js/forms/currency/autoNumeric.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/forms/currency/currency-form.js') }}"></script>
  <!-- image-uploader -->
  <script src="{{ asset('admin/vendors/js/image-uploader/image-uploader.min.js') }}"></script>
  <!-- image-uploader -->
  <!-- photoswipe -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.0.2/lazysizes.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.2/photoswipe-ui-default.js'></script>
  <!-- photoswipe -->
  <script src="{{ asset('admin/vendors/js/magnific/custom.js') }}"></script>
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
          let discount_amount = $("#discount_amount");
          let category_input = $("#category");
          let subcategory_input = $("#subcategory");
          let brand_input = $("#brand");
          let product_form = $("#product-form")[0];
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
                          $("[name='id']").val('');
                          resetForm();
                          removeValidateError();
                          $("#previewPanel").addClass('d-none');
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
                  { data: 'cost_price', name: 'cost_price', class: 'text-center' },
                  { data: 'sale_price', name: 'sale_price', class: 'text-center' },
                  { data: 'discount', name: 'discount', orderable: false, searchable: false, class: 'text-center' },
                  { data: 'discount_amount', name: 'discount_amount', class: 'text-center' },
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
          let actionDropdown = $(".actions-dropodown")
          actionDropdown.insertBefore($(".top .actions .dt-buttons"))

          // Scrollbar
          if ($(".data-items").length > 0) {
              new PerfectScrollbar(".data-items", { wheelPropagation: false })
          }

          function resetForm(){
              subcategory_input.prop("disabled", true);
              discount_amount.attr('disabled','disabled');
              $(".image-uploader").removeClass('has-files');
              $(".uploaded").html('');
              $(".uploaded-image img").attr('src', '');
              $("#select2-brand-container").text('Select a category...');
              $("#select2-category-container").text('Select a subcategory...');
              $("#select2-subcategory-container").text('Select a brand...');
              product_form.reset();
          }

          function removeValidateError(){
              code_input.removeClass('is-invalid');
              $('#code_validate_error').text('');
              name_input.removeClass('is-invalid');
              $('#name_validate_error').text('');
              cost_price_input.removeClass('is-invalid');
              $('#cost_price_validate_error').text('');
              sale_price_input.removeClass('is-invalid');
              $('#sale_price_validate_error').text('');
              discount_amount.removeClass('is-invalid');
              $("#discountAmount_validate_error").text('');
              $('#category_validate_error').text('');
              $('#subcategory_validate_error').text('');
              $('#brand_validate_error').text('');
              $('#photos_validate_error').text('');
          }

          // Discount Checkbox
          $(document).on('change', "#discount", function (e) {
              e.preventDefault();
              if (this.checked){
                  $("#discount_amount").prop('disabled', false);
              }else{
                  $("#discount_amount").prop('disabled', true);
                  discount_amount.val('');
                  discount_amount.removeClass('is-invalid');
                  $("#discountAmount_validate_error").text('');
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
                  $("[name='hidden_subcategory']").val("");
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
              // remove validate error
              removeValidateError();
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
                          if (data.errors.discount_amount){
                              discount_amount.addClass('is-invalid');
                              $("#discountAmount_validate_error").text(data.errors.discount_amount);
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
          let product_image_path = '{!! product_image_path() !!}';
          $(document).on('click', '#edit', function () {
              const id = $(this).data('id');
              resetForm();
              removeValidateError();
              $('#inlineForm').modal('show');
              $('#permissionModalTitle').html('Product Update');
              $.get("{{ route('admin.product.edit') }}", {id: id}, function (response) {
                  if (response.product){
                      $("[name='id']").val(response.product.id);
                      code_input.val(response.product.code);
                      name_input.val(response.product.name);
                      cost_price_input.val('$ ' + response.product.cost_price.toFixed(2));
                      sale_price_input.val('$ ' + response.product.sale_price.toFixed(2));
                      if (response.product.discount == 1){
                          $("#discount").prop('checked', true);
                          discount_amount.prop('disabled', false);
                          discount_amount.val('% ' + response.product.discount_amount);
                      }
                      $("#video_link").val(response.product.video_link);
                      $("#remark").val(response.product.remark);
                  }
                  if (response.category){
                      category_input.val(response.category.id).prop('selected', true);
                      $("#select2-category-container").text(response.category.category_name);
                  }
                  if (response.subcategory){
                      // $("#subcategory").val(response.subcategory.id).prop('selected', true);
                      // $('#subcategory option[value="'+response.subcategory.id+'"]').prop("selected", true);
                      $("[name='hidden_subcategory']").val(response.subcategory.id);
                      $("#select2-subcategory-container").text(response.subcategory.subcategory_name);
                  }
                  if (response.brand){
                      brand_input.val(response.brand.id).prop('selected', true);
                      $("#select2-brand-container").text(response.brand.brand_name);
                  }
                  if (response.product_images){
                      $("#previewPanel").removeClass('d-none');
                      showUploadedImgs(response.product_images);
                  }
                  console.log(response);
              });
          });

          // Display uploaded pictures when click edit
          function showUploadedImgs( imgs ){
              let pic = '';
              for (let i = 0 ; i <imgs.length ; i++){
                  // pic += '<img width=30% src="'+ publicPath + '/' + product_image_path + '/' + imgs[i].original_images +'" />';
                  pic += '<div class="uploaded-image" id="'+imgs[i].id+'" data-preuploaded="true">' +
                            '<img src="'+publicPath + '/' + product_image_path + '/' + imgs[i].original_images+'">' +
                            '<button type="button" id="deleteProductImage" class="delete-image" data-id="'+imgs[i].id+'">' +
                            '<i class="feather icon-x"></i>' +
                            ' </button>' +
                         '</div>';
              }
              $('#imagesPreview').html('');
              $('#imagesPreview').append( pic );
          }

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

          // Upload Product image
          $(document).on('click', '#upload_images', function () {
              const id = $(this).data('id');
              console.log(id);
              $("#product_id").val(id);
              $.post("{{ route('admin.product.upload') }}", {id: id}, function (response) {
                  console.log(response);
              });
              $("#imageForm").modal('show');
          });

          $('.input-images').imageUploader({
              imagesInputName: 'photos',
              preloadedInputName: 'images',
              label: 'Drag & Drop files here or click to browse',
              maxSize: 2 * 1024 * 1024,
              maxFiles: null
          });

          $(document).on('click', "#deleteProductImage", function () {
              const id = $(this).data('id');
              Notiflix.Confirm.Show(
                  'Delete Confirm?',
                  'Are you sure delete this image?',
                  'Yes',
                  'Cancel',
                  // Yes Button Function
                  function () {
                      $.post("{{ route('admin.product.delete.image') }}", {id: id}, function (response) {
                          console.log(response);
                          if(response.message){
                              $("#"+id).remove();
                              Notiflix.Notify.Success(response.message);
                          }

                      });
                  },
                  // Cancel Button Function
                  function () {

                  }
              );
          });

          // Ajax change status product
          $(document).on('change', "[name='status']", function (e) {
              e.preventDefault();
              let status = $(this).prop("checked") === true ? 1 : 0;
              let id = $(this).data("id");
              $.post("{{ route('admin.product.status') }}", {id: id, status: status}, function (response) {
                  if (response.status_enabled){
                      Notiflix.Notify.Success(response.status_enabled);
                  }
                  else{
                      Notiflix.Notify.Success(response.status_disabled);
                  }
              });
          });

          // Ajax View detail
          $(document).on('click', "#view", function () {
              const id = $(this).data('id');
              console.log(id);
              $('#modalView').modal('show');
              $.get("{{ route('admin.product.product.view') }}", {id: id}, function (response) {
                  if (response.product){
                      console.log(response);
                      $("#code_view").text(response.product.code);
                      $("#name_view").text(response.product.name);
                      $("#costPrice_view").text('$' + response.product.cost_price.toFixed(2));
                      $("#salePrice_view").text('$' + response.product.sale_price.toFixed(2));
                      if (response.product.discount == 1){
                          $("#discount_view").html('');
                          $("#discount_view").append('Yes<a href="javascript:void(0)" class=""><span class="text-success"><i class="feather icon-check"></i></span></a>');
                      }
                      else{
                          $("#discount_view").html('');
                          $("#discount_view").append('No<a href="javascript:void(0)" class=""><span class="text-warning"><i class="feather icon-x"></i></span></a>');
                      }
                      if (response.product.discount_amount != null){
                          $("#discountAmount_view").text('%' + response.product.discount_amount);
                      }
                      else{
                          $("#discountAmount_view").text('%0');
                      }
                      $("#remark_view").text(response.product.remark);
                      if (response.product.status == 1){
                          let statusView = '<div class="chip-wrapper">\n' +
                              '                              <div class="chip mb-0">\n' +
                              '                                <div class="chip-body">\n' +
                              '                                  <span class="chip-text"><span class="bullet bullet-success bullet-xs"></span> Enabled</span>\n' +
                              '                                </div>\n' +
                              '                              </div>\n' +
                              '                            </div>';
                          $("#status_view").html('');
                          $("#status_view").append(statusView)
                      }
                      else{
                          let statusView = '<div class="chip-wrapper">\n' +
                              '                              <div class="chip mb-0">\n' +
                              '                                <div class="chip-body">\n' +
                              '                                  <span class="chip-text"><span class="bullet bullet-danger bullet-xs"></span> Disabled</span>\n' +
                              '                                </div>\n' +
                              '                              </div>\n' +
                              '                            </div>';
                          $("#status_view").html('');
                          $("#status_view").append(statusView)
                      }
                      if (response.product.video_link != null){
                          $('.video.youtube').removeClass('d-none');
                          $('.video.youtube').html('');
                          $('.video.youtube').append(response.product.video_link);
                      }
                      else{
                          $('.video.youtube').html('');
                      }
                  }
                  $("#type_view").text(upperFirstLetter(response.category.type_name));
                  $("#category_view").text(response.category.category_name);
                  $("#subcategory_view").text(response.subcategory.subcategory_name);
                  if (response.product_images){
                      viewUploadedImgs(response.product_images);
                  }
              });
          });

          // Display uploaded pictures when click view
          function viewUploadedImgs( imgs ){
              let pic = '';
              for (let i = 0 ; i <imgs.length ; i++){
                  pic += '<figure class="gallery-item" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">\n' +
                      '    <a href="'+publicPath + '/' + product_image_path + '/' + imgs[i].original_images+'" itemprop="contentUrl" data-size="1000x1000">\n' +
                      '      <img class="lazyload lazypreload fadein" src="data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D\'http://www.w3.org/2000/svg\'%20viewBox%3D\'0%200%20500%20500\'%20%2F%3E" data-src="'+publicPath + '/' + product_image_path + '/' + imgs[i].original_images+'" itemprop="thumbnail" alt="Image description"/>\n' +
                      '    </a>\n' +
                      // '    <figcaption class="gallery-caption" itemprop="caption description">Caption</figcaption>\n' +
                      '  </figure>';
              }
              $(".gallery").html('');
              $(".gallery").append(pic);
          }

      });

      // FilePond
      {{--FilePond.registerPlugin(FilePondPluginImagePreview);--}}
      {{--FilePond.setOptions({--}}
      {{--    // fileRenameFunction: (file) => {--}}
      {{--    //     // return `${file.name}`;--}}
      {{--    //     console.log(`${file.name}`);--}}
      {{--    // },--}}
      {{--    server: {--}}
      {{--        url: "{{ route('admin.product.upload') }}",--}}
      {{--        headers: {--}}
      {{--            'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
      {{--        }--}}
      {{--    }--}}
      {{--});--}}
      {{--const inputElement = document.querySelector('input[type="file"]');--}}
      {{--const pond = FilePond.create( inputElement);--}}


  </script>
@endsection
