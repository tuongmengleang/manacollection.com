@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.product_stock'))
@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/extensions/nouislider.min.css') }}">
{{--  <link rel="stylesheet" href="{{ asset(mix('vendors/css/ui/prism.min.css')) }}">--}}
  <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('admin/css/plugins/extensions/noui-slider.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/pages/app-ecommerce-shop.css') }}">
@endsection

@section('content')

  <div class="content-detached content-right">
    <div class="content-body">
      <!-- Ecommerce Content Section Starts -->
{{--      <section id="ecommerce-header">--}}
{{--        <div class="row">--}}
{{--          <div class="col-sm-12">--}}
{{--            <div class="ecommerce-header-items">--}}
{{--              <div class="result-toggler">--}}
{{--                <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">--}}
{{--                  <span class="navbar-toggler-icon d-block d-lg-none"><i class="feather icon-menu"></i></span>--}}
{{--                </button>--}}
{{--                <div class="search-results">--}}
{{--                  16285 results found--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="view-options">--}}
{{--                <select class="price-options form-control" id="ecommerce-price-options">--}}
{{--                  <option selected>Featured</option>--}}
{{--                  <option value="1">Lowest</option>--}}
{{--                  <option value="2">Highest</option>--}}
{{--                </select>--}}
{{--                <div class="view-btn-option">--}}
{{--                  <button class="btn btn-white view-btn grid-view-btn active">--}}
{{--                    <i class="feather icon-grid"></i>--}}
{{--                  </button>--}}
{{--                  <button class="btn btn-white list-view-btn view-btn">--}}
{{--                    <i class="feather icon-list"></i>--}}
{{--                  </button>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </section>--}}
      <!-- Ecommerce Content Section Starts -->
      <!-- background Overlay when sidebar is shown  starts-->
      <div class="shop-content-overlay"></div>
      <!-- background Overlay when sidebar is shown  ends-->

      <!-- Ecommerce Search Bar Starts -->
{{--      <section id="ecommerce-searchbar">--}}
{{--        <div class="row mt-1">--}}
{{--          <div class="col-sm-12">--}}
{{--            <fieldset class="form-group position-relative">--}}
{{--              <input type="text" class="form-control search-product" id="iconLeft5" placeholder="Search here">--}}
{{--              <div class="form-control-position">--}}
{{--                <i class="feather icon-search"></i>--}}
{{--              </div>--}}
{{--            </fieldset>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </section>--}}
      <!-- Ecommerce Search Bar Ends -->

      <!-- Ecommerce Products Starts -->
      <section id="bg-variants">
{{--        <div class="row">--}}
{{--          <div class="col-12 mt-3 mb-1">--}}
{{--            <h4 class="text-uppercase">All of Products</h4>--}}
{{--          </div>--}}
{{--        </div>--}}
        <div class="row">
          @if($products)
            @foreach($products as $product)
              <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-info text-center bg-transparent">
                  <div class="card-content">
                    <img src="{{ url(product_image_path(). '/' . $product->productImage->original_images) }}" alt="element 04" width="200" class="float-left mt-2 pl-2">
                    <div class="card-body">
                      <h4 class="card-title mt-3">{{ $product->name}}</h4>
                      <p class="card-text mb-25">${{ number_format($product->sale_price,  2, '.', '.') }}</p>
                      <button class="btn btn-info mt-1">Buy Now</button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </section>
      <!-- Ecommerce Products Ends -->

      <!-- Ecommerce Pagination Starts -->
{{--      <section id="ecommerce-pagination">--}}
{{--        <div class="row">--}}
{{--          <div class="col-sm-12">--}}
{{--            <nav aria-label="Page navigation example">--}}
{{--              <ul class="pagination justify-content-center mt-2">--}}
{{--                <li class="page-item prev-item"><a class="page-link" href="#"></a></li>--}}
{{--                <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                <li class="page-item" aria-current="page"><a class="page-link" href="#">4</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">5</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">6</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">7</a></li>--}}
{{--                <li class="page-item next-item"><a class="page-link" href="#"></a></li>--}}
{{--              </ul>--}}
{{--            </nav>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </section>--}}
      <!-- Ecommerce Pagination Ends -->

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

                </ul>
              </div>
            </div>
            <!-- /Brand -->
            <hr>
            <!-- Rating section starts -->
{{--            <div id="ratings">--}}
{{--              <div class="ratings-title mt-1 pb-75">--}}
{{--                <h6 class="filter-title mb-0">Ratings</h6>--}}
{{--              </div>--}}
{{--              <div class="d-flex justify-content-between">--}}
{{--                <ul class="unstyled-list list-inline ratings-list mb-0">--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li>& up</li>--}}
{{--                </ul>--}}
{{--                <div class="stars-received">(160)</div>--}}
{{--              </div>--}}
{{--              <div class="d-flex justify-content-between">--}}
{{--                <ul class="unstyled-list list-inline ratings-list mb-0">--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li>& up</li>--}}
{{--                </ul>--}}
{{--                <div class="stars-received">(176)</div>--}}
{{--              </div>--}}
{{--              <div class="d-flex justify-content-between">--}}
{{--                <ul class="unstyled-list list-inline ratings-list mb-0">--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li>& up</li>--}}
{{--                </ul>--}}
{{--                <div class="stars-received">(291)</div>--}}
{{--              </div>--}}
{{--              <div class="d-flex justify-content-between">--}}
{{--                <ul class="unstyled-list list-inline ratings-list mb-0 ">--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>--}}
{{--                  <li>& up</li>--}}
{{--                </ul>--}}
{{--                <div class="stars-received">(190)</div>--}}
{{--              </div>--}}
{{--            </div>--}}
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

@endsection

@section('vendor-script')
  <!-- Vendor js files -->
{{--  <script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>--}}
  <script src="{{ asset('admin/vendors/js/extensions/wNumb.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/extensions/nouislider.min.js') }}"></script>
  <script src="{{ asset(mix('admin/vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset('admin/js/scripts/pages/app-ecommerce-shop.js') }}"></script>
@endsection
