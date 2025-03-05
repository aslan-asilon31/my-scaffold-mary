<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources;

use App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms\ProductContentFeatureForm;
use Livewire\Component;
use Carbon\Carbon;

class ProductContentFeatureCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.contents.product-content-resources.product-content-feature-crud')
      ->title($this->title);
  }

  #[\Livewire\Attributes\Locked]
  public ?string $masterId;
  
  public string $title = 'Product Content Feature';
  public string $url = '/product-contents';
  public string $redirectUrl = '/product-content-features';

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentFeatureId = null;
  private string $model = \App\Models\ProductContent::class;

  #[\Livewire\Attributes\Locked]
  protected string $baseFolderName = '/files/images/product-contents';
  
  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\ProductContentFeature::class;

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
  
  public bool $myModalProductContentFeatureForm = false;
  public bool $crudModal = false;


  public ProductContentFeatureForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-features';
  private string $baseImageName = 'product-content-feature-image';

  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentFeatures' => function ($q) {
        $q->orderBy('product_content_features.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentFeature()
  {
    $this->productContentFeatureId = null;
    $this->masterForm->reset();

    $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
      ?->productContentFeatures()
      ?->max('ordinal') + 1;

    $this->masterForm->name = $this->productContent['product']['name'] . ' Feature Image ' . sprintf('%02d', $this->masterForm->ordinal);
    $this->crudModal = true;
  }

  public function storeProductContentFeature()
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


      // image_url
      $folderName = $this->baseFolderName .'/'. e($this->id) . '/product-content-features';
      $now = now()->format('Ymd_His_u');
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


      $this->toast(
          type: 'success',
          title: 'Data has been stored',
          description: "data has been stored",               
          position: 'toast-top toast-end',    
          icon: 'o-information-circle',      
          css: 'alert-info',                  
          timeout: 3000,                      
          redirectTo: null                    
      );

      $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Store data failed: ' . $th->getMessage());

      $this->error('Data failed to store');
    }
  }

  public function editProductContentFeature($productContentFeatureId)
  {
    $this->productContentFeatureId = $productContentFeatureId;
    $record = $this->model::findOrFail($this->id)
      ->productContentFeatures()
      ->findOrFail($productContentFeatureId)
      ->toArray();

    $this->masterForm->fill($record);
    $this->crudModal = true;

  }

  public function updateProductContentFeature($productContentFeatureId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentFeatureId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $record = $this->model::findOrFail($this->id)
      ->productContentFeatures()
      ->findOrFail($productContentFeatureId);

    $folderName = 'files/product-contents/' . e($this->id) . '/product-content-features';
    $newImageUrl = $validatedForm['image_url'];
    $newImageName = $this->id . '_' . $this->baseImageName;
    $oldImageUrl =  $record->image_url;
    $validatedForm['image_url'] = $this->saveImage(
      $folderName,
      $newImageUrl,
      $newImageName,
      $oldImageUrl
    );

    $validatedForm['updated_by'] = auth()->user()->username;

    $record->update($validatedForm);


    $this->toast(
      type: 'success',
      title: 'Data has been stored',
      description: "data has been updated",               
      position: 'toast-top toast-end',    
      icon: 'o-information-circle',      
      css: 'alert-info',                  
      timeout: 3000,                      
      redirectTo: null                    
  );

    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }

  public function delete($productContentFeatureId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentFeatures()
      ->findOrFail($productContentFeatureId);

    $this->deleteImage($record->image_url);

    $record->delete();

    $this->toast(
      type: 'success',
      title: 'Data has been deleted',
      description: "data has been deleted",               
      position: 'toast-top toast-end',    
      icon: 'o-information-circle',      
      css: 'alert-info',                  
      timeout: 3000,                      
      redirectTo: null                    
  );

    $this->redirect($this->redirectUrl . "/edit/{$this->id}", true);
  }
}
