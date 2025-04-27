<div>


    <x-index-menu :title="$title" :url="$url"   shadow separator class="" />

    <div class="">

        <x-table :headers="$headers"  class=""   :rows="$this->sales_orders" :cell-decoration="$cell_decoration" :sort-by="$sortBy"   with-pagination>
<!--
            @scope('cell_is_activated', $sales_order)
                <x-badge :value="$sales_order->is_activated == 1 ? 'Yes':'No' " class=" {{ $sales_order->is_activated == 1 ? 'badge-primary badge-soft': 'badge-error  badge-soft'}}" />
            @endscope

            @scope('cell_image_url', $sales_order)
                <a href="{{ $sales_order->image_url }}" class="px-4 underline underline-offset-1">{{ $product->image_url }}</a>
            @endscope -->

        </x-table>

    </div>


</div>
