<div>


    <div class="container mx-auto px-4 mt-10 bg-gradient-to-r from-cyan-500 to-blue-500  m-8 p-4 rounded-lg border shadow-lg">
            <h2 class="text-sm md:text-xl text-outline font-bold mb-4  underline text-outline">Kategori Produk</h2>
            <div class="flex flex-wrap justify-center" data-aos="fade-up">

                    @forelse ($categories as $category)
                        <div class=" rounded-lg shadow-md p-4 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/4 mb-4"> <!-- Mengatur lebar card -->

                            <div wire:key="{{ $category->id }}" > 
                                <a href="/kategori/detail/{{ $category->id }}" class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <svg class="me-2 h-4 w-4 shrink-0 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M10 12v1h4v-1m4 7H6a1 1 0 0 1-1-1V9h14v9a1 1 0 0 1-1 1ZM4 5h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
                                </svg>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->name }}</span>
                                </a>
                            </div>
                        </div>
                    @empty
                    @endforelse
            </div>

    </div>
</div>