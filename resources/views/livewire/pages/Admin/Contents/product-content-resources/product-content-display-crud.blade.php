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

  <x-product-contents.product-content-tab activatedTab="product-content-displays" :fieldId="$id" />

  <div class="mb-4">
    <h1 class="font-bold text-center">{{ $productContent['product']['name']  ?? 'No Product Name'}}</h1>
    <h2 class="font-bold text-center">{{ $productContent['title']  ?? 'No Title '}}</h2>
  </div>

  <div class="mb-2">
    <x-button label="Add" wire:click.debounce.300ms="create()" class="btn-ghost btn-outline" />
  </div>

  <div class="overflow-x-auto rounded-lg border min-h-80">
    <table class="min-w-full border-gray-300">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Action</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Ordinal</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap" width="200px">Image</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap">Name</th>
        </tr>
      </thead>
      <tbody class="align-top">
        @forelse ($productContent['product_content_displays'] as $index => $item)
          <tr class="bg-white hover:bg-gray-50">
            <td class="px-2 py-2 border border-gray-300 text-center text-nowrap">
              <x-dropdown no-x-anchor class="btn-sm">
                <x-menu-item title="Edit" wire:click.debounce.300ms="edit('{{ $item['id'] }}')" />
                <x-menu-item title="Delete" wire:click.debounce.300ms="delete('{{ $item['id'] }}')"
                  wire:confirm="Do you want to delete this data?" />
              </x-dropdown>
            </td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap text-right">{{ $item['ordinal'] }}</td>
            <td class="px-2 py-2 border border-gray-300">
              <img src="{{ url($item['image_url']) }}" alt="Product Display Image {{ $index + 1 }}" class="w-50">
            </td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap">{{ $item['name'] }}</td>
          </tr>
        @empty
          <tr>
            <td class="px-2 py-2 border border-gray-300 text-nowrap text-center" colspan="100%">Data not found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <x-modal wire:model="crudModal" persistent>

    <x-form wire:submit="{{ $masterId ? 'update' : 'store' }}" wire:confirm="Are you sure?">

      <x-input wire:model="masterForm.name" label="Name" placeholder="Name" :readonly="$isReadonly" />

      <x-file wire:model="masterForm.image_url" label="Image" accept="image/*" crop-after-change :disabled="$isDisabled">
        <img
          src="{{ $masterForm->image_url ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
          class="h-48 rounded-lg" />
      </x-file>

      @if (($masterForm?->image_url ?? null) && is_string($masterForm?->image_url))
        <div>
          <img src="{{ $masterForm->image_url }}" class="h-48 rounded-lg" />
        </div>
      @endif

      <x-input type="number" wire:model="masterForm.ordinal" label="Ordinal" placeholder="Ordinal" :readonly="$isReadonly" />

      <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single searchable
        :readonly="$isReadonly" />

      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$masterId ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
        <x-button label="Cancel" @click="$wire.crudModal = false" class="btn-ghost btn-sm btn-outline" />
      </div>
    </x-form>

  </x-modal>

</x-card>
