<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

  <style>
    @font-face {
      font-family: 'Kimono';
      src: url("{{ asset('frontend/fonts/Kimono.ttf') }}") format('truetype');
      font-weight: normal;
      font-style: normal;
  }

  .text-outline {
      color: black; /* Warna teks */
      text-shadow: 
          -1px -1px 0 white,  
          1px -1px 0 white,
          -1px 1px 0 white,
          1px 1px 0 white; /* Outline putih */
  }
  </style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/brands.min.css" integrity="sha512-58P9Hy7II0YeXLv+iFiLCv1rtLW47xmiRpC1oFafeKNShp8V5bKV/ciVtYqbk2YfxXQMt58DjNfkXFOn62xE+g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css" integrity="sha512-v8QQ0YQ3H4K6Ic3PJkym91KoeNT5S3PnDKvqnwqFD1oiqIl653crGZplPdU5KKtHjO0QKcQ2aUlQZYjHczkmGw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/regular.min.css" integrity="sha512-8hM9a+2hrLBhOuB3uiy+QIXBsu6Qk+snsP1CboFQW6pdt/yYz0IcDp/+CGv5m39r9doGUc/zw6aBpyLF6XFgzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/solid.min.css" integrity="sha512-DzC7h7+bDlpXPDQsX/0fShhf1dLxXlHuhPBkBo/5wJWRoTU6YL7moeiNoej6q3wh5ti78C57Tu1JwTNlcgHSjg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/svg-with-js.min.css" integrity="sha512-vtbctC7BecZMHWPWej78RfcB9RmGpIx+G4+1IT2/Z9P7SIXApaI1XLOCrzpSKgNyTiw1VCmg/EkJXGo+LJYcpw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/v4-font-face.min.css" integrity="sha512-nzYdV58RidllZqhgtA0a+ghpP5e8Qq3oNNBXNp+ShDoU0FUxwRmEjQzsL72SShhjX2dcLeqpyZ/MDW43hWHo4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/v4-shims.min.css" integrity="sha512-U+fiq69HDM4etLVUiZeQxmJE5AZoft4ti4TIM95MqXV0IjBXgT2oHw5cNeIFqz3OE/axTKQIR8e7zlm3xbOVmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/v5-font-face.min.css" integrity="sha512-dC4AauJwDHOpEpJi2/BsDf/b9vyLVt79nmO0x5gQWbRm62Q/xFS9iZpzCOFNLjTQsAD4mp9jJel6nPAjnBN2Ag==" crossorigin="anonymous" referrerpolicy="no-referrer" />



</head>

{{-- <body class=""> --}}
<body class="" x-data="{ isLoading: true }" x-init="setTimeout(() => isLoading = false, 2000)">
  <div class="loading-indicator" :class="{ 'hidden': !isLoading }" role="status">
  </div>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <livewire:pages.visitor.partials.header />
    
    <div class="container mx-auto mt-24">

      {{ $slot }}

    </div>

    <livewire:pages.visitor.partials.footer/>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        // delay: 8000,
        // duration: 4000,
      });
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/brands.min.js" integrity="sha512-ILOQokRQNF0S8SKV6fnaLNj02CmZnDWmYUr3zlH4jwToep0lWc7twuTzF+Mm0cKPdszi0xe8KymVi2y7mAweVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/conflict-detection.min.js" integrity="sha512-K5+wFlOsuophh3a/Im5Xc/i3w5YnOJmfTS74GUNHUH0UPe2Y55Y8iLkFkLjYy6aJy999ZIoKjsmFJMhjq3MlHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/fontawesome.min.js" integrity="sha512-j12pXc2gXZL/JZw5Mhi6LC7lkiXL0e2h+9ZWpqhniz0DkDrO01VNlBrG3LkPBn6DgG2b8CDjzJT+lxfocsS1Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/regular.min.js" integrity="sha512-yp4xbJGTx8AEOiU0F5fvbau3PajjDuxEwXpAPNVFtvJK52vjKuvxHLtOvxZFE6UBQr0hWvSciggEZJ82VwpkTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/solid.min.js" integrity="sha512-H/FYzgm63CLJLwSgCNv7zmAHWnbw7GwOrnCjE15CD969yHWj7fGDiHHLZuZJLO9ZGIkBR/JL91/p/ddbtUUgQQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/v4-shims.min.js" integrity="sha512-Ny27nj/CA4kOUa/2b2bhjr8YiJ+OfttH2314Wg8drWh4z9JqGO1PVEqPvo/kM+PjN5UEY4gFxo+ADkhXoGiaSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
