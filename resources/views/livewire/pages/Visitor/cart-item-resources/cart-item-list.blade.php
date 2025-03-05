<div>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">{{ $title }}</h2>
      
          <div class="mt-8 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
              <div class="space-y-6">
                @forelse($products as $item)
                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                    <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                        <a href="#" class="mx-auto">
                          <img src="{{ $item['image_url'] }}" class="w-32 " alt="product image" srcset="">
                        </a>
        
                        <label for="counter-input" class="sr-only">Choose quantity:</label>
                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                        <div class="flex items-center">
                            <button type="button" wire:click="decrement('{{ $item['products_id'] }}')" id="decrement-button" data-input-counter-decrement="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                              <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                              </svg>
                            </button>
                                {{-- <input type="number"   
                                  style="padding-left: 10px; text-align: left;"   
                                  wire:model="cartItems.{{ $loop->index }}.qty"   
                                  wire:change="updateCartItem('{{ $item['id'] }}', $event.target.value)"   
                                  class="form-control form-quantity"   
                                  step="1"   
                                  min="1"   
                                oninput="this.value = Math.floor(this.value);" />  --}}

                                <input type="number" value="{{ $item['amount'] }}" class="mx-2 w-16 text-center border border-gray-300 rounded-md" min="1" readonly>


                            <button type="button" wire:click="increment('{{ $item['products_id'] }}')" id="increment-button" data-input-counter-increment="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                              <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                              </svg>
                            </button>
                        </div>
                        <div class="text-end md:order-4 md:w-32">
                            <p class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($item['product_nett_price']*$item['amount'], 0, ',', '.') }}</p>
                        </div>
                        </div>
        
                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                        <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $item['products_name'] }}</a>
        
                          <div class="flex items-center gap-4">
                              <button type="button" wire:click="deleteCart('{{ $item['products_id'] }}')" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                              <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                              </svg>
                              Hapus
                              </button>
                          </div>
                        </div>
                    </div>
                    </div>
                @empty
                    no data
                @endforelse
             
              </div>
              <div class="hidden xl:mt-8 xl:block">
                <!-- Rekomendasi untuk Kamu -->
                <x-frontend.rekomendasi-produk :productrecoms="$productrecoms"/>
              </div>
            </div>
      
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
              <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                <p class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan Pesanan</p>
      
                <div class="space-y-4">
                  <div class="space-y-2">
                    <dl class="flex items-center justify-between gap-4">
                      <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Harga Pesanan</dt>
                      <dd class="text-base font-medium text-gray-900 dark:text-white">Rp  {{ number_format($this->calculateTotal(), 0, ',', '.') }}</dd>
                    </dl>
      
                    <dl class="flex items-center justify-between gap-4">
                      <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Pajak</dt>
                      <dd class="text-base font-medium text-gray-900 dark:text-white">11%</dd>
                    </dl>
                  </div>
      
                  <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                    @php 
                     $resultTax  = $this->calculateFinalTotal()*0.11
                    @endphp
                    <dd class="text-base font-bold text-gray-900 dark:text-white">Rp{{ number_format($this->calculateFinalTotal()-$resultTax, 0, ',', '.') }}</dd>
                  </dl>
                </div>
      
                <a href="#" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-dark hover:bg-primary-800 focus:outline-none bg-gradient-to-r from-cyan-500 to-blue-500 text-white focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 bordedr-lg shadow-lg">Proses Belanja</a>
      
                <div class="flex items-center justify-center gap-2">
                  <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> atau </span>
                  <a href="#" title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                    Lanjut Belanja
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                  </a>
                </div>
              </div>
      
              
            </div>
          </div>
        </div>
      </section>

</div>

