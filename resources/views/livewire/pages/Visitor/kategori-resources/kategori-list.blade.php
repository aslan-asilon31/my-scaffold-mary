<div>
    <div class="mb-6">

        <div class="rounded-lg bg-gradient-to-r from-blue-500 to-blue-800 h-64 flex items-center justify-center">
            <h2 class="text-white text-2xl font-bold">Brand {{ $product_brand['name'] }}</h2>
        </div>
    </div>

    <!-- Row 2: Product Cards -->

    <div class="rounded-lg pt-8 pb-4 flex items-center justify-center">
        <h2 class="text-dark text-2xl font-bold">Kategori {{ $firstProduct[0]['name'] }}</h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 m-4">
        @forelse($product_category_first['product'] as $pcf)

            <a href="/produk-detail/{{$pcf['id']}}">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <img src="{{ $pcf['image_url'] ? $pcf['image_url'] : asset('backend-assets/no-image-900x900.png')}}" alt="Produk 1" class=" object-cover rounded-lg mb-2">
                    <p class="md:text-lg text-md md:font-semibold lg:font-semibold">{{ $pcf['name'] }}</p>

                    <div class="grid grid-cols-1">
                        @if($pcf['selling_price'] > 0)  
                            @if($pcf['discount_persentage'] > 0)  
                                <h3>Rp {{ number_format($pcf['nett_price'], 0, ',', '.') }},-</h3>    
                                <sub class="stroke"> <s>Rp {{ number_format($pcf['selling_price'], 0, ',', '.') }}</s> ,-</sub>    
                            @else   
                                <h3 style="text-decoration:none;">Rp {{ number_format($pcf['selling_price'], 0, ',', '.') }},-</h3>    
                            @endif   
                        @else   
                            <sub>-</sub>    
                        @endif 
                    </div>

                    @php  
                        $isInCart = $this->isProductInCart($pcf['id']);  
                    @endphp  

                    <br>
                    <div class=""     
                        wire:click="{{ $isInCart ? 'removeCartItem' : 'addToCart' }}('{{ $pcf['id'] }}', {{ $pcf['selling_price'] }}, {{ $pcf['weight'] }})">  
                        @if ($isInCart)    
                        <span class="bg-red-500 text-white  p-2 rounded-md">remove</span>    
                        @else    
                            <span class="bg-green-500 text-white  p-2 rounded-md">add</span>    
                        @endif    
                    </div>

                </div>
            </a>
            
            {{-- <div class="bg-white dark:bg-gray-700 rounded-lg flex items-center justify-center">
                <p class="text-center">
                    <img src="{{ asset('frontend/assets/img/product/prod1.png') }}" alt="" srcset="">
                </p>
            </div> --}}
        @empty 
        @endforelse

  
    </div>


    {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 m-4">
        @foreach ($remainingProducts as $remainingProduct)
            <div class="bg-white dark:bg-gray-700 rounded-lg flex items-center justify-center">
                <p class="text-center">
                    <img src="{{ $remainingProduct['image_url'] ? $remainingProduct['name'] : asset('frontend/assets/img/product/prod1.png') }}" alt="" srcset="">
                </p>
                <span>{{ $remainingProduct['name'] }}</span>
            </div>
        @endforeach
    </div> --}}


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
</div>
