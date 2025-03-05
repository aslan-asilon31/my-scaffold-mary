<div class="navigation navigation-main">
    <a href="#" class="open-login"><i class="icon icon-user"></i></a>
    <a href="#" class="open-search"><i class="icon icon-magnifier"></i></a>
    <a href="#" class="open-cart"><i class="icon icon-cart"></i> <span>4</span></a>
    <a href="#" class="open-menu"><i class="icon icon-menu"></i></a>
    <div class="floating-menu">
        <!--mobile toggle menu trigger-->
        <div class="close-menu-wrapper">
            <span class="close-menu"><i class="icon icon-cross"></i></span>
        </div>
        <ul>
            <li><a href="/">Beranda</a></li>

            <li>
                <a href="/kategori">Kategori <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                <div class="navbar-dropdown">
                    <div class="navbar-box">
                        <div class="box-full">
                            <div class="box clearfix">
                                <div class="row">
                                    <div class="clearfix">
                                        @forelse($productCategoryFirsts as $productCategoryFirst)
                                            <div class="col-lg-3">
                                                <ul>
                                                    <li class="label"><i class="icon icon-star"></i> {{ $productCategoryFirst->name }}</li>
                                                    @forelse($productCategoryFirst->product->take(3) as $product) <!-- Ambil maksimal 3 produk -->  
                                                    <li><a class="hover:underline" href="#">{{ $product->name }}</a></li>  
                                                    @empty  
                                                        <li>Tidak ada produk tersedia.</li>  
                                                    @endforelse  
                                        
                                                    @if($productCategoryFirst->product->count() > 3) <!-- Cek jika ada lebih dari 3 produk -->  
                                                        <li><a href="#" class="more underline">More</a></li>  
                                                    @endif 
                                                </ul>
                                            </div>
                                        @empty
                                            no data
                                        @endforelse
                                     
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            
            <li><a href="/produk">Produk</a></li>
            
            <li><a href="/kontak">Kontak</a></li>

            <li><a href="/tentang">Tentang</a></li>


        </ul>
    </div>
</div>