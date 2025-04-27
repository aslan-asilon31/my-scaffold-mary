<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use Livewire\Component;
use App\Models\SalesOrder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SalesOrderList extends Component
{
    public $title = "Sales Orders";
    public $url = "/sales-orders";

    #[Locked]
    public $salesOrderId;

    #[Url]
    public ?string $search = '';

    use WithPagination;

    public $headers = [];
    public $cell_decoration ;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];


  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-list')
      ->title($this->title);
  }

  #[Computed]
  public function sales_orders(): LengthAwarePaginator
  {
      return \App\Models\SalesOrder::query()
      ->join('customers', 'sales_orders.customer_id', 'customers.id')
      ->select([
        'sales_orders.id',
        'customers.first_name',
        'customers.last_name',
        'sales_orders.date',
        'sales_orders.number',
        'sales_orders.total_amount',
        'sales_orders.status',
        'sales_orders.is_processed',
        'sales_orders.updated_by',
        'sales_orders.created_at',
        'sales_orders.updated_at',
        'sales_orders.is_activated',
      ])->where('customers.first_name', 'LIKE', "%{$this->search}%")
      ->paginate(5);


  }


  public function mount()
  {

    $this->headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'customers.first_name', 'label' => 'First Name'],
        ['key' => 'customers.last_name', 'label' => 'Last Name'],
        ['key' => 'sales_orders.date', 'label' => 'Date'],
        ['key' => 'sales_orders.number', 'label' => 'Number'],
        ['key' => 'sales_orders.total_amount', 'label' => 'Total Amount'],
        ['key' => 'sales_orders.status', 'label' => 'Status'],
        ['key' => 'sales_orders.is_processed', 'label' => 'Is processes'],
        ['key' => 'sales_orders.updated_by', 'label' => 'Updated By'],
        ['key' => 'sales_orders.created_at', 'label' => 'Created At'],
        ['key' => 'sales_orders.updated_at', 'label' => 'Updated At'],
        ['key' => 'sales_orders.is_activated', 'label' => 'Is Activated']
    ];


    $this->statuses();
    // $this->permission($this->basePageName.'-list');
  }


  public $salesOrderStatusPending;
  public $salesOrderStatusSettlement;
  public $salesOrderStatusExpired;
  public $salesOrderFraudStatusIdentify;
  public $salesOrderFraudStatusAccept;
  public $salesOrderIsActivateYes;
  public $salesOrderIsActivateNo;

  public function statuses(){
    $countSalesOrderStatusPending = SalesOrder::where('status','pending')->get();
    $this->salesOrderStatusPending = $countSalesOrderStatusPending->count();

    $this->salesOrderStatusSettlement = SalesOrder::where('status','settlement');
    $this->salesOrderStatusExpired = SalesOrder::where('status','expired');

    $this->salesOrderFraudStatusIdentify = SalesOrder::where('fraud_status','identifying');
    $this->salesOrderFraudStatusAccept = SalesOrder::where('fraud_status','accept');

    $this->salesOrderIsActivateYes = SalesOrder::where('is_activated',1);
    $this->salesOrderIsActivateNo = SalesOrder::where('is_activated',0);
  }

  public function tess(){
    dd('tess');
  }








//   use \App\Helpers\Permission\Traits\WithPermission;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'page';

}
