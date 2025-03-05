<x-card :title="$title" shadow separator class="border shadow">


  <div class="grid grid-cols-2 mb-4">
    <div>
      <x-button label="List" link="{{ $url }}" class="btn-ghost btn-outline" />
      @if ($id)
        <x-button label="Create" link="{{ $url . '/create' }}" class="btn-ghost btn-outline" />
      @endif

      @if ($id && $isReadonly)
        <x-button label="Edit" link="{{ $url . '/edit/' . $id }}" class="btn-ghost btn-outline" />
      @endif

    </div>
    <div class="text-right">
      @if ($id && !$isReadonly)
        <x-button label="Delete" wire:click="delete" wire:confirm="Do you want to delete this data?"
          class="btn-ghost btn-outline text-red-500" />
      @endif
    </div>
  </div>


  <x-form wire:submit="{{ $id ? 'update' : 'store' }}" wire:confirm="Are you sure?">

    <x-choices-offline wire:model="masterForm.brand_id" label="Product Brand"
    :options="$options['product_brands']" placeholder="Search ..." single searchable :readonly="$isReadonly" />


    <x-choices-offline wire:model="masterForm.marketplace_id" label="Marketplace"
    :options="$options['marketplaces']" placeholder="Search ..." single searchable :readonly="$isReadonly" />

    
    <div class="mb-3">
      <x-input wire:model="masterForm.name" label="Name" placeholder="Name" :readonly="$isReadonly" />
    </div>
    <div class="mb-3">
      <x-input wire:model="masterForm.url" label="Url" placeholder="Url" :readonly="$isReadonly" />
    </div>
    <div class="mb-3">
      <x-input wire:model="masterForm.ordinal" label="Ordinal" min="0" placeholder="Ordinal" :readonly="$isReadonly" />
    </div>
    <div class="mb-3">
      <x-file wire:model="masterForm.image_url" label="Image" accept="image/*" crop-after-change :disabled="$isDisabled">
        <img
          src="{{ $masterForm->image_url ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
          class="h-48 rounded-lg" />
      </x-file>
    </div>
    <div class="mb-3">
      <x-select wire:model="masterForm.is_activated" :options="[['label' => 'Yes', 'value' => 1], ['label' => 'No', 'value' => 0]]" option-label="label" option-value="value"
        :clearable="false" :readonly="$isReadonly" />
    </div>

    @if (!$isReadonly)
      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
      </div>
    @endif
  </x-form>

  
</x-card>

