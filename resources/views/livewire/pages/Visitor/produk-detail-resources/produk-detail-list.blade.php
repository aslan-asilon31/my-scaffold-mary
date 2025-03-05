<div>
    <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
          <div class="flex flex-wrap -mx-4">
            <!-- Product Images -->
            <div class="w-full md:w-1/2 px-4 mb-8">

              <img src="{{ $product_content[0]['image_url'] }}" alt="Product"
                          class="w-full h-auto rounded-lg shadow-md mb-4" id="mainImage">
              <div class="flex gap-4 py-4 justify-center overflow-x-auto">
                @forelse($product_content[0]['product_content_displays'] as $pcd)

            

                    <img src="{{ $pcd['image_url'] }}" alt="img"
                              class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
                              onclick="changeImage(this.src)">
                @empty 
                @endforelse

              </div>


            </div>
      
            <!-- Product Details -->
            <div class="w-full md:w-1/2 px-4">
              <h2 class="text-3xl font-bold mb-2">{{ $product_content[0]['title'] }}</h2>
              <p class="text-gray-600 mb-4">SKU: {{  $product_content[0]['product']['sku']}} </p>
              <div class="mb-4">
                <span class="text-2xl font-bold mr-2">Rp {{  $product_content[0]['product']['nett_price'] <= 0 ? $product_content[0]['product']['selling_price'] : $product_content[0]['product']['nett_price'] }} </span>
                <span class="text-gray-500 line-through">Rp {{  $product_content[0]['product']['selling_price'] }} </span>
              </div>
           
                <p class="text-gray-700 mb-6">

                    {{ $product_content[0]['excerpt'] }}

                </p>
      
              <div class="flex space-x-4 mb-6">


                <div class="">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1"
                        class="w-12 text-center rounded-md border-gray-300  shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  </div>

                      @php  
                          $isInCart = $this->isProductInCart($product_content[0]['id']);  
                      @endphp

                      
                @if($isInCart)
                  <button
                      class="bg-red-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                      <i class="fa-solid fa-trash"></i>
                  </button>
                @else 
                  <button
                      class="bg-indigo-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                      <i class="fa-solid bg-sm fa-cart-shopping"></i>
                  </button>
                @endif

              </div>

            <div class="w-full mx-auto ">
                <div class="flex border-b border-gray-300">
                    <button
                        class="w-1/2 py-4 text-center font-medium text-gray-700 bg-gray-100 rounded-tl-lg focus:outline-none active:bg-gray-200"
                        onclick="openTab(event, 'tab1')">Spesifikasi</button>
                    <button class="w-1/2 py-4 text-center font-medium text-gray-700 bg-gray-100 rounded-tr-lg focus:outline-none"
                        onclick="openTab(event, 'tab2')">Fitur</button>
                </div>
                <div id="tab1" class="tabcontent p-4">
                    <h2 class="text-lg font-bold text-gray-800">Spesifikasi</h2>
                    <ul class="list-disc list-inside text-gray-700">
                      @forelse($product_content[0]['product_content_specifications'] as $specific)

                      {{-- @forelse($product_content->productContentSpecifications() as $specific) --}}
                            {{-- <li>{{ $specific }} </li> --}}
                            <li>{{ $specific['name'] }} </li>
                            @if (!$loop->last) 
                            @endif
                      @empty
                      -
                      @endforelse
                    </ul>

                </div>
                <div id="tab2" class="tabcontent p-4 hidden">
                    <h2 class="text-lg font-bold text-gray-800">Fitur</h2>
                    {{-- @forelse($product_content->productContentFeatures() as $feature) --}}
                    @forelse($product_content[0]['product_content_features'] as $feature)
                          <li>{{ $feature['name'] }} </li>
                          @if (!$loop->last) 
                          @endif
                    @empty
                    -
                    @endforelse
                </div>
            </div>
      
              {{-- <div>
                <h3 class="text-lg font-semibold mb-2">Key Features:</h3>
                <ul class="list-disc list-inside text-gray-700">
                    @foreach($product_content[0]['product_content_features'] as $feature)
                        <li>{{ $feature['description'] }} </li>
                        @if (!$loop->last) 
                        @endif
                    @endforeach
                </ul>
              </div> --}}
            </div>
          </div>
        </div>

        <br>
        <hr>
        <br>

        
        <!-- Rekomendasi untuk Kamu -->
        <div class="container mx-auto px-4 mt-10 bg-gradient-to-r from-cyan-500 to-blue-500  m-8 p-4 rounded-lg border shadow-lg">
          <h2 class="text-2xl font-bold mb-4  text-white underline">Rekomendasi untuk Anda</h2>
          <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 " data-aos="zoom-in">
              @forelse ($product_content[0]['product'] as $product)
                  <div class="bg-white rounded-lg shadow-md p-4">
                      <img src="{{ $product_content[0]['product']['image_url'] ?? asset('backend-assets/no-image-900x900.png')}}" alt="Rekomendasi 1" class=" object-cover rounded-lg mb-2">
                      <h3 class="text-lg font-semibold">{{ $product_content[0]['product']['name'] }}</h3>
                      <p class="text-gray-600">{{ $product_content[0]['product']['nett_price'] }}</p>
                  </div>
              @empty
                  tidak ada data
              @endforelse
              
          </div>
      </div>


        
        <script>
            function openTab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].classList.add("hidden");
                }
                tablinks = document.getElementsByTagName("button");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].classList.remove("active:bg-gray-200");
                }
                document.getElementById(tabName).classList.remove("hidden");
                evt.currentTarget.classList.add("active:bg-gray-200");
            }
        </script>
        
      
        <script>
          function changeImage(src) {
                  document.getElementById('mainImage').src = src;
              }
        </script>
      </div>
</div>
