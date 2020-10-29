<main class="card-layout" id="productInfo__card">
    @if($products)
        @foreach($products as $product)
            <div class="card-info" style="background-image: url('{{ url(product_image_path(). '/' . $product->productImage->original_images) }}')">
                <div class="content-info">
                    <h2 class="title">{{ $product->name }}</h2>
                    <p class="copy">{{ $product->category->category_name }}</p>
                    <p class="copy">{{ $product->subcategory->subcategory_name }}</p>
                    <button class="btn__add__quantity addQuantity" data-id="{{ $product->id }}">Add Quantity</button>
                    <div class="prod-info">
                        <div class="stock-text">
                            <span> Total In Stock :
                                <strong class="countStock{{$product->id}}">
                                    @if($total_quantity)
                                        @foreach($total_quantity as $key => $quantity)
                                            @if($product->id == $key)
                                                {{ $quantity }}
                                            @endif
                                        @endforeach
                                        {{ isset($total_quantity[$product->id]) ? "" : "0" }}
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</main>
<div class="d-flex">
    <div class="mx-auto">
        {{$products->links("pagination::bootstrap-4")}}
    </div>
</div>