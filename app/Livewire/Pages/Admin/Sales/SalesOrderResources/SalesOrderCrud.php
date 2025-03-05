<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\PositionPermission;

class SalesOrderCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\Permission\Traits\WithPermission;
  use \Mary\Traits\Toast;
  
  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'sales-order';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Sales Order';

  #[\Livewire\Attributes\Locked]
  public string $url = '/sales-orders';


  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'sales_order_image';

  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];
  
  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\SalesOrder::class;
  
  public array $statuses = [];
  public array $processed = [];

  public SalesOrderForm $masterForm;

  public function mount()
  {


    if ($this->id && $this->readonly) {
      $this->title .= ' (Show)';
      $this->show();
    } else if ($this->id) {
      $this->title .= ' (Edit)';
      $this->edit();
    } else {
      $this->title .= ' (Create)';
      $this->create();
    }
    $this->initialize();
  }

  public function initialize()
  {

    $masterData = $this->masterModel::with([
      'customer',
    ])
      ->findOrFail($this->id)
      ->toArray();

  }

  public function create()
  {
    $this->permission($this->basePageName.'-create');

    $this->masterForm->reset();
  }

  public function store()
  {
    $this->permission($this->basePageName.'-create');

    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    dd($validatedForm);

    $this->isReadonly = true;


    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['id'] = str($validatedForm['name'])->slug('_');

      $validatedForm['created_by'] = auth()->user()->username;
      $validatedForm['updated_by'] = auth()->user()->username;

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->create();
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data failed to store: ' . $th->getMessage());
      $this->error('Data failed to store');
    }
  }

  public function show()
  {
    $this->permission($this->basePageName.'-show');

    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit()
  {
    $this->statuses = [
        ['id' => 0, 'name' => 'pending'],
        ['id' => 1, 'name' => 'settlement'],
        ['id' => 2, 'name' => 'expired']
    ];


  
    $this->permission($this->basePageName.'-update');

    $masterData = $this->masterModel::query()
    ->join('customers', 'sales_orders.customer_id', 'customers.id')
    ->join('employees', 'sales_orders.employee_id', 'employees.id')
    ->select([
      'customers.id as employee_id',
      'employees.id as customer_id',
      'sales_orders.id',
      'customers.first_name',
      'customers.last_name',
      'employees.name AS employee_name',
      'sales_orders.date',
      'sales_orders.number',
      'sales_orders.total_amount',
      'sales_orders.status',
      'sales_orders.is_processed',
      'sales_orders.fraud_status',
      'sales_orders.updated_by',
      'sales_orders.created_at',
      'sales_orders.updated_at',
      'sales_orders.is_activated',
    ])->findOrFail($this->id);

    if ($masterData) {
        $this->masterForm->fill($masterData->toArray());
    } else {
        $this->error('Data tidak ditemukan');
    }


    

    // $masterData = $this->masterModel::with([
    //   'customer',
    // ])
    //   ->findOrFail($this->id)
    //   ->toArray();

    // logger($masterData); 

    // $this->isReadonly = true;

  }

  public function update()
  {
    $this->permission($this->basePageName.'-update');

    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $masterData = $this->masterModel::findOrFail($this->id);

    unset($validatedForm['customer_id']);
    unset($validatedForm['employee_id']);
    unset($validatedForm['first_name']);
    unset($validatedForm['last_name']);
    unset($validatedForm['employee_name']);


    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      if(empty($validatedForm['created_by'])){
        $validatedForm['created_by'] = auth()->user()->username;
      }
      $validatedForm['updated_by'] = auth()->user()->username;
      // @if($validatedForm['is_processed'] == 'settlement'){
      // }

      $masterData->update($validatedForm);

      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to update');
      \Log::error('Store data failed: ' . $th->getMessage());

    }
  }

  public function delete()
  {
    $this->permission($this->basePageName.'-delete');

    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been deleted');
      $this->redirect($this->url, true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }


}
