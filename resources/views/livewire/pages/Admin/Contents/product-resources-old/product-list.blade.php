<x-card :title="$title" shadow separator class="border shadow">
  <x-button label="Create" link="{{ $url . '/create' }}" class="btn-ghost btn-outline" />
  <livewire:pages.admin.contents.product-resources.components.product-table />
</x-card>
