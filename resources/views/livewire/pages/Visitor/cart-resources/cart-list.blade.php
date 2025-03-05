<div>


    <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
        <span class="sr-only">
        Cart
        </span>
        <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
        </svg> 
            <span class="hidden sm:flex">My Cart <p class="bg-blue-600 rounded text-xs ml-2 p-1 text-white"> {{ count($cartItems) }} </p> </span>
        <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
        </svg>              
    </button>
    <div id="myCartDropdown1" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
        @if ($cartItemRes)

                @forelse(array_slice($cartItemRes, 0, 3) as $item)
                    <div class="grid grid-cols-2">   
                        <div>
                            <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">{{ $item['products_name'] }}</a>
                        </div>
                        <br>
                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">
                                <input type="number"   
                                style="padding-left: 10px; text-align: left;"   
                                wire:model="cartItemRes.{{ $loop->index }}.qty"   
                                wire:change="updateCartItem('{{ $item['id'] }}', $event.target.value)"   
                                class="form-control form-quantity"   
                                step="1"   
                                min="1"   
                                oninput="this.value = Math.floor(this.value);" />
                            </p>
                    
                            <button data-tooltip-target="tooltipRemoveItem1a" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                            <span class="sr-only" wire:click="removeCartItem('{{ $item['id'] }}')"> Remove </span>
                            <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                            </svg>
                            </button>
                            <div id="tooltipRemoveItem1a"   role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                Remove item
                            <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>

                        <div class="clearfix">  
                        <div class="cart-block cart-block-footer clearfix ">  
                            <div>  
                                <strong>Total</strong>  
                            </div>  
                            <div>  
                                <div class="h4 title">Rp {{ number_format($this->calculateFinalTotal(), 0, ',', '.') }}</div>  
                            </div>  
                        </div>  
                        </div> 

                        <a  href="/cart-item" title="" type="button" class="mb-2 border-spacing-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-stone-950 hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-stone-900" role="button"> Lihat Item </a>

                    </div>

                @empty 

                    keranjang masih kosong

                    <hr />  

                    <!--cart final price -->  
                    <div class="clearfix">  
                        <div class="cart-block cart-block-footer clearfix">  
                            <div>  
                                <strong>Total</strong>  
                            </div>  
                            <div>  
                                <div class="h4 title">Rp 0</div>  
                            </div>  
                        </div>  
                    </div> 

                    <a href="/cart-item" type="button" title="" class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-stone-950 hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-spacing-2  border-stone-900" role="button"> lihat item </a>


                @endforelse


                @php
                    $itemCount = count($cartItemRes);
                @endphp 

                @if ($itemCount > 3)
                    <div class="clearfix">  
                        <div class="cart-block cart-block-footer clearfix ">  
                            <div>  
                                <strong>Total</strong>  
                            </div>  
                            <div>  
                                <div class="h4 title">Rp {{ number_format($this->calculateFinalTotal(), 0, ',', '.') }}</div>  
                            </div>  
                        </div>  
                    </div> 

                    <a href="/cart-item" title="" type="button" class="mb-2 border-spacing-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-stone-950 hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-stone-900" role="button">
                        Lihat Semua Item
                    </a>
                @endif

        @else 
            keranjang masih kosong

            <hr />  

            <!--cart final price -->  
            <div class="clearfix">  
                <div class="cart-block cart-block-footer clearfix">  
                    <div>  
                        <strong>Total</strong>  
                    </div>  
                    <div>  
                        <div class="h4 title">Rp 0</div>  
                    </div>  
                </div>  
            </div> 

        @endif


    </div>
</div>