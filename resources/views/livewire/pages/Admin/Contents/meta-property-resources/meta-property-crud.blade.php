<x-content :title="$title">
  <x-form-menu :url="$url" :fieldId="$id" :isDeleteShowed="false" />
  <x-toast /> 
  <x-product-contents.product-content-tab activatedTab="product-content-displays" :fieldId="$id" />
  <div class="mb-4">
    <h1 class="font-bold text-center">{{ $productContent['product']['name'] }}</h1>
    <h2 class="font-bold text-center">{{ $productContent['title'] }}</h2>
  </div>

  <div class="mb-2">
    <x-button label="Create" wire:click="createProductContentDisplay" green />
  </div>

  <div class="overflow-x-scroll rounded-lg border min-h-80">
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
        @forelse ($productContent['meta_properties'] as $index => $item)
          <tr class="bg-white hover:bg-gray-50">
            <td class="px-2 py-2 border border-gray-300 text-center text-nowrap">
            </td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap text-right">{{ $item['ordinal'] }}</td>
            <td class="px-2 py-2 border border-gray-300">
              <img src="{{ $item['image_url'] ? url($item['image_url']) : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930'  }}" alt="Product Display Image {{ $index + 1 }}" class="w-50">
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

  <x-modal wire:model="myModalProductContentDisplayForm" 
      title="Product Content Display ({{ $productContentDisplayId ? 'Edit' : 'Create' }})" 
      subtitle="Livewire example" 
      separator>

      <form wire:submit.prevent="{{ $productContentDisplayId ? "updateProductContentDisplay('$productContentDisplayId')" : 'storeProductContentDisplay' }}">

      <div class="mb-3">
        <x-input label="Name" wire:model="masterForm.name" placeholder="Name" />
      </div>

      <div>
        <x-file wire:model="masterForm.image_url" label="Image" accept="image/*" crop-after-change :disabled="$isDisabled">
          <img
            src="{{ $masterForm->image_url ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
            class="h-48 rounded-lg" />
        </x-file>
      </div>

      <div class="mb-3">
        <x-input label="Ordinal" wire:model="masterForm.ordinal" placeholder="Ordinal" min="0" />
      </div>

      <div class="mb-3">
        <x-select label="Activate" wire:model="masterForm.is_activated" :options="[['label' => 'Yes', 'value' => 1], ['label' => 'No', 'value' => 0]]" option-label="label" option-value="value"
          :clearable="false" />
      </div>

      <div class="mt-4 text-center">
        @if ($productContentDisplayId)
          <x-button type="submit" label="Update" cyan />
        @else
          <x-button type="submit" label="Store" green />
        @endif
        <x-button label="Cancel" x-on:click="$wire.myModalProductContentDisplayForm = false" secondary />
      </div>

      <x-errors class="mt-4" />
    </form>



  </x-modal>

  <div wire:loading
    wire:target="createProductContentDisplay, storeProductContentDisplay, editProductContentDisplay, updateProductContentDisplay, deleteProductContentDisplay"
    class="fixed left-0 top-0 w-full h-full bg-black opacity-25  z-[99999]">
    <div class="w-full h-full flex justify-center items-center">
      <x-loading class="text-primary loading-lg" />
    </div>
  </div>

</x-content>
