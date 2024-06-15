@extends('master.main')
@section('title', $product->name)
@section('main')

<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">{{ $product->name }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- shop-details-area -->
    <section class="shop-details-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="shop-details-images-wrap">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active" id="itemOne-tab-pane" role="tabpanel" aria-labelledby="itemOne-tab" tabindex="0">
                                <a href="uploads/product/{{$product->image}}" class="popup-image">
                                    <img id="big-img" src="uploads/product/{{$product->image}}" alt="{{$product->name}}" width="100%">
                                </a>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link">
                                    <img class="thumb-image" src="uploads/product/{{$product->image}}" alt="" width="125px">
                                </button>
                            </li>
                            @foreach($product->images as $img)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link">
                                    <img class="thumb-image" src="uploads/product/{{$img->image}}" alt="" width="125px">
                                </button>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shop-details-content">
                        <h2 class="title">{{ $product->name }}</h2>
                        <div class="review-wrap">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <h3 class="price">${{ number_format($product->price) }} <span>- {{ $product->status == 1 ? 'In stock' : 'Out stock' }}</span></h3>
                        <!-- <div class="product-count-wrap">
                            <span class="title">Hurry Up! Sale ends in:</span>
                            <div class="coming-time" data-countdown="2024/7/6"></div>
                        </div> -->
                        <p>{{ $product->description }}</p>
                        
                        <a href="{{ route('cart.add', $product->id) }}" class="buy-btn">Buy it now</a>
                        <div class="payment-method-wrap">
                            <span class="title">GUARANTEED SAFE CHECKOUT:</span>
                            <img src="uploads/product/payment_method.png" alt="">
                        </div>
                        <!-- <div class="shop-add-Wishlist">
                            <a href="#"><i class="far fa-heart"></i>Add to Wishlist</a>
                        </div> -->
                        <!-- <div class="sd-sku">
                            <span class="title">SKU:</span>
                            <a href="#">002</a>
                        </div>
                        <div class="sd-category">
                            <span class="title">CATEGORY:</span>
                            <ul class="list-wrap">
                                <li><a href="#">lipstick</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- shop-details-area-end -->

    

</main>

@stop()

@section('js')
<script>
    $('.thumb-image').click(function(e) {
        e.preventDefault();

        var _url = $(this).attr('src');

        $('#big-img').attr('src', _url)
    })

</script>

@stop()
