
<div class="pb-5  border-b-2">

  <x-header title="{{ $title }}" subtitle="" separator>
    <x-slot:actions>

        @if(empty($id))
          @if(request()->path() == $url . '/create' )
            <x-button icon-right="o-plus-circle" label="Create" link="{{ $url . '/create' }}" class=" btn-ghost btn-outline" />
          @endif
        @else
            <x-button icon-right="o-list-bullet" label="List Product" link="/{{ $url }}" class=" btn-ghost btn-outline" />
            <x-button icon-right="o-trash"  wire:click="delete" wire:confirm="Yakin hapus data?" label="Delete" class=" btn-ghost btn-outline" />
        @endif

        <x-button label="Filters" @click="$wire.productFilter = true" responsive icon="o-funnel" class="btn-primary" />
    </x-slot:actions>
  </x-header>

    <x-drawer wire:model="productFilter" title="Filters" right separator with-close-button class="">
      <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />
  
      <x-slot:actions>
          <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
          <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
      </x-slot:actions>
    </x-drawer>
    
      
</div>

