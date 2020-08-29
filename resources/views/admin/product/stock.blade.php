@extends('admin.layouts.contentLayoutMaster')

@section('title', __('general.product_stock'))
@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/extensions/nouislider.min.css') }}">
{{--  <link rel="stylesheet" href="{{ asset(mix('vendors/css/ui/prism.min.css')) }}">--}}
  <link rel="stylesheet" href="{{ mix('admin/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/notiflix/notiflix-2.1.2.min.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('admin/vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('admin/css/plugins/extensions/noui-slider.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/pages/app-ecommerce-shop.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/own.css') }}">

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

      <div class="reload" id="refresh">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M12.011 20c0-0.002 0-0.003 0-0.005 0-4.421 3.578-8.005 7.991-8.005 2.683 0 5.051 1.329 6.5 3.361l1.26-1.644c-1.834-2.254-4.627-3.696-7.76-3.696 -5.519 0-9.994 4.471-10.001 9.989H8.013l3.018 4.013L13.987 20H12.011zM32 20l-2.969-3.985L26 20h1.992c-0.003 4.419-3.579 8.001-7.99 8.001 -2.716 0-5.111-1.36-6.555-3.435l-1.284 1.644c1.832 2.314 4.66 3.803 7.84 3.803 5.524 0 10.001-4.478 10.001-10.001 0-0.004-0.001-0.008-0.001-0.012H32z"/>
        </svg>
      </div>

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
{{--        <div class="row">--}}
{{--          @if($products)--}}
{{--            @foreach($products as $product)--}}
{{--              <div class="col-lg-3 col-md-4 col-sm-6">--}}
{{--                <div class="card border-info text-center bg-transparent">--}}
{{--                  <div class="card-content">--}}
{{--                    <img src="{{ url(product_image_path(). '/' . $product->productImage->original_images) }}" alt="element 04" width="200" class="float-left mt-2 pl-2">--}}
{{--                    <div class="card-body">--}}
{{--                      <h4 class="card-title mt-3">{{ $product->name}}</h4>--}}
{{--                      <p class="card-text mb-25">${{ number_format($product->sale_price,  2, '.', '.') }}</p>--}}
{{--                      <button class="btn btn-info mt-1 buyNow">Buy Now</button>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            @endforeach--}}
{{--          @endif--}}
{{--        </div>--}}
        <div class="card-grid" id="block__card__skeleton">
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
          <div class="card__skeleton">
            {{--            <div class="card-img skeleton">--}}
            {{--              <!-- waiting for img to load from javascript -->--}}
            {{--            </div>--}}
            <div class="card-body">
              <h2 class="card-category skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <h2 class="card-title skeleton">
                <!-- wating for title to load from javascript -->
              </h2>
              <p class="card-intro skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
              <p class="card-instock skeleton">
                <!-- waiting for intro to load from Javascript -->
              </p>
            </div>
          </div>
        </div>

        <div class="card-grid" id="block__card">
{{--          <div class="card" href="#">--}}
{{--            <div class="card__background" style="background-image: url(https://prod.kooding.com/productListingImage/214892-2/62fc5cdc4659346263cc70ff8ba7b56ad9fffeae.jpg)"></div>--}}
{{--            <div class="card__content">--}}
{{--              <p class="card__category">Clothes</p>--}}
{{--              <p class="card__category">Shirts</p>--}}
{{--              <h3 class="card__heading">Benito Phillip Blouse</h3>--}}
{{--            </div>--}}
{{--            <div class="card__button">--}}
{{--              <a href="javascript:void(0)" data-id="" class="circle addStock">--}}
{{--                <i class="fa fa-cart-plus"></i>--}}
{{--              </a>--}}
{{--            </div>--}}
{{--            <div class="prod-info">--}}
{{--              <div class="stock-text">--}}
{{--                      <span>--}}
{{--                          In Stock :--}}
{{--                          100--}}
{{--                          </strong>--}}
{{--                          <strong></strong>--}}
{{--                      </span>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          @if($products)--}}
{{--            @foreach($products as $key => $product)--}}
{{--              <div class="card" href="#">--}}
{{--                <div class="card__background" style="background-image: url('{{ url(product_image_path(). '/' . $product->productImage->original_images) }}')"></div>--}}
{{--                <div class="card__content">--}}
{{--                  <p class="card__category">{{ $product->category->category_name }}</p>--}}
{{--                  <p class="card__category">{{ $product->subcategory->subcategory_name }}</p>--}}
{{--                  <h3 class="card__heading">{{ $product->name }}</h3>--}}
{{--                </div>--}}
{{--                <div class="card__button">--}}
{{--                  <a href="javascript:void(0)" data-id="{{ $product->id }}" class="circle addStock">--}}
{{--                    <i class="fa fa-cart-plus"></i>--}}
{{--                  </a>--}}
{{--                </div>--}}
{{--                <div class="prod-info">--}}
{{--                  <div class="stock-text">--}}
{{--                      <span>--}}
{{--                          In Stock :--}}
{{--                          <strong class="countStock{{ $product->id }}">--}}
{{--                            @foreach($count_quantity as $key => $item)--}}
{{--                              @if($product->id === $key)--}}
{{--                                {{$item}}--}}
{{--                              @endif--}}
{{--                            @endforeach--}}
{{--                            {{ isset($count_quantity[$product->id]) ? "" : "0" }}--}}
{{--                          </strong>--}}
{{--                          <strong></strong>--}}
{{--                      </span>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            @endforeach--}}
{{--          @endif--}}
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
                <li>
                  <span class="vs-radio-con vs-radio-primary py-25">
                      <input type="radio" name="price-range" value="false">
                      <span class="vs-radio">
                          <span class="vs-radio--border"></span>
                          <span class="vs-radio--circle"></span>
                      </span>
                      <span class="ml-50"><=$10</span>
                  </span>
                </li>
                <li>
                  <span class="vs-radio-con vs-radio-primary py-25">
                      <input type="radio" name="price-range" value="false">
                      <span class="vs-radio">
                          <span class="vs-radio--border"></span>
                          <span class="vs-radio--circle"></span>
                      </span>
                      <span class="ml-50">$10 - $50</span>
                  </span>
                </li>
                <li>
                  <span class="vs-radio-con vs-radio-primary py-25">
                      <input type="radio" name="price-range" value="false">
                      <span class="vs-radio">
                          <span class="vs-radio--border"></span>
                          <span class="vs-radio--circle"></span>
                      </span>
                      <span class="ml-50">$50 - $100</span>
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
                <h6 class="filter-title mb-1">Subcategory</h6>
              </div>

              <ul class="list-unstyled categories-list">
                <li>
                  <span class="vs-radio-con vs-radio-primary py-25">
                      <input type="radio" name="category-filter" checked value="">
                      <span class="vs-radio">
                          <span class="vs-radio--border"></span>
                          <span class="vs-radio--circle"></span>
                      </span>
                      <span class="ml-50">All</span>
                  </span>
                </li>
                <li class="py-25">
                  @if($subcategories)
                    @foreach($subcategories as $subcategory)
                      <span class="vs-radio-con vs-radio-primary py-25">
                        <input type="radio" name="category-filter" data-id="{{ $subcategory->id }}" value="{{ $subcategory->id }}" >
                        <span class="vs-radio">
                            <span class="vs-radio--border"></span>
                            <span class="vs-radio--circle"></span>
                        </span>
                        <span class="ml-50">{{ $subcategory->subcategory_name }}</span>
                      </span>
                    @endforeach
                  @endif
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

                  @if($brands)
                    @foreach($brands as $brand)
                      <li class="d-flex justify-content-between align-items-center py-25">
                        <span class="vs-checkbox-con vs-checkbox-primary">
                            <input type="checkbox" class="brand__checkbox" name="brand_checkbox" data-id="{{ $brand->id }}">
                            <span class="vs-checkbox">
                                <span class="vs-checkbox--check">
                                    <i class="vs-icon feather icon-check"></i>
                                </span>
                            </span>
                            <span class="">{{ $brand->brand_name }}</span>
                        </span>
                        <span>{{ $brand->products->count() }}</span>
                      </li>
                    @endforeach
                  @endif

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
{{--            <hr>--}}
            <!-- Clear Filters Starts -->
            <div id="clear-filters">
              <button id="clearFilterButton" class="btn btn-block btn-primary">CLEAR ALL FILTERS</button>
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
                            <div class="col-12">
                              <input type="hidden" id="product_id">
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
            <button type="submit" id="addStock" class="btn btn-primary">{{ __('general.buy') }}</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('general.cancel') }}</button>
          </div>
      </div>
    </div>
  </div>

