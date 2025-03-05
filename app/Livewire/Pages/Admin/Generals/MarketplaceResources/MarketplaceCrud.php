<?php

namespace App\Livewire\Pages\Admin\Generals\MarketplaceResources;

use App\Livewire\Pages\Admin\Generals\MarketplaceResources\Forms\MarketplaceForm;
use App\Models\ProductBrand;
use App\Models\Marketplace;
use App\Models\ProductBrandMarketplace;
use Livewire\Component;


class MarketplaceCrud extends Component
{
  
  public function render()
  {
    return view('livewire.pages.admin.generals.marketplace-resources.marketplace-crud')
      ->title($this->title);
  }

  public string $title = 'Market Places';

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \App\Helpers\Permission\Traits\WithPermission;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  private string $model = Marketplace::class;
  public MarketplaceForm $masterForm;

  public $product_brand_marketplaces;
  public $product_brands;

  #[\Livewire\Attributes\Locked]
  public string $url = '/marketplaces';

  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/images/products';

  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'marketplace_image';

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'marketplace';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];


  private string $uploadFolderName = 'files/images/marketplaces';


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
    $this->options['marketplaces'] = \App\Models\Marketplace::get()->all();
    $this->options['product_brands'] = ProductBrand::all();
    $this->product_brand_marketplaces = ProductBrandMarketplace::all();
  }


  public function create()
  {
    $this->permission($this->basePageName.'-create');
    $this->masterForm->reset();
  }

  public function store()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->id),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    dd($validatedForm);

    $folderName = $this->uploadFolderName;
    $newImageUrl = $validatedForm['image_url'];
    $newImageName = $this->baseImageName . '-' . str($validatedForm['name'])->slug('_');
    $oldImageUrl = null;
    $validatedForm['image_url'] = $this->saveImage(
      $folderName,
      $newImageUrl,
      $newImageName,
      $oldImageUrl
    );

    $validatedForm['slug'] = str($validatedForm['name'])->slug();
    $this->model::create($validatedForm);

    session()->flash('success_notification', __('messages.created_notification_message'));
    $this->redirect($this->url, true);
  }

  public function edit()
  {
    $record = $this->model::findOrFail($this->id);
    $this->masterForm->fill($record);
  }

  public function update()    
  {    
      // Validate the form data  
      $validatedForm = $this->validate(  
          $this->masterForm->rules(),  
          [],  
          $this->masterForm->attributes()  
      )['masterForm'];  
    
      // Find the existing record  
      $masterData = $this->model::findOrFail($this->id);    
    
      // Prepare for image upload  
      $folderName = $this->baseFolderName;    
      $now = now()->format('Ymd_His_u');    
      $imageName = $this->baseImageName . '_' . str($validatedForm['name'])->slug('_') . '_' . 'image' . '_' . $now;    
      $newImageUrl = $validatedForm['image_url'];    
      $oldImageUrl = $masterData['image_url'];    
    
      // Handle image upload  
      try {  
          $validatedForm['image_url'] = $this->saveImage(    
              $folderName,    
              $imageName,    
              $newImageUrl,    
              $oldImageUrl    
          );    
      } catch (\Exception $e) {  
          \Log::error('Image upload failed: ' . $e->getMessage());  
          $this->error('Image upload failed. Please try again.');  
          return; // Exit the method if image upload fails  
      }  
    
      // Update the record  
      try {  
          $masterData->update($validatedForm);    
          session()->flash('success_notification', __('messages.updated_notification_message'));    
      } catch (\Exception $e) {  
          \Log::error('Data update failed: ' . $e->getMessage());  
          $this->error('Data failed to update. Please check your input and try again.');  
      }  
  }  
  
  

  public function delete()
  {
    $record = $this->model::findOrFail($this->id);

    $this->deleteImage($record->image_url);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->url, true);
  }
}
