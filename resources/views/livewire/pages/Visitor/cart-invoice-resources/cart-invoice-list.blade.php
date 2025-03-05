<div>
    

        <!-- ========================  Main header ======================== -->

        <section class="main-header" style="background-image:url({{ asset('frontend/assets/images/gallery-2.jpg') }})">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title">{{ $title }}</h2>
                    <ol class="breadcrumb breadcrumb-inverted">
                        <li><a href="index.html"><span class="icon icon-home"></span></a></li>
                        <li><a href="checkout-1.html">Cart List</a></li>
                        <li><a href="checkout-3.html">Payment</a></li>
                        <li><a class="active" href="checkout-4.html">Invoice</a></li>
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
                            <span data-text="Cart List"></span>
                        </li>
                        <li class="col-md-4 active">
                            <span data-text="Checkout"></span>
                        </li>
                       
                        <li class="col-md-4 active">
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
                    <h3 class="h3 title">Checkout - Step 4</h3>
                </header>

                <!-- ========================  Cart navigation ======================== -->

                <div class="clearfix">
                    <div class="row">
                        <div class="col-xs-6">

                     
                    </div>
                </div>

                <!-- ========================  Payment ======================== -->

                <div class="cart-wrapper">


                    <div class="note-block">
                        @if($latestSalesOrder)
                            <div class="row">

                                <!-- === right content === -->

                                <div class="col-md-6">
                                    <div class="white-block">

                                        <div class="h4">Order details</div>

                                        <hr />

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Order no.</strong> <br />
                                                    <span>{{ $latestSalesOrder['number'] }}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Order date</strong> <br />
                                                    {{-- <span>{{ $latestSalesOrder->created_at->format('d/F/Y') }}</span> --}}
                                                    {{-- <span>{{ \Carbon\Carbon::parse($latestSalesOrder['created_at'])->format('d/F/Y') }}</span> --}}

                                                    <span>{{ $latestSalesOrder['created_at'] }}</span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="h4">Payment details</div>

                                        <hr />

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Transaction time</strong> <br />
                                                    {{-- <span>{{ $latestSalesOrder->salesInvoice->salesPayment->date }}</span> --}}
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Amount</strong><br />
                                                    <span> {{ $latestSalesOrder['salesOrderDetail']['amount'] ?? '-' }}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Items in cart</strong><br />
                                                    <span>{{ count($cartItems)  }}</span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="white-block">

                                        <div class="h4">Nomor Rekening</div>

                                        <hr />

                                        <div class="row">
                                            <div class="flex justify-center items-center">
                                                <div class="space-y-16">
                                                    <div  class="w-96 h-56 m-auto bg-red-100 rounded-xl relative text-white shadow-md transition-transform transform hover:scale-105 hover:shadow-2xl">
                                                    
                                                        <img class="relative object-cover w-full h-full rounded-xl" src="https://i.imgur.com/kGkSg1v.png">
                                                        
                                                        <div class="w-full px-8 absolute top-8">
                                                            <div class="flex justify-between">
                                                                <div class="">
                                                                    <h2 class="font-light">
                                                                        Nomor Rekening KBN
                                                                    </h2>
                                                                  
                                                                </div>
                                                                {{-- <img class="w-14" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1000px-Mastercard-logo.svg.png"/> --}}
                                                            </div>
                                                            <div class="pt-1">
                                                              
                                                                <div style="display: flex; align-items: center;">
                                                                    <h1 class="font-medium tracking-more-wider font-mono" id="copyText">
                                                                        <strong>4642</strong> 3489 9867
                                                                    </h1    >
                                                                    <span class="icon icon-copy" onclick="copyToClipboard()" style="cursor: pointer; margin-left: 10px;">
                                                                    </span>

                                                                </div>
                                                                
                                                                <script>
                                                                    function copyToClipboard() {
                                                                        // Ambil teks dari elemen dengan id "copyText"
                                                                        const textToCopy = document.getElementById("copyText").innerText;
                                                                
                                                                        // Buat elemen textarea untuk menyalin teks
                                                                        const textarea = document.createElement("textarea");
                                                                        textarea.value = textToCopy;
                                                                        document.body.appendChild(textarea);
                                                                        textarea.select();
                                                                        document.execCommand("copy");
                                                                        document.body.removeChild(textarea);
                                                                
                                                                        // Opsional: Tampilkan pesan bahwa teks telah disalin
                                                                        alert("Teks telah disalin: " + textToCopy);
                                                                    }
                                                                </script>
                                                                
                                                                
                                                            </div>
                                                    
                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="h4">Data User</div>

                                        <hr />

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Name</strong> <br />
                                                    <span>{{ $latestSalesOrder['customer']['first_name'] }} {{ $latestSalesOrder['customer']['last_name'] }}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Address</strong><br />
                                                    <span> {{ $latestSalesOrder['sales_shipping']['address'] ?? '-' }}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <strong>Items in cart</strong><br />
                                                    <span>{{ count($cartItems)  }}</span>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        @endif
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
                            <span>Price</span>
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
                                    <span style="padding-left: 10px; text-align: left;" class="form-control form-quantity">  
                                        {{ $item->qty }}  
                                    </span>  
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
                                <strong>Total</strong>  
                            </div>
                            <div>
                                <div class="h4 title">Rp {{ number_format($this->calculateFinalTotal(), 0, ',', '.') }}</div>  
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================  Cart navigation ======================== -->

                <div class="clearfix">
                    <div class="row">
                        <div class="col-xs-6 ">
                        </div>
                        <div class="col-xs-6 text-right "> 
                            <a style="  margin-bottom:16px;padding-bottom:16px;" class="btn btn-main " onclick="window.print()" ><span class="icon icon-printer"></span> Print </a>
                        </div>
                    </div>
                </div>
            </div> <!--/container-->

        </section>



</div>