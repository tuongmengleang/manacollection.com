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
{{--  <link rel="stylesheet" href="{{ asset('admin/css/own.css') }}">--}}
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
    /*.categories-list{*/
    /*  width: 100%;*/
    /*  height: 200px;*/
    /*  overflow: scroll;*/
    /*}*/
    .card-body, .collapse-margin .card-body{
      padding: 0 1.5rem;
    }
    .collapse-margin .card-header{
      padding: 0 5px !important;
    }
    .card-header{
      padding-bottom: 0px !important;
    }
    .accordion{
      cursor: pointer;
    }
    body.dark-layout .collapse-margin{
      box-shadow: none !important;
    }
    .card{
      margin-bottom: 0 !important;
    }
    input.form-control{
      background-color: #10163a !important;
    }
  </style>
@endsection


@section('content')
    <div class="content-detached content-right">
        <div class="content-body">
            <section id="ecommerce-searchbar">
              <div class="row mt-1">
                <div class="col-sm-12">
                  <fieldset class="form-group position-relative">
                    <input type="text" class="form-control search-product" id="product_name" name="product_name" placeholder="Search here">
                    <div class="form-control-position">
                      <i class="feather icon-search"></i>
                    </div>
                  </fieldset>
                </div>
              </div>
            </section>
            <section id="bg-variants">
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

                <div class="d-flex">
                    <div class="mx-auto">
                        {{$products->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </section>

        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h6 class="filter-heading d-none d-lg-block">Filters</h6>
      </div>
      <div class="col-md-12">
        <div class="card left-side">
          <div class="card-body">
            <!-- Categories Starts -->
            <div id="product-categories">
              <div class="product-category-title mt-2">
                <h6 class="filter-title mb-1">Subcategories</h6>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <span class="vs-radio-con vs-radio-primary py-25 ml-0">
                    <input type="radio" name="subcategory-filter" value="" checked>
                    <span class="vs-radio">
                        <span class="vs-radio--border"></span>
                        <span class="vs-radio--circle"></span>
                    </span>
                    <span class="ml-50">All</span>
                </span>
                </div>
              </div>

              <div class="card bg-transparent border-0 shadow-none collapse-icon accordion-icon-rotate">
                <div class="accordion search-content-info" id="accordionExample">
                  <div class="collapse-margin search-content mt-0">
                    <div class="card-header" id="headingOne" role="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      <span>Women</span>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        @foreach($subcategories as $subcategory)
                          @if ($subcategory->categories->type_name == 'women')
                            <div class="row">
                              <span class="vs-radio-con vs-radio-primary py-25">
                                  <input type="radio" name="subcategory-filter" value="{{ $subcategory->id }}">
                                  <span class="vs-radio">
                                      <span class="vs-radio--border"></span>
                                      <span class="vs-radio--circle"></span>
                                  </span>
                                  <span class="ml-50">{{ $subcategory->subcategory_name }}</span>
                              </span>
                            </div>
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="collapse-margin">
                    <div class="card-header" id="headingTwo" role="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <span>Men</span>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        @foreach($subcategories as $subcategory)
                          @if ($subcategory->categories->type_name == 'men')
                            <div class="row">
                            <span class="vs-radio-con vs-radio-primary py-25">
                                <input type="radio" name="subcategory-filter" value="{{ $subcategory->id }}">
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="ml-50">{{ $subcategory->subcategory_name }}</span>
                            </span>
                            </div>
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="collapse-margin">
                    <div class="card-header" id="headingThree" role="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <span>Beauty</span>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        @foreach($subcategories as $subcategory)
                          @if ($subcategory->categories->type_name == 'beauty')
                            <div class="row">
                            <span class="vs-radio-con vs-radio-primary py-25">
                                <input type="radio" name="subcategory-filter" value="{{ $subcategory->id }}">
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="ml-50">{{ $subcategory->subcategory_name }}</span>
                            </span>
                            </div>
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>

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
                  @foreach($brands as $brand)
                    <li class="d-flex justify-content-between align-items-center py-25">
                      <span class="vs-checkbox-con vs-checkbox-primary">
                          <input type="checkbox" name="brand-filter" value="{{ $brand->id }}">
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
                </ul>
              </div>
            </div>
            <!-- /Brand -->
            <hr>
            <!-- Clear Filters Starts -->
            <div id="clear-filters" class="mb-2">
              <button id="clearAllFilter" class="btn btn-block btn-primary">CLEAR ALL FILTERS</button>
            </div>
            <!-- Clear Filters Ends -->

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="addStockForm" tabindex="-1" role="dialog" aria-labelledby="permissionModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="permissionModalTitle">Product Information Create</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form id="product_infoForm" method="POST">
                @csrf
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
                                                    <input type="hidden" name="product_id" id="product_id">
                                                    <div class="col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="color" class="form-control" name="color" placeholder="Color">
                                                            <label for="name">Color</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="size" class="form-control" name="size" placeholder="Size">
                                                            <label for="name">Size</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <div class="input-group input-group-lg">
                                                                <input type="number" id="quantity" name="quantity" class="touchspin" placeholder="0">
                                                            </div>
                                                        </div>
                                                        <span id="quantity_validate_error" class="validate text error-validate" style="margin-left: 10px"></span>
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
            </form>
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
                    url: "{{ route('admin.product.info.fetchData') }}",
                    dataType: "json",
                    success: function (data) {
                        $.each(data.products.data, function (index, product) {
                            let image_url = "'" +base_url+ '/' + product_image_path + '/' + product.product_image.original_images + "'";
                            html += '<div class="card-info" style="background-image: url('+image_url+')">';
                            html += '<div class="content-info">';
                            html += '<h2 class="title">'+product.name+'</h2>';
                            html += '<p class="copy">'+product.category.category_name+'</p>';
                            html += '<p class="copy">'+product.subcategory.subcategory_name+'</p>';
                            html += '<button class="btn__add__quantity addQuantity" data-id="'+product.id+'">Add Quantity</button>';
                            html += '<div class="prod-info">';
                            html += '<div class="stock-text">';
                            html += '<span> Total In Stock :';
                            html += '<strong class="countStock'+product.id+'">';
                            $.each(data.total_quantity, function (key, item) {
                                if (product.id == key){
                                    html += item;
                                }
                            });
                            html += '</strong>';
                            html += '</span>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
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

            // Ajax Pagination
            $(document).on('click', ".pagination li a", function (e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchData(page);
            });

            function fetchData(page) {
                $('#block__card__skeleton').removeClass('d-none');
                $("#productInfo__card").html('');
                let html = '';
                $.ajax({
                    type: 'GET',
                    url: "{{ route('admin.product.info.fetchData.pagination') }}",
                    data: { page : page },
                    dataType: "json",
                    success: function (data) {
                        $.each(data.products.data, function (index, product) {
                            let image_url = "'" +base_url+ '/' + product_image_path + '/' + product.product_image.original_images + "'";
                            html += '<div class="card-info" style="background-image: url('+image_url+')">';
                            html += '<div class="content-info">';
                            html += '<h2 class="title">'+product.name+'</h2>';
                            html += '<p class="copy">'+product.category.category_name+'</p>';
                            html += '<p class="copy">'+product.subcategory.subcategory_name+'</p>';
                            html += '<button class="btn__add__quantity addQuantity" data-id="'+product.id+'">Add Quantity</button>';
                            html += '<div class="prod-info">';
                            html += '<div class="stock-text">';
                            html += '<span> Total In Stock :';
                            html += '<strong class="countStock'+product.id+'">';
                            $.each(data.total_quantity, function (key, item) {
                                if (product.id == key){
                                    html += item;
                                }
                            });
                            html += '</strong>';
                            html += '</span>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        });
                        $('#block__card__skeleton').addClass('d-none');
                        $("#productInfo__card").html('');
                        $("#productInfo__card").append(html);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

            // Clear all filter input
            $("#clearAllFilter").click(function () {
                request();
               clearAllFilter();
            });
            function clearAllFilter() {
                $("input[name=subcategory-filter][value='']").prop("checked",true);
                $("input[name='brand-filter']").prop('checked', false);
                $("input[name='product_name']").val('');
            }

            $(document).on('click', ".addQuantity", function () {
                const product_id = $(this).data('id');
                $('#product_id').val(product_id);
                clearInput();
                clearValidateError();
                $("#addStockForm").modal('show');
            });

            function clearInput() {
                $("input[name='color']").val('');
                $("input[name='size']").val('');
                $("input[name='quantity']").val('');
            }

            function clearValidateError(){
                $("#quantity_validate_error").text('');
            }

            $(document).on('submit', "#product_infoForm", function (e) {
                e.preventDefault();
                const product_id = $("#product_id").val();
                let formData = new FormData(this);
                let html = '';
                Notiflix.Loading.Dots('Processing...');
                $.ajax({
                    url: "{{ route('admin.product.info.add') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        Notiflix.Loading.Remove();
                        if (data.errors){
                            if (data.errors.quantity){
                                $("#quantity_validate_error").text(data.errors.quantity);
                            }
                        }
                        else{
                            $('#addStockForm').modal('hide');
                            Notiflix.Notify.Success(data.message);
                            $.ajax({
                                type: "GET",
                                url: "{{ route('admin.product.info.count.stock') }}",
                                dataType: "json",
                                success: function (response) {
                                    $.each(response, function (i, value) {
                                        if (product_id == i){
                                            html = value;
                                        }
                                    });
                                    $('.countStock' + product_id).html(html);
                                },
                                error: function (data) {
                                    console.log("Error", data);
                                }
                            });
                        }
                    },
                    error: function (data) {
                        console.log('Error', data);
                    }
                });
            });

        //    Brand Filter
            $("input[name='brand-filter']").on('change', function () {
                $('#block__card__skeleton').removeClass('d-none');
                $("input[name=subcategory-filter][value='']").prop("checked",true);
                let brand_ids = [];
                $("input[name='brand-filter']:checked").each(function () {
                    brand_ids.push($(this).val());
                });
                let html = '';
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.product.info.filter.product.by.brand') }}",
                    data: { brand_ids : brand_ids },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.products.length === 0){
                            html = '<h2 class="text-center">Search Not Found!</h2>';
                        }
                        $.each(data.products, function (index, product) {
                            let image_url = "'" +base_url+ '/' + product_image_path + '/' + product.product_image.original_images + "'";
                            html += '<div class="card-info" style="background-image: url('+image_url+')">';
                            html += '<div class="content-info">';
                            html += '<h2 class="title">'+product.name+'</h2>';
                            html += '<p class="copy">'+product.category.category_name+'</p>';
                            html += '<p class="copy">'+product.subcategory.subcategory_name+'</p>';
                            html += '<button class="btn__add__quantity addQuantity" data-id="'+product.id+'">Add Quantity</button>';
                            html += '<div class="prod-info">';
                            html += '<div class="stock-text">';
                            html += '<span> Total In Stock :';
                            html += '<strong class="countStock'+product.id+'">';
                            $.each(data.total_quantity, function (key, item) {
                                if (product.id == key){
                                    html += item;
                                }
                            });
                            html += '</strong>';
                            html += '</span>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        });
                        $('#block__card__skeleton').addClass('d-none');
                        $("#productInfo__card").html('');
                        $("#productInfo__card").append(html);
                    },
                    error: function (data) {
                        console.log("Error", data);
                    }
                });
            });

        //    Subcategory Filter
            $("input[name='subcategory-filter']").on('change', function () {
                $('#block__card__skeleton').removeClass('d-none');
                const subcategory_id = $(this).val();
                $("input[name='brand-filter']").prop('checked', false);
                let html = '';
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.product.info.filter.product.by.subcategory') }}",
                    data: { subcategory_id : subcategory_id },
                    dataType: 'json',
                    success: function (data) {
                        if (data.products.length === 0){
                            html = '<h2 class="text-center">Search Not Found!</h2>';
                        }
                        $.each(data.products, function (index, product) {
                            let image_url = "'" +base_url+ '/' + product_image_path + '/' + product.product_image.original_images + "'";
                            html += '<div class="card-info" style="background-image: url('+image_url+')">';
                            html += '<div class="content-info">';
                            html += '<h2 class="title">'+product.name+'</h2>';
                            html += '<p class="copy">'+product.category.category_name+'</p>';
                            html += '<p class="copy">'+product.subcategory.subcategory_name+'</p>';
                            html += '<button class="btn__add__quantity addQuantity" data-id="'+product.id+'">Add Quantity</button>';
                            html += '<div class="prod-info">';
                            html += '<div class="stock-text">';
                            html += '<span> Total In Stock :';
                            html += '<strong class="countStock'+product.id+'">';
                            $.each(data.total_quantity, function (key, item) {
                                if (product.id == key){
                                    html += item;
                                }
                            });
                            html += '</strong>';
                            html += '</span>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        });
                        $('#block__card__skeleton').addClass('d-none');
                        $("#productInfo__card").html('');
                        $("#productInfo__card").append(html);
                    },
                    error: function (data) {
                        console.log("Error", data);
                    }
                });
            });

        //    Product name Filter
            $("input[name='product_name']").keyup(function () {
                $('#block__card__skeleton').removeClass('d-none');
               let product_name = $(this).val();
               let html = '';
               $.ajax({
                   type: "GET",
                   url: "{{ route('admin.product.info.filter.product.by.name') }}",
                   data: { product_name : product_name },
                   dataType: 'json',
                   success: function (data) {
                       $.each(data.products, function (index, product) {
                           let image_url = "'" +base_url+ '/' + product_image_path + '/' + product.product_image.original_images + "'";
                           html += '<div class="card-info" style="background-image: url('+image_url+')">';
                           html += '<div class="content-info">';
                           html += '<h2 class="title">'+product.name+'</h2>';
                           html += '<p class="copy">'+product.category.category_name+'</p>';
                           html += '<p class="copy">'+product.subcategory.subcategory_name+'</p>';
                           html += '<button class="btn__add__quantity addQuantity" data-id="'+product.id+'">Add Quantity</button>';
                           html += '<div class="prod-info">';
                           html += '<div class="stock-text">';
                           html += '<span> Total In Stock :';
                           html += '<strong class="countStock'+product.id+'">';
                           $.each(data.total_quantity, function (key, item) {
                               if (product.id == key){
                                   html += item;
                               }
                           });
                           html += '</strong>';
                           html += '</span>';
                           html += '</div>';
                           html += '</div>';
                           html += '</div>';
                           html += '</div>';
                       });
                       $('#block__card__skeleton').addClass('d-none');
                       $("#productInfo__card").html('');
                       $("#productInfo__card").append(html);
                   },
                   error: function (data) {
                       console.log("Error", data);
                   }
               });
            });

        });
    </script>
@endsection
