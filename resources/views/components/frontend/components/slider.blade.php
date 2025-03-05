<div>


  <style>

    .swiper {
      width: 100%;
      height: 100%;
      z-index: 1 !important;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1 !important;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1 !important;
    }
  </style>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <nav class="bg-blue-900" style="z-index: 1 !important;">
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="{{asset('backend-assets/banner5.png')}}" alt="Category 1" class="w-full h-40 object-cover rounded-lg mb-2">
            </div>
            <div class="swiper-slide">
              <img src="{{asset('backend-assets/banner4.png')}}" alt="Category 2" class="w-full h-40 object-cover rounded-lg mb-2">
            </div>
            <div class="swiper-slide">
              <img src="{{asset('backend-assets/banner3.png')}}" alt="Category 3" class="w-full h-40 object-cover rounded-lg mb-2">
            </div>
            <div class="swiper-slide">
              <img src="{{asset('backend-assets/banner5.png')}}" alt="Category 3" class="w-full h-40 object-cover rounded-lg mb-2">
            </div>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
    </nav>


    <script>
      document.addEventListener('DOMContentLoaded', function() {
          var swiper = new Swiper('.mySwiper', {
              // Optional parameters
              direction: 'horizontal',
              loop: true,

              // If we need pagination
              pagination: {
                  el: '.swiper-pagination',
                  clickable: true,
              },

              // Navigation arrows
              navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev',
              },

              // And if we need scrollbar
              scrollbar: {
                  el: '.swiper-scrollbar',
              },
          });
      });
  </script>

</div>