        <div class="container mx-auto px-4 mt-10 bg-gradient-to-r text-center from-cyan-500 to-blue-500  m-8 p-4 rounded-lg border shadow-lg">
            <h2 class="text-sm md:text-xl text-outline font-bold mb-4  text-white underline "></h2>
            <div class="flex flex-wrap justify-center">

                @forelse ($marketplaces as $marketplace)
                    <div class=" rounded-lg shadow-md p-4 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/4 mb-4">
                        <img src="{{ $marketplace->image_url ?? asset('backend-assets/no-image-900x900.png')}}" alt="Rekomendasi 1" class=" object-cover rounded-lg mb-2">
                    </div>
                @empty
                    tidak ada data
                @endforelse
                    
            </div>

        </div>