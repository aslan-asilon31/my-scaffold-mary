<div>
            <!-- ======================== Main header ======================== -->

            <section class="main-header">
            <header>
                <div class="container">
                    <h1 class="h2 title">{{ $title }}</h1>
                </div>
            </header>
        </section>

        <!-- ======================== Products ======================== -->

        <section class="products">
            <header class="hidden">
                <h3 class="h3 title">Product category grid</h3>
            </header>

            <div class="row row-clean">

                <!-- === product-filters === -->

                <x-produk.produk-filter :brands="$brands"/>


                <!--product items-->

                <div class="col-md-9 col-xs-12">

                    <div class="row row-clean">

                    <!-- === product-item === -->
                    @forelse ($products as $product)
                        <div class="col-xs-6 col-sm-4 col-lg-3">
                            <article>
                                <div class="info">
                                    
                                    <span>
                                
                                        {{-- <a href="#productid1"   class="mfp-open" data-title="Quick view"><i class="icon icon-eye"></i></a> --}}
                                    </span>
                                </div>
                                <div class="">
                                    <i class="icon icon-cart"></i>
                                </div>
                                <div class="figure-grid">
                                    <div class="image">
                                        <a href="#productid1" class="mfp-open">
                                            <img src="{{ asset('frontend/assets/images/no-image.png') }}" alt="" width="360" />
                                        </a>
                                    </div>
                                    <div class="text">
                                        <h2 class="title h4">
                                            <a href="product.html">{{ $product->products_name }}</a>
                                        </h2>
                                        <sub>Rp{{ $product->product_selling_price }},-</sub>
                                        <sup>Rp{{ $product->product_nett_price }},-</sup> <br>
                                        <span class="mb-4 pb-4">{{ $product->product_brand_name }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @empty
                        tidak ada data
                    @endforelse

                    </div><!--/row-->
                    <!--Pagination-->
                    <div class="pagination-wrapper">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div> <!--/product items-->

            </div><!--/row-->

            <!-- ========================  Product info popup - quick view ======================== -->

            <div class="popup-main mfp-hide" id="productid1">

                <!-- === product popup === -->

                <div class="product">

                    <!-- === popup-title === -->

                    <div class="popup-title">
                        <div class="h1 title">
                            
                        {{ $product->title ?? 'Product Title' }}
                            <small>product category</small>
                        </div>
                    </div>

                    <!-- === product gallery === -->

                    <div class="owl-product-gallery">
                        <img src="assets/images/product-10.png" alt="" width="640" />
                        <img src="assets/images/product-10a.png" alt="" width="640" />
                    </div>

                    <!-- === product-popup-info === -->

                    <div class="popup-content">
                        <div class="product-info-wrapper">
                            <div class="row">

                                <!-- === left-column === -->

                                <div class="col-sm-6">
                                    <div class="info-box">
                                        <strong>Maifacturer</strong>
                                        <span>Brand name</span>
                                    </div>
                                    <div class="info-box">
                                        <strong>Materials</strong>
                                        <span>Wood, Leather, Acrylic</span>
                                    </div>
                                    <div class="info-box">
                                        <strong>Availability</strong>
                                        <span><i class="fa fa-check-square-o"></i> in stock</span>
                                    </div>
                                </div>

                                <!-- === right-column === -->

                                <div class="col-sm-6">
                                    <div class="info-box">
                                        <strong>Available Colors</strong>
                                        <div class="product-colors clearfix">
                                            <span class="color-btn color-btn-red"></span>
                                            <span class="color-btn color-btn-blue checked"></span>
                                            <span class="color-btn color-btn-green"></span>
                                            <span class="color-btn color-btn-gray"></span>
                                            <span class="color-btn color-btn-biege"></span>
                                        </div>
                                    </div>
                                    <div class="info-box">
                                        <strong>Choose size</strong>
                                        <div class="product-colors clearfix">
                                            <span class="color-btn color-btn-biege">S</span>
                                            <span class="color-btn color-btn-biege checked">M</span>
                                            <span class="color-btn color-btn-biege">XL</span>
                                            <span class="color-btn color-btn-biege">XXL</span>
                                        </div>
                                    </div>
                                </div>

                            </div> <!--/row-->
                        </div> <!--/product-info-wrapper-->
                    </div> <!--/popup-content-->
                    <!-- === product-popup-footer === -->
                   
                    <div class="popup-table">
                        <div class="popup-cell">
                            <div class="price">
                                <span class="h3">Rp {{ $product->product_nett_price  ?? 0 }} <small>Rp {{ $product->product_selling_price  ?? 0 }}</small></span>
                            </div>
                        </div>
                        <div class="popup-cell">
                            <div class="popup-buttons">
                                <a href="product.html"><span class="icon icon-eye"></span> <span class="hidden-xs">View more</span></a>
                                <a href="javascript:void(0);"><span class="icon icon-cart"></span> <span class="hidden-xs">Buy</span></a>
                            </div>
                        </div>
                    </div>

                </div> <!--/product-->
            </div> <!--popup-main--> <!--/container-->

        </section>



        <div class="rounded-lg pt-8 pb-4 flex items-center justify-center">
            <h2 class="text-dark text-2xl font-bold">Rekomendasi produk lain </h2>
        </div>
    
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 m-4">
            <div class="bg-white dark:bg-gray-700 rounded-lg flex items-center justify-center">
                <p class="text-center">
                    <img src="{{ asset('frontend/assets/img/product/prod1.png') }}" alt="" srcset="">
                </p>
            </div>
            <div class="bg-white dark:bg-gray-700 rounded-lg flex items-center justify-center">
                <p class="text-center">
                    <img src="{{ asset('frontend/assets/img/product/prod1.png') }}" alt="" srcset="">
                </p>
            </div>
            <div class="bg-white dark:bg-gray-700 rounded-lg flex items-center justify-center">
                <p class="text-center">
                    <img src="{{ asset('frontend/assets/img/product/prod1.png') }}" alt="" srcset="">
                </p>
            </div>
            <div class="bg-white dark:bg-gray-700 rounded-lg flex items-center justify-center">
                <p class="text-center">
                    <img src="{{ asset('frontend/assets/img/product/prod1.png') }}" alt="" srcset="">
                </p>
            </div>
            <div class="bg-white dark:bg-gray-700 rounded-lg flex items-center justify-center">
                <p class="text-center">
                    <img src="{{ asset('frontend/assets/img/product/prod1.png') }}" alt="" srcset="">
                </p>
            </div>
        </div>
        

        @script


        <script>  
            document.addEventListener('livewire:load', function () {  
         
            });  
        </script>

        @endscript



</div>