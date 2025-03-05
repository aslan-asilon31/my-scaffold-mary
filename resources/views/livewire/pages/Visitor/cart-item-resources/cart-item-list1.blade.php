<div>
           <!-- ========================  Main header ======================== -->

           <section class="main-header" style="background-image:url(assets/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title">{{ $title }}</h2>
                    <ol class="breadcrumb breadcrumb-inverted">
                        <li><a href="index.html"><span class="icon icon-home"></span></a></li>
                        <li><a class="active" href="checkout-1.html">Cart Lists</a></li>
                        <li><a href="checkout-2.html">Checkout</a></li>
                        <li><a href="checkout-4.html">Invoice</a></li>
                    </ol>
                </div>
            </header>
        </section>

        <!-- ========================  Checkout ======================== -->

        <div class="step-wrapper">
            <div class="container">

                <div class="stepper">
                    <ul class="row">
                        <li class="col-md-4 active">
                            <span data-text="Cart items"></span>
                        </li>
                        <li class="col-md-4">
                            <span data-text="Checkout"></span>
                        </li>
                        <li class="col-md-4">
                            <span data-text="Invoice"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <section class="checkout">

            <div class="container">

                <header class="hidden">
                    <h3 class="h3 title">Checkout - Step 1</h3>
                </header>

                <!-- ========================  Cart wrapper ======================== -->

                <div class="cart-wrapper">
                    <!--cart header -->

                    <div class="cart-block cart-block-header clearfix">
                        <div>
                            <span>Product</span>
                        </div>
                        <div>
                            <span>&nbsp;</span>
                        </div>
                        <div>
                            <span>Quantity</span>
                        </div>
                        <div class="text-right">
                            <span>Price</span>
                        </div>
                    </div>

                        <div class="clearfix">
                            @forelse($cartItems as $item) 
                                <div class="cart-block cart-block-item clearfix">
                                    <div class="image">
                                        <a href="product.html"><img src="{{ optional($item->product)->image_url ?? asset('frontend/assets/images/no-image.png') }}" alt="" /></a>
                                    </div>
                                    <div class="title">
                                        <div class="h4"><a href="product.html">{{ $item->product->name }}</a></div>
                                        {{-- <div>Electronics</div> --}}
                                    </div>
                                    <div class="quantity">
                                        <input type="number"   
                                        style="padding-left: 10px; text-align: left;"   
                                        wire:model="cartItems.{{ $loop->index }}.qty"   
                                        wire:change="updateCartItem('{{ $item->id }}', $event.target.value)"   
                                        class="form-control form-quantity"   
                                        step="1"   
                                        min="1"   
                                        oninput="this.value = Math.floor(this.value);" /> 
                                    </div>
                                    <div class="price">
                                        @if($item->selling_price)  
                                            @if($item->discount_persentage > 0)  
                                                <span class="final h3">Rp {{ number_format($item->nett_price, 0, ',', '.') }},-</span>    
                                                <span class="discount">Rp {{ number_format($item->selling_price, 0, ',', '.') }},-</span>    
                                            @else   
                                                <span style="final h3">Rp {{ number_format($item->selling_price, 0, ',', '.') }},-</span>    
                                            @endif   
                                        @else   
                                            <sub>-</sub>    
                                        @endif 

                                    </div>
                                    <!--delete-this-item-->
                                    <span class="icon icon-cross icon-delete" wire:click="removeCartItem('{{ $item->id }}')"></span>
                                </div>
                            @empty
                                no data
                            @endforelse
                        </div>

                </div>

                <!-- ========================  Cart navigation ======================== -->

                <div class="clearfix">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> Shop more</a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="/cart-checkout" class="btn btn-main"><span class="icon icon-cart"></span> Proceess to Checkout</a>
                        </div>
                    </div>
                </div>

            </div> <!--/container-->

        </section>
</div>