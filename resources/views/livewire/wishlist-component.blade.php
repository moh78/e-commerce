<main id="main" class="main-site">

    
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
              <li class="item-link"><a href="#" class="link">home</a></li>
              <li class="item-link"><span>Wishlist</span></li>
            </ul>
        </div>
          
          @if(Cart::instance('wishlist')->count() > 0)
        <div class="wrap-show-advance-info-box style-1 box-in-site">
            <h3 class="title-box">Wishlist</h3>
            <div class="wrap-products">
            <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                @foreach (Cart::instance('wishlist')->content() as $product)
                <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="{{route('product.details',['slug'=>$product->model->slug])}}" title="{{$product->name}}">
                            <figure><img src="{{ asset('assets/images/products') }}/{{$product->model->image}}" width="214" height="214" alt="{{$product->name}}"></figure>
                            </a>
                            {{-- <div class="group-flash">
                            <span class="flash-item new-label">new</span>
                            </div> --}}
                            {{-- <div class="wrap-btn">
                            <a href="#" class="function-link">quick view</a>
                            </div> --}}
                        </div>

                        <div class="product-info">
                            <a href="#" class="product-name"><span>{{$product->name}}</span></a>
                            <div class="wrap-price"><span class="product-price">{{$product->model->regular_price}}€</span></div>
                        </div>
                </div>
                @endforeach
                @else

                <div class="text-center" style="padding:30px 0;">
                    <h1>Your Wishlist is empty!</h1>
                    <p>Add items to it now</p>
                    <a href="/shop" class="btn btn-success">Wish Now</a>
                </div> 
            
                @endif

         </div>
    </div><!--End wrap-products-->
</main>