<?php

namespace App\Livewire\Pages\Admin\Generals\EmployeeAccountResources;

use App\Livewire\Pages\Admin\EmployeeAccountResources\Forms\EmployeeAccountForm;
use App\Models\Position;
use App\Models\Employee;
use App\Models\EmployeeAccount;
use Livewire\Component;

class EmployeeAccountCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.generals.employee-account-resources.employee-account-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\Permission\Traits\WithPermission;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'employee_account';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Employees Account (CRUD)';

  #[\Livewire\Attributes\Locked]
  public string $url = '/employee-accounts';

  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/images/employee-accounts';

  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'employee_image';

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
  protected $masterModel = \App\Models\EmployeeAccount::class;


  public EmployeeAccountForm $masterForm;


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
  $this->options['employees'] = Employee::get(['id', 'name'])->toArray();


    $this->initialize();
  }

  public function initialize()
  {
  }

  public function create()
  {
    $this->permission($this->basePageName.'-create');
    $this->masterForm->reset();
  }

  public function store()
  {
    $this->permission( $this->basePageName.'-create');
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    
    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['password'] = bcrypt($validatedForm['password']);
      $validatedForm['created_by'] = auth()->user()->username;
      $validatedForm['updated_by'] = auth()->user()->username;

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->create();
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Log::error('Data failed to store: ' . $th->getMessage());
      \Illuminate\Support\Facades\DB::rollBack();
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
    $this->permission($this->basePageName.'-edit');
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
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

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['updated_by'] = auth()->user()->username;
      
      $masterData->update($validatedForm);

      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to update');
    }
  }

  public function delete()
  {
    $this->permission($this->basePageName.'-delete');
    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $this->deleteImage($masterData['image_url']);

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
