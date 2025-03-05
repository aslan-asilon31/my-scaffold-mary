<x-card :title="$title" shadow separator class="border shadow">
  <x-index-menu :url="$url" />

  <livewire:pages.admin.sales.sales-order-resources.components.sales-order-table />


  @script
    <script>
        $wire.on('pg:eventRefresh-sales-order-table', () => {
            alert('aaaa');
        });

        // Listen for the custom 'showAlert' event
        $wire.on('showAlert', (data) => {
            alert(data.message);
        });
    </script>
    @endscript

</x-card>
