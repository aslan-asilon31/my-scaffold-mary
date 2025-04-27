<div>

    
    <x-index-menu :title="$title" :url="$url"   shadow separator class="" />

    <div class="">

        <x-table :headers="$headers"  class=""   :rows="$this->products" :cell-decoration="$cell_decoration" :sort-by="$sortBy"   with-pagination>


            @scope('cell_action', $product)
                <x-dropdown>
                    <x-menu-item title="Edit" icon="o-pencil-square" link="products/edit/{{ $product->id }}" />
                    <x-menu-item title="Show" icon="o-eye"  link="products/show/{{ $product->id }}/readonly"  />
                    <x-menu-item title="Delete" wire:click="delete" wire:confirm="Yakin hapus data?" icon="o-trash" />

                </x-dropdown>
            @endscope

            @scope('cell_is_activated', $product)
                <x-badge :value="$product->is_activated == 1 ? 'Yes':'No' " class=" {{ $product->is_activated == 1 ? 'badge-primary badge-soft': 'badge-error  badge-soft'}}" />
            @endscope

            @scope('cell_image_url', $product)
                <a href="{{ $product->image_url }}" class="px-4 underline underline-offset-1">{{ $product->image_url }}</a>
            @endscope

        </x-table>

    </div>
    

</div>