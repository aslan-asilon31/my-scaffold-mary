<div>

    <div class="container mx-auto px-4 mt-10 bg-gradient-to-r from-cyan-500 to-blue-500 m-8 p-4 rounded-lg border shadow-lg" data-aos="fade-left">
        <h2 class="text-sm md:text-xl text-outline font-bold mb-4 text-white underline">Brand</h2>
        <div class="flex flex-wrap justify-center">
                @forelse($brands as $brand)
                    <div class=" rounded-lg shadow-md p-4 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/4 mb-4">
                            <img src="{{ $brand->image_url ?? asset('backend-assets/no-image-900x900.png') }}" alt="{{ $brand->brand_name }}" class="object-cover rounded-lg mb-2">
                            <h3 class="text-sm font-semibold text-center">{{ $brand->brand_name }}</h3>
                    </div>
                @empty
                    <p class="text-gray-700">Tidak ada brand yang tersedia.</p>
                @endforelse
        </div>
    </div>
</div>
