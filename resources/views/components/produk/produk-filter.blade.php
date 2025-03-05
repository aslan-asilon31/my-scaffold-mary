<div>
    <div class="col-md-3 col-xs-12">
        <div class="filters">


            <div class="filter-box active">
                <div class="title">
                    Cari berdasarkan Brand
                </div>
                <div class="filter-content ">
                    <select wire:model.live="filterCategory" class=" w-full text-center">    
                        <option value="">Pilih brand</option>  
                        @forelse($brands as $brand)  
                            <option value="{{ $brand->name }}">{{ $brand->name }}</option> 
                        @empty 
                            no data brand
                        @endforelse   
                    </select>
                </div>
            </div>

            <div class="filter-box active">
                <div class="title">
                    Cari berdasarkan nama produk
                </div>
                <div class="filter-content text-center">
                    <input type="text" wire:model.live="filterName" class=" w-full text-center" placeholder="Cari berdasarkan nama produk disini ..." />    
                </div>
            </div>

          

        </div> <!--/filters-->
    </div>
</div>