<div>


    <div class="container  mx-auto px-4 mt-10 bg-gradient-to-r from-cyan-500 to-blue-500 m-8 p-4 rounded-lg border shadow-lg" data-aos="fade-left">
        <h2 class="text-sm md:text-xl text-outline font-bold mb-4 text-white underline">Produk Terlaris</h2>

        <div class="flex flex-wrap justify-center"> <!-- Menggunakan justify-center untuk memusatkan card -->
            @forelse ($products5->take(7) as $product5)
                @php  
                    $isInCart[] = $this->isProductInCart($product5->products_id);  
                @endphp 

                <div class=" rounded-lg shadow-md p-4 w-1/2 md:w-1/2 lg:w-1/4 mb-4"> <!-- Menggunakan w-1/2 untuk mobile -->
                    <img src="{{ $product5->image_url ?? asset('backend-assets/no-image-900x900.png') }}" alt="Produk" class="object-cover rounded-lg mb-2">
                    <h3 class="font-semibold text-sm md:text-md">{{ $product5->title }}</h3>
                    <div class="grid grid-cols-1 mb-4">
                        @if($product5->product_selling_price > 0)  
                            @if($product5->product_discount_persentage > 0)  
                                <h3>Rp {{ number_format($product5->product_nett_price, 0, ',', '.') }},-</h3>    
                                <sub class="stroke"> <s>Rp {{ number_format($product5->product_selling_price, 0, ',', '.') }}</s> ,-</sub>    
                            @else   
                                <h3 style="text-decoration:none;">Rp {{ number_format($product5->product_selling_price, 0, ',', '.') }},-</h3>    
                            @endif   
                        @else   
                            <sub>-</sub>    
                        @endif 
                    </div>

                    @if($isInCart)
                        <form wire:submit.prevent="storeCart">
                            <input type="hidden" wire:model="{{ $product5->products_id }}" > <!-- Pastikan ini terisi dengan ID produk yang benar -->
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add to Cart</button>
                        </form>

                        <a href="#"
                        wire:click.prevent="storeCreate('{{  $product5->products_id }}'); storeCart()" 
                        class="bg-yellow-500 text-white rounded px-4 py-2">
                        <i class="fa-solid fa-cart-shopping"></i>
                        </a>


                        <a href="#"
                            wire:click.prevent="storeCart({{  $product5->products_id }})" 
                            class="bg-green-500  text-white rounded px-4 py-2">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    @else 
                        <button 
                            wire:click="removeFromCart({{  $product5->products_id }})" 
                            class="bg-red-500  text-white rounded px-4 py-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    @endif

                </div>

            @empty
                <p class="text-white">Tidak ada produk tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