@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('admin/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
  <script src="{{ asset('admin/vendors/js/notiflix/notiflix-2.1.2.min.js') }}"></script>

@endsection
@section('page-script')
  <!-- Page js files -->
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

          $(document).on('click', "#refresh", function () {
              $('#block__card__skeleton').removeClass('d-none');
              request();
              clearAllFilter();
          });

          $(document).on('click', "#clearFilterButton", function () {
             request();
             clearAllFilter();
          });

          // Clear all filter input
          function clearAllFilter() {
            $("input[name='brand_checkbox']").prop('checked', false);
            $("input[name=category-filter][value='']").prop("checked",true);
          }

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
                          html += '<div class="card" href="#">\n' +
                              '                <div class="card__background" style="background-image: url('+image_url+')"></div>\n' +
                              '                <div class="card__content">\n' +
                              '                  <p class="card__category">'+product.category.category_name+'</p>\n' +
                              '                  <p class="card__category">'+product.subcategory.subcategory_name+'</p>\n' +
                              '                  <h3 class="card__heading">'+product.name+'</h3>\n' +
                              '                </div>\n' +
                              '                <div class="card__button">\n' +
                              '                  <a href="javascript:void(0)" data-id="'+product.id+'" class="circle addStock">\n' +
                              '                    <i class="fa fa-cart-plus"></i>\n' +
                              '                  </a>\n' +
                              '                </div>\n' +
                              '                <div class="prod-info">\n' +
                              '                  <div class="stock-text">\n' +
                              '                      <span>\n' +
                              '                          In Stock :\n' +
                              '                          <strong class="countStock'+product.id+'">\n' +
                              '                           '+ product.product_stock.quantity +'' +
                              '                          </strong>\n' +
                              '                          <strong></strong>\n' +
                              '                      </span>\n' +
                              '                  </div>\n' +
                              '                </div>\n' +
                              '              </div>';
                      });
                      $('#block__card__skeleton').addClass('d-none');
                      $("#block__card").html('');
                      $("#block__card").append(html);
                  },
                  error: function (data) {
                      console.log("Error", data);
                  }
              });
          };

         $("body").on('click', ".addStock", function () {
             $('#quantity_id_error').text("");
             let product_id = $(this).data("id");
             $('#product_id').val(product_id);
             $("#quantity").val('');
             $("#addStockForm").modal('show');
         });
         $(document).on('click', "#addStock", function () {
             const product_id = $("#product_id").val();
             // console.log(product_id);
             let quantity = $("#quantity").val();
             let html = '';
             Notiflix.Loading.Dots('Processing...');
             $.ajax({
                 url: "{{ route('admin.product.stock.add') }}",
                 type: "POST",
                 dataType: "json",
                 data: {
                     product_id: product_id,
                     quantity: quantity,
                 },
                 success: function (data) {
                     Notiflix.Loading.Remove();
                     if (data.errors){
                         $('#quantity_id_error').text(data.errors.quantity);
                     }
                     $("#addStockForm").modal('hide');
                     Notiflix.Notify.Success(data.message);

                     $.ajax({
                         type: "POST",
                         url: "{{ route('admin.product.count.stock') }}",
                         dataType: "json",
                         data: {
                           id : product_id
                         },
                         success: function (data) {
                             // console.log(data);
                             $('.countStock' + product_id).html(data);
                         },
                         error: function (data) {
                             console.log("Error" + data);
                         }
                     });
                 },
                 error: function (data) {
                     console.log("Error" + data);
                 }
             });
         });

       // checkbox check one only
          $('.brand__checkbox').on('change', function() {
              $('#block__card__skeleton').removeClass('d-none');
              let brand_ids = [];
              $('.brand__checkbox:checked').each(function () {
                  brand_ids.push($(this).data('id'));
              });
              let html = '';
              $.ajax({
                  type: "GET",
                  url: "{{ route('admin.product.filter.product') }}",
                  data: { brand_ids : brand_ids },
                  dataType: "json",
                  success: function (data) {
                      $('#block__card__skeleton').addClass('d-none');
                      // console.log(data);
                      $.each(data, function (index, product) {
                          let image_url = "'" +base_url+ '/' + product_image_path + '/' + product.product_image.original_images + "'";
                          html += '<div class="card" href="#">\n' +
                              '                <div class="card__background" style="background-image: url('+image_url+')"></div>\n' +
                              '                <div class="card__content">\n' +
                              '                  <p class="card__category">'+product.category.category_name+'</p>\n' +
                              '                  <p class="card__category">'+product.subcategory.subcategory_name+'</p>\n' +
                              '                  <h3 class="card__heading">"'+product.name+'"</h3>\n' +
                              '                </div>\n' +
                              '                <div class="card__button">\n' +
                              '                  <a href="javascript:void(0)" data-id="'+product.id+'" class="circle addStock">\n' +
                              '                    <i class="fa fa-cart-plus"></i>\n' +
                              '                  </a>\n' +
                              '                </div>\n' +
                              '                <div class="prod-info">\n' +
                              '                  <div class="stock-text">\n' +
                              '                      <span>\n' +
                              '                          In Stock :\n' +
                              '                          <strong class="countStock'+product.id+'">\n' +
                              '                           '+ product.product_stock.quantity +'' +
                              '                          </strong>\n' +
                              '                          <strong></strong>\n' +
                              '                      </span>\n' +
                              '                  </div>\n' +
                              '                </div>\n' +
                              '              </div>';
                      });
                      $("#block__card").html('');
                      $("#block__card").append(html);
                  },
                  error: function (data) {
                      console.log('Error', data);
                  }
              });
          });


          $("[name='category-filter']").on('change', function () {
             const subcategory_id = $(this).data("id");
              $('#block__card__skeleton').removeClass('d-none');
             let html = '';
             $.ajax({
                type: "GET",
                url: "{{ route('admin.product.filter.product') }}",
                data: { subcategory_id : subcategory_id },
                dataType: "json",
                success: function (data) {
                    $('#block__card__skeleton').addClass('d-none');
                    // console.log(data);
                    $.each(data, function (index, product) {
                        let image_url = "'" +base_url+ '/' + product_image_path + '/' + product.product_image.original_images + "'";
                        html += '<div class="card" href="#">\n' +
                            '                <div class="card__background" style="background-image: url('+image_url+')"></div>\n' +
                            '                <div class="card__content">\n' +
                            '                  <p class="card__category">'+product.category.category_name+'</p>\n' +
                            '                  <p class="card__category">'+product.subcategory.subcategory_name+'</p>\n' +
                            '                  <h3 class="card__heading">"'+product.name+'"</h3>\n' +
                            '                </div>\n' +
                            '                <div class="card__button">\n' +
                            '                  <a href="javascript:void(0)" data-id="'+product.id+'" class="circle addStock">\n' +
                            '                    <i class="fa fa-cart-plus"></i>\n' +
                            '                  </a>\n' +
                            '                </div>\n' +
                            '                <div class="prod-info">\n' +
                            '                  <div class="stock-text">\n' +
                            '                      <span>\n' +
                            '                          In Stock :\n' +
                            '                          <strong class="countStock'+product.id+'">\n' +
                            '                           '+ product.product_stock.quantity +'' +
                            '                          </strong>\n' +
                            '                          <strong></strong>\n' +
                            '                      </span>\n' +
                            '                  </div>\n' +
                            '                </div>\n' +
                            '              </div>';
                    });
                    $("#block__card").html('');
                    $("#block__card").append(html);
                },
                 error: function (data) {
                     console.log("Error" + data);
                 }
             });
          });

      });
  </script>
@endsection
