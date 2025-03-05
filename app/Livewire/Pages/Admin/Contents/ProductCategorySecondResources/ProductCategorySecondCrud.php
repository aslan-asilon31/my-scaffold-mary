<?php

namespace App\Livewire\Pages\Admin\Contents\ProductCategorySecondResources;
use App\Livewire\Pages\Admin\Contents\ProductCategorySecondResources\Forms\ProductCategorySecondForm;

use Livewire\Component;
use Carbon\Carbon;

class ProductCategorySecondCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.product-category-second-resources.product-category-second-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public string $title = 'Product Category Second';

  #[\Livewire\Attributes\Locked]
  public string $url = '/product-category-seconds';
  
  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/images/product-category-seconds';

  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'product_category_second_image';


  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public string $disabled = '';

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];


  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\ProductCategorySecond::class;

  public ProductCategorySecondForm $masterForm;

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

  }



  public function create()
  {
    $this->masterForm->reset();
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

      $validatedForm['slug'] = str($validatedForm['name'])->slug();
      $validatedForm['created_by'] = auth()->user()->username;
      $validatedForm['updated_by'] = auth()->user()->username;
      $validatedForm['created_at'] = Carbon::now();
      $validatedForm['updated_at'] = Carbon::now();
      
      // image_url
      $folderName = $this->baseFolderName;
      $now = now()->format('Ymd_His_u');
      $imageName = $this->baseImageName . '_' . str($validatedForm['name'])->slug('_')  . '_' . 'image' . '_' . $now;
      $newImageUrl = $validatedForm['image_url'];


  
      $validatedForm['image_url'] = $this->saveImage(
        $folderName,
        $imageName,
        $newImageUrl,
      );
      // ./image_url
  
      // header_image_url
      $folderName = $this->baseFolderName;
      $now = now()->format('Ymd_His_u');


      // ./header_image_url
      $masterData = $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been stored');
      $this->redirect($this->url.'/show/'.$masterData->id.'/readonly', true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to store');
    }
  }
  
  public function show()
  {
    $this->readonly = 'readonly';
    $this->disabled = 'disabled';
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit()
  {
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $validatedForm['slug'] = str($validatedForm['name'])->slug();
    $validatedForm['updated_by'] = auth()->user()->username;

    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
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
