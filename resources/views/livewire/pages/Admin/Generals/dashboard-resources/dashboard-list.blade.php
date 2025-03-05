<x-card :title="$title" shadow separator class="border shadow">

          <!-- cards -->
          <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 -->
            <div class="flex flex-wrap -mx-3">
              <!-- card1 -->
              <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                  <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                      <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                          <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Total Penjualan per Bulan</p>
                          <h5 class="mb-2 font-bold dark:text-white">Rp 53,000</h5>
                         
                        </div>
                      </div>
                      <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                          <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    
              <!-- card2 -->
              <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                  <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                      <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                          <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Today's Users</p>
                          <h5 class="mb-2 font-bold dark:text-white">Rp 2,300</h5>
                         
                        </div>
                      </div>
                      <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                          <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    
              <!-- card3 -->
              <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                  <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                      <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                          <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">New Clients</p>
                          <h5 class="mb-2 font-bold dark:text-white">Rp 3,462</h5>
                      
                        </div>
                      </div>
                      <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                          <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    
              <!-- card4 -->
              <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                  <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                      <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                          <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Sales</p>
                          <h5 class="mb-2 font-bold dark:text-white">Rp 103,430</h5>
                         
                        </div>
                      </div>
                      <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                          <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    
            <!-- cards row 2 -->
            <div class="flex flex-wrap mt-6 -mx-3">
              <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
                  <!-- Total Penjualan per Bulan -->  
                  <div class="card ">  
                    <div class="card-body">  
                      <h2 class="text-xl font-semibold mb-2">Produk Terlaris</h2>  
                        <canvas id="monthlySalesChart"></canvas>  
                    </div>  
                  </div>  
              </div>
    
              <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <!-- Produk Terlaris -->  
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">  
                  <h2 class="text-xl font-semibold mb-2">Produk Terlaris</h2>  
                  <canvas id="topProductsChart"></canvas>
                </div>  
              </div>
            </div>


            <div class="flex flex-wrap mt-6 -mx-3">
              <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
              <!-- Pelanggan Teraktif -->  
              <div class="bg-white shadow-md rounded-lg p-4 mb-4">  
                <h2 class="text-xl font-semibold mb-2">Pelanggan Teraktif</h2>  
                <canvas id="topCustomersChart"></canvas>  
              </div> 
              </div>
    
              <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <!-- Penjualan per Kategori Produk -->  
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">  
                  <h2 class="text-xl font-semibold mb-2">Penjualan per Kategori Produk</h2>  
                  <canvas id="categorySalesChart"></canvas>  
                </div> 
              </div>
            </div>
    
           
    
            <footer class="pt-4">
              <div class="w-full px-6 mx-auto">
                <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                  <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                    <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                   
                     KBN

                     <script>
                      document.write(new Date().getFullYear());
                    </script>

                    </div>
                  </div>
                  <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                   
                  </div>
                </div>
              </div>
            </footer>
          </div>
          <!-- end cards -->





  

  

        


      <script>  
        // Total Penjualan per Bulan  
        const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');  
        const monthlySalesChart = new Chart(monthlySalesCtx, {  
            type: 'line',  
            data: {  
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],  
                datasets: [{  
                    label: 'Total Sales',  
                    data: [1200, 1900, 3000, 5000, 2000, 3000],  
                    borderColor: 'rgba(75, 192, 192, 1)',  
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  
                    borderWidth: 1  
                }]  
            },  
            options: {  
                scales: {  
                    y: {  
                        beginAtZero: true  
                    }  
                }  
            }  
        }); 



        // Data untuk Produk Terlaris  
        const topProductsData = {  
            labels: @json(array_column($topProducts, 'product_name')), // Ganti dengan data produk  
            datasets: [{  
                label: 'Total Terjual',  
                data: @json(array_column($topProducts, 'total_sales')), // Ganti dengan data kuantitas  
                backgroundColor: 'rgba(75, 192, 192, 0.2)',  
                borderColor: 'rgba(75, 192, 192, 1)',  
                borderWidth: 1  
            }]  
        };  
  
        const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');  
        const topProductsChart = new Chart(topProductsCtx, {  
            type: 'bar',  
            data: topProductsData,  
            options: {  
                scales: {  
                    y: {  
                        beginAtZero: true  
                    }  
                }  
            }  
        });  
  
        // Data untuk Pelanggan Teraktif  
        const topCustomersData = {  
            labels: @json(array_column($topCustomers, 'customer_first_name')), // Ganti dengan data pelanggan  
            datasets: [{  
                label: 'Total Pesanan',  
                data: @json(array_column($topCustomers, 'total_orders')), // Ganti dengan data total pesanan  
                backgroundColor: 'rgba(153, 102, 255, 0.2)',  
                borderColor: 'rgba(153, 102, 255, 1)',  
                borderWidth: 1  
            }]  
        };  
  
        const topCustomersCtx = document.getElementById('topCustomersChart').getContext('2d');  
        const topCustomersChart = new Chart(topCustomersCtx, {  
            type: 'bar',  
            data: topCustomersData,  
            options: {  
                scales: {  
                    y: {  
                        beginAtZero: true  
                    }  
                }  
            }  
        });  


        const ctx = document.getElementById('categorySalesChart').getContext('2d');  
  
        const categorySalesData = {  
            labels: @json(array_column($categorySales, 'category_name')), // Ganti dengan data kategori  
            datasets: [{  
                label: 'Total Penjualan',  
                data: @json(array_column($categorySales, 'total_sales')), // Ganti dengan data penjualan  
                backgroundColor: 'rgba(75, 192, 192, 0.2)',  
                borderColor: 'rgba(75, 192, 192, 1)',  
                borderWidth: 1  
            }]  
        };  

        const categorySalesChart = new Chart(ctx, {  
            type: 'bar', // Tipe grafik, bisa diganti dengan 'pie', 'line', dll.  
            data: categorySalesData,  
            options: {  
                responsive: true,  
                scales: {  
                    y: {  
                        beginAtZero: true,  
                        title: {  
                            display: true,  
                            text: 'Total Penjualan'  
                        }  
                    },  
                    x: {  
                        title: {  
                            display: true,  
                            text: 'Kategori Produk'  
                        }  
                    }  
                }  
            }  
        });

      </script>
  



</x-card>
  