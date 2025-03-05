<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use Livewire\Component;
use App\Models\SalesOrder;

class SalesOrderList extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-list')
      ->title($this->title);
  }

  public function amount()
  {
    $this->statuses();
    $this->permission($this->basePageName.'-list');
  }

  public string $url = '/sales-orders';
  public string $title = 'Sales Order';

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

  






  use \App\Helpers\Permission\Traits\WithPermission;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'page';

}
