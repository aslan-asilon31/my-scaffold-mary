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

  <x-product-contents.product-content-tab activatedTab="product-content-videos" :fieldId="$id" />

  <div class="mb-4">
    <h1 class="font-bold text-center">{{ $productContent['product']['name'] }}</h1>
    <h2 class="font-bold text-center">{{ $productContent['title'] }}</h2>
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
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap w-0">Name</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap" width="200px">Thumbnail</th>
          <th class="px-2 py-2 border border-gray-300 text-left text-nowrap">Video URL</th>
        </tr>
      </thead>
      <tbody class="align-top">
        @forelse ($productContent['product_content_videos'] as $index => $item)
          <tr class="bg-white hover:bg-gray-50">
            <td class="px-2 py-2 border border-gray-300 text-center text-nowrap">
              <x-dropdown no-x-anchor class="btn-sm">
                <x-menu-item title="Edit" wire:click.debounce.300ms="edit('{{ $item['id'] }}')" />
                <x-menu-item title="Delete" wire:click.debounce.300ms="delete('{{ $item['id'] }}')"
                  wire:confirm="Do you want to delete this data?" />
              </x-dropdown>
            </td>

            <td class="px-2 py-2 border border-gray-300 text-nowrap text-right">{{ $item['ordinal'] }}</td>
            <td class="px-2 py-2 border border-gray-300 text-nowrap">{{ $item['name'] }}</td>
            <td class="px-2 py-2 border border-gray-300">
              <img src="{{ url($item['thumbnail_url']) }}" alt="Product Video Image {{ $index + 1 }}"
                class="w-50">
            </td>
            <td class="px-2 py-2 border border-gray-300">
              <a href="{{ $item['video_url'] }}" target="_blank">{{ $item['video_url'] }}</a>
            </td>
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

      <x-file wire:model="masterForm.thumbnail_url" label="Thumbnail" accept="image/*" :disabled="$isDisabled" />
      <x-image-preview :imageUrl="$masterForm?->thumbnail_url" />
        

      <x-file wire:model="masterForm.video_url" label="Video" accept="video/*" :disabled="$isDisabled" />
      <x-video-preview :videoUrl="$masterForm?->video_url" />


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
