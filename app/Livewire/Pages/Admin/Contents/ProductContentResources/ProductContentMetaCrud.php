<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources;

use App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms\ProductContentMetaForm;
use App\Models\MetaProperty;
use Livewire\Component;

class ProductContentMetaCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.contents.product-content-resources.product-content-meta-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public string $title = 'Product Content';

  #[\Livewire\Attributes\Locked]
  public string $url = '/product-contents';

  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/product-contents';

  #[\Livewire\Attributes\Locked]
  private string $subFolderName = '/product-content-metas';

  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'product-content-meta-image';

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
  protected $parentModel = \App\Models\ProductContent::class;

  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\ProductContentMeta::class;

  public ProductContentMetaForm $masterForm;

  public array $productContent = [];

  public bool $crudModal = false;

  #[\Livewire\Attributes\Locked]
  public ?string $masterId;


    
  public function mount()
  {
    $this->initialize();
  }


  public function initialize()
  {
    
    $this->productContent = $this->parentModel::with([
      'product',
      'productContentMetas' => function ($q) {
        $q->orderBy('product_content_metas.ordinal', 'asc');
        $q->with('metaProperty.metaPropertyGroup');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();


    $this->options['meta_properties'] = MetaProperty::orderBy('ordinal')->get();
  }


  

  public function create()
  {
    $this->masterId = null;
    $this->masterForm->reset();
    $this->crudModal = true;
  }

  public function store()
  {

    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];


    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
      $validatedForm['product_content_id'] = $this->id;
      $validatedForm['created_by'] = auth()->user()->username;
      $validatedForm['updated_by'] = auth()->user()->username;

      $this->masterModel::create($validatedForm);

      \Illuminate\Support\Facades\DB::commit();

      $this->masterForm->reset();
      $this->crudModal = false;
      $this->initialize();
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to store');
    }
  }

  public function show()
  {
    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit($masterId)
  {
    $this->masterId = $masterId;
    $masterData = $this->masterModel::findOrFail($masterId);
    $this->masterForm->fill($masterData);
    $this->crudModal = true;
  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $masterData = $this->masterModel::findOrFail($this->masterId);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
      $validatedForm['product_content_id'] = $this->id;
      $validatedForm['updated_by'] = auth()->user()->username;

      $masterData->update($validatedForm);

      \Illuminate\Support\Facades\DB::commit();

      $this->masterId = null;
      $this->masterForm->reset();
      $this->crudModal = false;
      $this->initialize();
      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to update');
    }
  }

  public function delete($masterId)
  {
    $masterData = $this->masterModel::findOrFail($masterId);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();
      $this->initialize();
      $this->success('Data has been deleted');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }

  // hook
  public function updatedMasterFormMetaPropertyId($metaPropertyId)
  {
    $metaProperty = MetaProperty::find($metaPropertyId);
    $this->masterForm->ordinal = $metaProperty?->ordinal ? $metaProperty?->ordinal : 0;
  }
  // ./hook
}
