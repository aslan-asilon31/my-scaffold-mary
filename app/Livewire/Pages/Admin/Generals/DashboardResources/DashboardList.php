<?php

namespace App\Livewire\Pages\Admin\Generals\DashboardResources;

use Livewire\Component;
use Illuminate\Support\Collection;
use Mary\Traits\Toast;
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\DB; 

class DashboardList extends Component
{

  public $title = 'Dashboard';
  public string $url = '/dashboards';

    use Toast;

    public string $search = '';
    public $monthlySales = [];
    public $topProducts = [];
    public $topCustomers = [];
    public $categorySales = [];

    public bool $drawer = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'age', 'label' => 'Age', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function users(): Collection
    {
        return collect([
            ['id' => 1, 'name' => 'Mary', 'email' => 'mary@mary-ui.com', 'age' => 23],
            ['id' => 2, 'name' => 'Giovanna', 'email' => 'giovanna@mary-ui.com', 'age' => 7],
            ['id' => 3, 'name' => 'Marina', 'email' => 'marina@mary-ui.com', 'age' => 5],
        ])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn(array $item) => str($item['name'])->contains($this->search, true));
            });
    }

    public function render()
    {

        return view('livewire.pages.admin.generals.dashboard-resources.dashboard-list', [
          'users' => $this->users(),
          'headers' => $this->headers()
        ])
        ->title($this->title);
    } 

    public function mount()
    {
       $this->initialize();
        // Total Penjualan per Bulan  
        $this->monthlySales = DB::select("SELECT * FROM vw_total_penjualan_per_bulan");  
  
        // Produk Terlaris  
        $this->topProducts = DB::select("SELECT * FROM vw_produk_terlaris");  
  
        // Pelanggan Teraktif  
        $this->topCustomers = DB::select("SELECT * FROM vw_pelanggan_teraktif");  
  
        // Penjualan per Kategori Produk  
        $this->categorySales = DB::select("SELECT * FROM vw_penjualan_per_kategori_produk");      
    } 

    public function initialize()
    {
       

    } 

}
