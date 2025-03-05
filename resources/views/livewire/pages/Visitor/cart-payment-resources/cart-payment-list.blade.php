<div>
    

        <!-- ========================  Main header ======================== -->

        <section class="main-header" style="background-image:url(assets/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title">{{ $title }}</h2>
                    <ol class="breadcrumb breadcrumb-inverted">
                        <li><a href="index.html"><span class="icon icon-home"></span></a></li>
                        <li><a href="checkout-1.html">Cart items</a></li>
                        <li><a href="checkout-2.html">Delivery</a></li>
                        <li><a class="active" href="checkout-3.html">Payment</a></li>
                        <li><a href="checkout-4.html">Receipt</a></li>
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
                            <span data-text="Checkout"></span>
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
                    <h3 class="h3 title">Checkout - Step 3</h3>
                </header>

                <!-- ========================  Cart navigation ======================== -->

                <div class="clearfix">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="checkout-2.html" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> Back to delivery</a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="checkout-4.html" class="btn btn-main"><span class="icon icon-cart"></span> Checkout</a>
                        </div>
                    </div>
                </div>

                <!-- ========================  Payment ======================== -->

                <div class="cart-wrapper">

                    <div class="note-block">

                        <div class="row">
                            <!-- === left content === -->

                            <div class="col-md-6">

                                <div class="white-block">

                                    <div class="h4">Order details</div>

                                    <hr />

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Order no.</strong> <br />
                                                <span>52522-63259226</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Transaction ID</strong> <br />
                                                <span>2265996</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Order date</strong> <br />
                                                <span>06/30/2017</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Shipping arrival</strong> <br />
                                                <span>07/30/2017</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="h4">Shipping info</div>

                                    <hr />

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Name</strong> <br />
                                                <span>John Doe</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Email</strong><br />
                                                <span>johndoe@company.com</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Phone</strong><br />
                                                <span>+122 523 352</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Zip</strong><br />
                                                <span>94107</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>City</strong><br />
                                                <span>San Francisco, California</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Address</strong><br />
                                                <span>795 Folsom Ave, Suite 600</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Company name</strong><br />
                                                <span>Mobel Inc</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Company phone</strong><br />
                                                <span>+122 333 6665</span>
                                            </div>
                                        </div>


                                    </div>

                                </div> <!--/col-md-6-->

                            </div>

                            <!-- === right content === -->

                            <div class="col-md-6">
                                <div class="white-block">

                                    <div class="h4">Choose payment</div>

                                    <hr />

                                    <span class="checkbox">
                                        <input type="radio" id="paymentID1" name="paymentOption" checked="checked">
                                        <label for="paymentID1">
                                            <strong>Pay via credit cart</strong> <br />
                                            <small>(MasterCard, Maestro, Visa, Visa Electron, JCB and American Express)</small>
                                        </label>
                                    </span>

                                    <span class="checkbox">
                                        <input type="radio" id="paymentID2" name="paymentOption">
                                        <label for="paymentID2">
                                            <strong>PayPal</strong> <br />
                                            <small>Purchase with your fingertips. Look for us the next time you're paying from a mobile app, and checkout faster on thousands of mobile websites.</small>
                                        </label>
                                    </span>

                                    <span class="checkbox">
                                        <input type="radio" id="paymentID3" name="paymentOption">
                                        <label for="paymentID3">
                                            <strong>Pay via bank transfer</strong> <br />
                                            <small>You can make payments directly into our bank account and email the bank wire transfer receipt to us. We recommend bank wire transfer for payments exceeding $500,00. </small>
                                        </label>
                                    </span>

                                    <hr />

                                    <p>Please allow three working days for the payment confirmation to reflect in your <a href="#">online account</a>. Once your payment is confirmed, we will generate your e-invoice, which you can view/print from your account or email.</p>
                                </div>
                            </div>
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
                            <span>Price</span>
                        </div>
                    </div>

                    <!--cart items-->

                    <div class="clearfix">
                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="product.html"><img src="assets/images/product-7.png" alt="" /></a>
                            </div>
                            <div class="title">
                                <div class="h4"><a href="product.html">Coffee machine</a></div>
                                <div>Electronics</div>
                            </div>
                            <div class="quantity">
                                <strong>2</strong>
                            </div>
                            <div class="price">
                                <span class="final h3">$ 150,00</span>
                                <span class="discount">$ 190,00</span>
                            </div>
                        </div>

                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="product.html"><img src="assets/images/product-8.png" alt="" /></a>
                            </div>
                            <div class="title">
                                <div class="h4"><a href="product.html">Iron set</a></div>
                                <div>Home accessories</div>
                            </div>
                            <div class="quantity">
                                <strong>2</strong>
                            </div>
                            <div class="price">
                                <span class="final h3">$ 390,00</span>
                                <span class="discount">$ 490,00</span>
                            </div>
                        </div>

                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="product.html"><img src="assets/images/product-10.png" alt="" /></a>
                            </div>
                            <div class="title">
                                <div class="h4"><a href="product.html">Wireless Headphones</a></div>
                                <div>Green corner</div>
                            </div>
                            <div class="quantity">
                                <strong>1</strong>
                            </div>
                            <div class="price">
                                <span class="final h3">$ 180,00</span>
                                <span class="discount">$ 200,00</span>
                            </div>
                        </div>

                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="product.html"><img src="assets/images/product-12.png" alt="" /></a>
                            </div>
                            <div class="title">
                                <div class="h4"><a href="product.html">E-shaver 500</a></div>
                                <div>Electronics</div>
                            </div>
                            <div class="quantity">
                                <strong>1</strong>
                            </div>
                            <div class="price">
                                <span class="final h3">$ 199,00</span>
                                <span class="discount">$ 149,00</span>
                            </div>
                        </div>
                    </div>

                    <!--cart prices -->

                    <div class="clearfix">
                        <div class="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>Discount 15%</strong>
                            </div>
                            <div>
                                <span>$ 159,00</span>
                            </div>
                        </div>

                        <div class="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>Shipping</strong>
                            </div>
                            <div>
                                <span>$ 30,00</span>
                            </div>
                        </div>

                        <div class="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>VAT</strong>
                            </div>
                            <div>
                                <span>$ 59,00</span>
                            </div>
                        </div>
                    </div>

                    <!--cart final price -->

                    <div class="clearfix">
                        <div class="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>Promo code included!</strong>
                            </div>
                            <div>
                                <div class="h2 title">$ 1259,00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================  Cart navigation ======================== -->

                <div class="clearfix">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="checkout-2.html" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> Back to delivery</a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="/cart-receipt" class="btn btn-main"><span class="icon icon-cart"></span> Checkout</a>
                        </div>
                    </div>
                </div>


            </div> <!--/container-->

        </section>

</div>