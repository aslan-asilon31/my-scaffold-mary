<div>
    <section class="main-header text-center" style="background-image:url(assets/images/gallery-1.jpg)">
        <header>
            <div class="container">
                @if(!empty($productBrandCounts))
                    <h1 class="h2 title font-extrabold">All Brand</h1>
                    <ol class="breadcrumb breadcrumb-inverted">
                        <li><a href="#"><span class="icon icon-home"></span></a></li>
                        <li class="active">brand / All Brand</li>
                    </ol>
                @else
                    <h1 class="h2 title font-extrabold">Brand {{ $this->product_brands->name }}</h1>
                    <ol class="breadcrumb breadcrumb-inverted">
                        <li><a href="#"><span class="icon icon-home"></span></a></li>
                        <li class="active">brand / {{ $this->product_brands->name }}</li>
                    </ol>
                @endif
            </div>
        </header>
    </section>

    <!-- ================== Shorcodes ================== -->

    <section class="shortcodes">
        <div class="container">

            <div class="row">

                <div class="col-md-3 visible-md visible-lg">
                    <div data-spy="affix" data-offset-top="280">
                        <ul class="list-group">
                            <li class="list-group-item" style="font-weight:bolder;"><a href="#carousel ">Kategori</a></li>
                        @php
                            $displayedCategories = [];  
                        @endphp
                        
                        @if(!empty($productBrandCounts))
                            @foreach($product_brands as $brand) 
                                @foreach($brand->products as $product) 
                                    @if($product->productCategoryFirst && !in_array($product->productCategoryFirst->name, $displayedCategories))
                                        <li class="list-group-item">
                                            {{ $product->productCategoryFirst->name }} <!-- Akses name dari productCategoryFirst -->
                                        </li>
                                        @php
                                            $displayedCategories[] = $product->productCategoryFirst->name; // Tambahkan kategori yang sudah ditampilkan
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            {{ $product_brands->name }}
                        @endif

                        @if(!empty($productBrandCounts))
                            <li class="list-group-item">
                            </li>
                        @else
                            {{ $product_brands->name }}
                        @endif
                        



                        </ul>
                    </div>
                </div>

                <div class="col-md-9">

                    <!--======= product list -->

                    <div class="panel panel-default" id="carousel-icons">
                        <div class="panel-heading font-extrabold pt-8 mt-8 pb-4">Daftar Produk</div>
                        <div class="panel-body">

                            <div class="owl-icons-wrapper">

                                <!-- === header === -->

                                <header class="hidden">
                                    <h2>Product categories</h2>
                                </header>

                                    <div class="grid grid-cols-2 md:grid-cols-4  sm:grid-cols-2 m-4  gap-4">

                                        @if($this->product_brands)
                                            @forelse($this->product_brands->products as $product)

                                                <div class="shadow-lg">
                                                    <a href="{{ route('produk-detail', $product->id) }}" class="">
                                                        <figure>
                                                            <img src="{{ $product->image_url  }}" alt="{{ $product->name }} image" />
                                                            <figcaption>{{ $product->name }}</figcaption>
                                                        </figure>
                                                        <h5>{{ $product->name }}  </h5>
                                                    </a>
                                                </div>

                                            @empty
                                                tidak ada produk
                                            @endforelse
                                        @endif

                                    </div>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>

    </section>
</div>
