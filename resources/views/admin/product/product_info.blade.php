@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.product_stock'))
@section('vendor-style')
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/extensions/nouislider.min.css') }}">
  <link rel="stylesheet" href="{{ mix('admin/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/notiflix/notiflix-2.1.2.min.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
{{--    <link rel="stylesheet" href="{{ asset('admin/css/extra/card-skeleton.css') }}">--}}
  <link rel="stylesheet" href="{{ asset('admin/css/plugins/extensions/noui-slider.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/pages/app-ecommerce-shop.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/own.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/extra/product_info_card.css') }}">
  <style>
    body.dark-layout .modal .modal-content .form-control,
    body.dark-layout .modal .modal-body .form-control{
      background-color: #262c49 !important;
    }
    .validate.text{
      font-size: 13px;
      font-family: "Comic Sans MS";
    }
    .validate.text.error-validate{
      color: red;
    }
    .bootstrap-touchspin.input-group-lg{
      width: 100% !important;
    }
  </style>
@endsection


@section('content')
    <div class="content-detached content-right">
        <div class="content-body">

            <section id="bg-variants">
{{--                <div class="card-grid" id="block__card__skeleton">--}}
{{--                    <div class="card__skeleton">--}}
{{--                        <div class="card-body">--}}
{{--                            <h2 class="card-category skeleton">--}}
{{--                                <!-- wating for title to load from javascript -->--}}
{{--                            </h2>--}}
{{--                            <h2 class="card-title skeleton">--}}
{{--                                <!-- wating for title to load from javascript -->--}}
{{--                            </h2>--}}
{{--                            <p class="card-intro skeleton">--}}
{{--                                <!-- waiting for intro to load from Javascript -->--}}
{{--                            </p>--}}
{{--                            <p class="card-instock skeleton">--}}
{{--                                <!-- waiting for intro to load from Javascript -->--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <main class="card-layout" id="block__card__skeleton">
                    <div class="card-info-skeleton">
                        <p class="card-title skeleton"></p>
                        <p class="card-category skeleton"></p>
                        <p class="card-button skeleton"></p>
                        <p class="card-stock skeleton"></p>
                    </div>
                    <div class="card-info-skeleton">
                        <p class="card-title skeleton"></p>
                        <p class="card-category skeleton"></p>
                        <p class="card-button skeleton"></p>
                        <p class="card-stock skeleton"></p>
                    </div>
                    <div class="card-info-skeleton">
                        <p class="card-title skeleton"></p>
                        <p class="card-category skeleton"></p>
                        <p class="card-button skeleton"></p>
                        <p class="card-stock skeleton"></p>
                    </div>
                    <div class="card-info-skeleton">
                        <p class="card-title skeleton"></p>
                        <p class="card-category skeleton"></p>
                        <p class="card-button skeleton"></p>
                        <p class="card-stock skeleton"></p>
                    </div>
                    <div class="card-info-skeleton">
                        <p class="card-title skeleton"></p>
                        <p class="card-category skeleton"></p>
                        <p class="card-button skeleton"></p>
                        <p class="card-stock skeleton"></p>
                    </div>
                    <div class="card-info-skeleton">
                        <p class="card-title skeleton"></p>
                        <p class="card-category skeleton"></p>
                        <p class="card-button skeleton"></p>
                        <p class="card-stock skeleton"></p>
                    </div>
                    <div class="card-info-skeleton">
                        <p class="card-title skeleton"></p>
                        <p class="card-category skeleton"></p>
                        <p class="card-button skeleton"></p>
                        <p class="card-stock skeleton"></p>
                    </div>
                    <div class="card-info-skeleton">
                        <p class="card-title skeleton"></p>
                        <p class="card-category skeleton"></p>
                        <p class="card-button skeleton"></p>
                        <p class="card-stock skeleton"></p>
                    </div>
                </main>
                <main class="card-layout" id="productInfo__card">

                </main>
            </section>

        </div>
    </div>
    <div class="sidebar-detached sidebar-left">
        <div class="sidebar">
            <!-- Ecommerce Sidebar Starts -->
            <div class="sidebar-shop" id="ecommerce-sidebar-toggler">

                <div class="row">
                    <div class="col-sm-12">
                        <h6 class="filter-heading d-none d-lg-block">Filters</h6>
                    </div>
                </div>
                <span class="sidebar-close-icon d-block d-md-none">
                            <i class="feather icon-x"></i>
                        </span>
                <div class="card">
                    <div class="card-body">
                        <div class="multi-range-price">
                            <div class="multi-range-title pb-75">
                                <h6 class="filter-title mb-0">Multi Range</h6>
                            </div>
                            <ul class="list-unstyled price-range" id="price-range">
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" checked value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">All</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> &lt;=$10</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">$10 - $100</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">$100 - $500</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">&gt;= $500</span>
                                            </span>
                                </li>

                            </ul>
                        </div>
                        <!-- /Price Filter -->
                        <hr>
                        <!-- /Price Slider -->
                        <div class="price-slider">
                            <div class="price-slider-title mt-1">
                                <h6 class="filter-title mb-0">Slider</h6>
                            </div>
                            <div class="price-slider">
                                <div class="price_slider_amount mb-2">
                                </div>
                                <div class="form-group">
                                    <div class="slider-sm my-1 range-slider" id="price-slider"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /Price Range -->
                        <hr>
                        <!-- Categories Starts -->
                        <div id="product-categories">
                            <div class="product-category-title">
                                <h6 class="filter-title mb-1">Categories</h6>
                            </div>
                            <ul class="list-unstyled categories-list">
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false" checked>
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Appliances</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> Audio</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Cameras & Camcorders</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Car Electronics & GPS</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Cell Phones</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Computers & Tablets</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> Health, Fitness & Beauty</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Office & School Supplies</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">TV & Home Theater</span>
                                            </span>
                                </li>
                                <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Video Games
                                                </span>
                                            </span>
                                </li>

                            </ul>
                        </div>
                        <!-- Categories Ends -->
                        <hr>
                        <!-- Brands -->
                        <div class="brands">
                            <div class="brand-title mt-1 pb-1">
                                <h6 class="filter-title mb-0">Brands</h6>
                            </div>
                            <div class="brand-list" id="brands">
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Insignia™</span>
                                                </span>
                                        <span>746</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">
                                                        Samsung
                                                    </span>
                                                </span>
                                        <span>633</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">
                                                        Metra
                                                    </span>
                                                </span>
                                        <span>591</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">HP</span>
                                                </span>
                                        <span>530</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Apple</span>
                                                </span>
                                        <span>442</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">GE</span>
                                                </span>
                                        <span>394</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Sony</span>
                                                </span>
                                        <span>350</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Incipio</span>
                                                </span>
                                        <span>320</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">KitchenAid</span>
                                                </span>
                                        <span>318</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Whirlpool</span>
                                                </span>
                                        <span>298</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Brand -->
                        <hr>
                        <!-- Rating section starts -->
                        <div id="ratings">
                            <div class="ratings-title mt-1 pb-75">
                                <h6 class="filter-title mb-0">Ratings</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <ul class="unstyled-list list-inline ratings-list mb-0">
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li>& up</li>
                                </ul>
                                <div class="stars-received">(160)</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <ul class="unstyled-list list-inline ratings-list mb-0">
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li>& up</li>
                                </ul>
                                <div class="stars-received">(176)</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <ul class="unstyled-list list-inline ratings-list mb-0">
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li>& up</li>
                                </ul>
                                <div class="stars-received">(291)</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <ul class="unstyled-list list-inline ratings-list mb-0 ">
                                    <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                    <li>& up</li>
                                </ul>
                                <div class="stars-received">(190)</div>
                            </div>
                        </div>
                        <!-- Rating section Ends -->
                        <hr>
                        <!-- Clear Filters Starts -->
                        <div id="clear-filters">
                            <button class="btn btn-block btn-primary">CLEAR ALL FILTERS</button>
                        </div>
                        <!-- Clear Filters Ends -->

                    </div>
                </div>
            </div>
            <!-- Ecommerce Sidebar Ends -->

        </div>
    </div>

    <div class="modal fade" id="addStockForm" tabindex="-1" role="dialog" aria-labelledby="permissionModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="permissionModalTitle">Product Stock Create</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <section id="floating-label-layouts">
              <div class="row match-height">
                <div class="col-md-12 col-12">
                  <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-content">
                      <div class="card-body">
                        <div class="form-body">
                          <div class="row">
                            <input type="hidden" id="product_id">
                            <div class="col-12">
                              <div class="form-label-group">
                                <input type="text" id="color" class="form-control" name="color" placeholder="Color">
                                <label for="name">Color</label>
                                <span id="color_validate_error" class="validate text error-validate"></span>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-label-group">
                                <input type="text" id="size" class="form-control" name="size" placeholder="Size">
                                <label for="name">Size</label>
                                <span id="size_validate_error" class="validate text error-validate"></span>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-flex align-items-center mb-1">
                                <div class="input-group input-group-lg">
                                  <input type="number" id="quantity" name="quantity" class="touchspin" placeholder="0">
                                </div>
                              </div>
                              <span id="quantity_id_error" class="validate text error-validate" style="margin-left: 10px"></span>
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
            <button type="submit" id="addQuantity" class="btn btn-primary">{{ __('general.buy') }}</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('general.cancel') }}</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('admin/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
  <script src="{{ asset('admin/vendors/js/notiflix/notiflix-2.1.2.min.js') }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset('admin/vendors/js/extensions/nouislider.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/extensions/wNumb.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/forms/number/number-input.min.js') }}"></script>
  <script src="{{ asset('admin/js/scripts/pages/app-ecommerce-shop.js') }}"></script>
  <script src="{{ asset('admin/js/scripts/own.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            "use strict"
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Global variable
            let base_url = "{{ url('/') }}";
            let product_image_path = "{{ product_image_path() }}";

            // Load Data without refresh
            request();

            function request() {
                let html = '';
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.product.fetchData') }}",
                    dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        $.each(data, function (index, product) {
                            let image_url = "'" +base_url+ '/' + product_image_path + '/' + product.product_image.original_images + "'";
                            html += ' <div class="card-info" style="background-image: url('+image_url+')">\n' +
                                '                                <div class="content-info">\n' +
                                '                                    <h2 class="title">'+product.name+'</h2>\n' +
                                '                                    <p class="copy">'+product.category.category_name+'</p>\n' +
                                '                                    <p class="copy">'+product.subcategory.subcategory_name+'</p>\n' +
                                '                                    <button class="btn__add__quantity addQuantity" data-id="'+product.id+'">Add Quantity</button>\n' +
                                '                                </div>\n' +
                                '                            </div>';
                        });
                        $('#block__card__skeleton').addClass('d-none');
                        $("#productInfo__card").html('');
                        $("#productInfo__card").append(html);
                    },
                    error: function (data) {
                        console.log("Error", data);
                    }
                });
            };

            $(document).on('click', ".addQuantity", function () {
                const product_id = $(this).data('id');
                $('#product_id').val(product_id);
                clearInput();
                $("#addStockForm").modal('show');
            });

            function clearInput() {
                $("input[name='color']").val('');
                $("input[name='size']").val('');
                $("input[name='quantity']").val('');
            }

            $(document).on('click', "#addQuantity", function () {

            });


        });
    </script>
@endsection
