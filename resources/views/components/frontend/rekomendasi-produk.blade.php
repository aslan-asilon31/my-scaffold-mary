<div>
    <div class="container mx-auto px-4 mt-10 bg-gradient-to-r from-cyan-500 to-blue-500 m-8 p-4 rounded-lg border shadow-lg">
        <h2 class="text-sm md:text-xl text-outline font-bold mb-4 text-white underline">Rekomendasi untuk Anda</h2>
        <div class="flex flex-wrap justify-center  "> 
            @forelse ($productrecoms->take(7) as $productrecom)
                <div class=" rounded-lg shadow-md p-4 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/4 mb-4"> <!-- Mengatur lebar card -->
                    <div class="">
                        <img src="{{ $productrecom->image_url ?? asset('backend-assets/no-image-900x900.png') }}" alt="Rekomendasi" class="object-cover rounded-lg mb-2">
                        <h3 class="font-semibold text-sm md:text-md">{{ $productrecom->products_name }}</h3>
                        <p class="text-gray-600">Rp {{ $productrecom->product_nett_price }}</p>
                    </div>
                </div>
            @empty
                <p class="text-white">Tidak ada produk yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
