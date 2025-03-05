<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources;

use App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms\ProductContentDisplayForm;
use Livewire\Component;
use Carbon\Carbon;

class ProductContentDisplayCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.contents.product-content-resources.product-content-display-crud')
      ->title($this->title);
  }

  public string $title = 'Product Content Display';
  public string $url = '/product-contents';
  public string $selectedTab  = '/product-content-displays';
  public string $redirectUrl = '/product-content-displays';

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentDisplayId = null;
  
  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/images/product-contents';

  public bool $crudModal = false;

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public string $disabled = '';

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  private string $subFolderName = '/product-content-displays';

  #[\Livewire\Attributes\Locked]
  protected $parentModel = \App\Models\ProductContent::class;

  
  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\ProductContentDisplay::class;

  #[\Livewire\Attributes\Locked]
  public ?string $masterId;

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  private string $model = \App\Models\ProductContent::class;


  public ProductContentDisplayForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-displays';
  private string $baseImageName = 'product-content-display-image';


  public array $productContent = [];

  public function mount()
  {
    $this->initialize();
  }

  public function initialize()
  {
    $this->productContent = $this->parentModel::with([
      'product',
      'productContentDisplays' => function ($q) {
        $q->orderBy('product_content_displays.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  // public function edit()
  // {
  //   $this->productContent = $this->model::with([
  //     'product',
  //     'productContentDisplays' => function ($q) {
  //       $q->orderBy('product_content_displays.ordinal', 'asc');
  //     }
  //   ])
  //     ->findOrFail($this->id)
  //     ->toArray();
  //   $this->masterForm->fill($this->productContent);
  //   $this->crudModal = true;
  // }


  public function create()
  {
    $this->masterId = null;
    $this->productContentDisplayId = null;
    $this->masterForm->reset();
    $this->masterForm->image_url = null;
    
    $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
    ?->productContentDisplays()
    ?->max('ordinal') + 1;
    $this->masterForm->name = $this->productContent['product']['name'] . ' Display Image ' . sprintf('%02d', $this->masterForm->ordinal);
    
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
      $validatedForm['created_at'] = Carbon::now();
      $validatedForm['updated_at'] = Carbon::now();
      $id = $this->id;

      // image_url
      $folderName = $this->baseFolderName . "/{$id}" . $this->subFolderName;
      $now = now()->format('Ymd_His');
      $imageName = $this->baseImageName . '_' . str($validatedForm['name'])->slug('_')  . '_' . 'image' . '_' . $now;

      $newImageUrl = $validatedForm['image_url'];
  
      $validatedForm['image_url'] = $this->saveImage(
        $folderName,
        $imageName,
        $newImageUrl,
      );

      // ./image_url

      $masterData = $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been stored');
      $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Store data failed: ' . $th->getMessage());

      $this->error('Data failed to store');
    }
  }
  

  public function edit($productContentDisplayId)
  {
    $this->productContentDisplayId = $productContentDisplayId;

    $record = $this->model::findOrFail($this->id)
      ->productContentDisplays()
      ->findOrFail($productContentDisplayId)
      ->toArray();

    

    $this->masterForm->fill($record);
    $this->crudModal = true;

  }

  public function show($productContentDisplayId)
  {
    $this->productContentDisplayId = $productContentDisplayId;
    $record = $this->model::findOrFail($this->id)
      ->productContentDisplays()
      ->findOrFail($productContentDisplayId)
      ->toArray();

    $this->masterForm->fill($record);
    $this->crudModal = true;

  }

  public function update($productContentDisplayId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id)
      ->productContentDisplays()
      ->findOrFail($productContentDisplayId);

      // image_url
      $folderName = $this->baseFolderName;
      $now = now()->format('Ymd_His_u');
      $imageName = $this->baseImageName . '_' . str($validatedForm['name'])->slug('_')  . '_' . 'image' . '_' . $now;
      $newImageUrl = $validatedForm['image_url'];
      $oldImageUrl = $record['image_url'];

      $validatedForm['image_url'] = $this->saveImage(
        $folderName,
        $imageName,
        $newImageUrl,
        $oldImageUrl,
      );
      // ./image_url

    $validatedForm['updated_by'] = auth()->user()->username;

    $record->update($validatedForm);

    $this->success('Data has been updated');
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);

  }

  public function delete($productContentDisplayId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentDisplays()
      ->findOrFail($productContentDisplayId);

    $this->deleteImage($record->image_url);

    $record->delete();

    $this->success('Data has been deleted');
    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }
}
