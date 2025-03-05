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

  <x-product-contents.product-content-tab activatedTab="product-contents" :fieldId="$id" />


  <x-form wire:submit="{{ $id ? 'update' : 'store' }}" wire:confirm="Are you sure?">

    <x-choices-offline wire:model="masterForm.product_id" label="Product" :options="$options['products']" placeholder="Search ..."
      single searchable :readonly="$isReadonly" />

    <x-input wire:model.blur="masterForm.title" label="Title" placeholder="Title" :readonly="$isReadonly" />

    <x-input wire:model="masterForm.url" label="URL" placeholder="URL" :readonly="$isReadonly" />

    <x-textarea wire:model="masterForm.excerpt" label="Excerpt" placeholder="Excerpt" :readonly="$isReadonly" />

    <x-file wire:model="masterForm.image_url" label="Image" accept="image/*" crop-after-change :disabled="$isDisabled">
      <img
        src="{{ $masterForm->image_url ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
        class="h-48 rounded-lg" />
    </x-file>

    <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single searchable
      :readonly="$isReadonly" />

    @if (!$isReadonly)
      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
      </div>
    @endif
  </x-form>


</x-card>
