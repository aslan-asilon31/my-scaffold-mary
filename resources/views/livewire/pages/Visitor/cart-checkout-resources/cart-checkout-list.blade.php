<div>
            <!-- ========================  Main header ======================== -->

            <section class="main-header" style="background-image:url(assets/images/gallery-2.jpg)">
                <header>
                    <div class="container text-center">
                        <h2 class="h2 title">{{ $title }}</h2>
                        <ol class="breadcrumb breadcrumb-inverted">
                            <li><a href="index.html"><span class="icon icon-home"></span></a></li>
                            <li><a href="checkout-1.html">Cart items</a></li>
                            <li><a class="active" href="checkout-2.html">Checkout</a></li>
                            <li><a href="checkout-4.html">Invoice</a></li>
                        </ol>
                    </div>
                </header>
            </section>
    
            <!-- ========================  Step wrapper ======================== -->
    
            <div class="step-wrapper">
                <div class="container">
    
                    <div class="stepper">
                        <ul class="row">
                            <li class="col-md-4 active">
                                <span data-text="Cart items"></span>
                            </li>
                            <li class="col-md-4 active">
                                <span data-text="Receipt"></span>
                            </li>
                           
                            <li class="col-md-4">
                                <span data-text="Invoice"></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <!-- ========================  Checkout ======================== -->
    
            <section class="checkout">
                <div class="container">
    
                    <header class="hidden">
                        <h3 class="h3 title">Checkout - Step 2</h3>
                    </header>
    
                    <!-- ========================  Cart navigation ======================== -->
    
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="checkout-1.html" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> Back to cart</a>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="checkout-3.html" class="btn btn-main"><span class="icon icon-cart"></span> Go to payment</a>
                            </div>
                        </div>
                    </div>
    
                    <!-- ========================  Delivery ======================== -->
    
                    <div class="cart-wrapper">
    
                        <div class="note-block">
                            <div class="col-md-12">

                                <!-- === login-wrapper === -->

                                <div class="login-wrapper">

                                    <div class="white-block">

                                        <!--signin-->

                                        <div class="login-block login-block-signin">

                                            <div class="h4">Sign in <a href="javascript:void(0);" class="btn btn-main btn-xs btn-register pull-right">create an account</a></div>

                                            <hr />

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" value="" class="form-control" placeholder="User ID">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="password" value="" class="form-control" placeholder="Password">
                                                    </div>
                                                </div>

                                                <div class="col-xs-6">
                                                    <span class="checkbox">
                                                        <input type="checkbox" id="checkBoxId3">
                                                        <label for="checkBoxId3">Remember me</label>
                                                    </span>
                                                </div>

                                                <div class="col-xs-6 text-right">
                                                    <a href="#" class="btn btn-main">Login</a>
                                                </div>
                                            </div>
                                        </div> <!--/signin-->
                                        <!--signup-->

                                        @livewire('pages.visitor.cart-checkout-resources.cart-checkout-crud')

                                    </div>
                                </div> <!--/login-wrapper-->
                            </div> 

                        </div>
                    </div>
    
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
                                <span>Net Price</span>
                            </div>
                        </div>
    
                        <!--cart items-->
    
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
    
                        <!--cart prices -->
    
                     
    
                        <!--cart final price -->
    
                        <div class="clearfix">
                            <div class="cart-block cart-block-footer clearfix">
                                <div>
                                </div>
                                <div>
                                    <div class="h2 title">Rp {{ number_format($this->calculateFinalTotal(), 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- ========================  Cart navigation ======================== -->
    
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="checkout-1.html" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> Back to cart</a>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="/cart-invoice" class="btn btn-main"><span class="icon icon-cart"></span> Make Invoice</a>
                            </div>
                        </div>
                    </div>
    
    
                </div> <!--/container-->
    
            </section>
</div>