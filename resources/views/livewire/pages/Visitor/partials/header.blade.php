<div>

    <style>
      header{
        z-index : 99999 !important;
      }
      .swiper {
        width: 100%;
        height: 100%;
      }

      .swiper-slide {
        text-align: center;
        font-size: 16px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
      }
  
      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

        /* Tambahkan gaya untuk header sticky */
    </style>

    <header class="relative z-99999! bg-blue-400 dark:bg-gray-900 border-t border-gray-500 dark:border-gray-700 ">
        <nav class="fixed top-0 right-0 left-0  bg-white  dark:bg-gray-800 antialiased dark:bg-gray-900 border-b border-gray-500 dark:border-gray-700">
          <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
            <div class="flex items-center justify-between">
        
              <div class="flex items-center space-x-8">
                <div class="shrink-0">
                  <a href="#" title="" class="">
                    <img class="block w-auto h-8 dark:hidden" src="{{ asset('frontend/assets/img/logo.png') }}" alt="">
                    
                  </a>
                </div>
        
                <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                  <li>
                    <a href="/" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                      Beranda
                    </a>
                  </li>
                  <li class="shrink-0">
                    <a href="produk/all" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                      Produk kami
                    </a>
                  </li>
                  <li class="shrink-0">
                    <a href="kontak" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                      Kontak
                    </a>
                  </li>
                  <li class="shrink-0">
                    <a href="tentang" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                      Tentang
                    </a>
                  </li>
                </ul>
              </div>
        
              <div class="flex items-center lg:space-x-2">
        
                <livewire:pages.visitor.cart-resources.cart-list   />
        
                <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1" aria-controls="ecommerce-navbar-menu-1" aria-expanded="false" class="inline-flex lg:hidden items-center justify-center hover:bg-gray-100 rounded-md dark:hover:bg-gray-700 p-2 text-gray-900 dark:text-white">
                  <span class="sr-only">
                    Open Menu
                  </span>
                  <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                  </svg>                
                </button>
              </div>
            </div>
        
            <div id="ecommerce-navbar-menu-1" class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 border border-gray-200 rounded-lg py-3 hidden px-4 mt-4">
              <ul class="text-gray-900 dark:text-white text-sm font-medium dark:text-white space-y-3">
                <li>
                  <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Beranda</a>
                </li>
                <li>
                  <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Produk Kami</a>
                </li>
                <li>
                  <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Gift Ideas</a>
                </li>
                <li>
                  <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Kontak</a>
                </li>
                <li>
                  <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Tentang</a>
                </li>
                
              </ul>
            </div>
          </div>
        </nav>
    </header>



    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 1,
          spaceBetween: 30,
          keyboard: {
            enabled: true,
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          autoplay: {
            delay: 3000, // Delay between transitions in milliseconds
            disableOnInteraction: false, // Keep autoplay running even after user interaction
          },
        });
    </script>
</div>
