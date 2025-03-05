<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources;

use App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms\ProductContentForm;
use App\Models\ProductContent;
use Livewire\Component;
use Carbon\Carbon;

class ProductContentCrud extends Component
{


  public function render()
  {
    return view('livewire.pages.admin.contents.product-content-resources.product-content-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \Mary\Traits\Toast;
  use \App\Helpers\FormHook\Traits\WithFormHook;

  public string $fieldId = '';
  public string $imageUrl;
  public string $title = 'Product Content';
  public array|string $record = '';
  public string $selectedTab  = 'content-tab';
  public string $url = '/product-contents';


  public function setSelectedTab(string $tab)
  {
      $this->selectedTab = $tab;
  }



  #[\Livewire\Attributes\Locked]
  public null|string $id = null;

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public string $disabled = '';

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/images/product-contents';


  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\ProductContent::class;

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  private string $model = ProductContent::class;
  public ProductContentForm $masterForm;

  private string $uploadFolderName = 'files/images/product-contents';
  private string $baseImageName = 'product-content-image';
  
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
    $this->options['products'] = \App\Models\Product::get()->all();
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
      
      $validatedForm['slug'] = str($validatedForm['title'])->slug();
      $validatedForm['created_by'] = auth()->user()->username;
      $validatedForm['updated_by'] = auth()->user()->username;

      // image_url
      $folderName = $this->baseFolderName;
      $now = now()->format('Ymd_His_u');
      $imageName = $this->baseImageName . '_' . str($validatedForm['title'])->slug('_')  . '_' . 'image' . '_' . $now;
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
      $this->redirect($this->url.'/edit/'.$masterData->id, true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Store data failed: ' . $th->getMessage());

      $this->error('Data failed to store');
    }
  }

  public function edit()
  {
    $record = $this->model::findOrFail($this->id);
    // $this->record = json_decode( $this->record, true);
    $this->masterForm->fill($record);

    if(request()->segment(4) === 'readonly'){
      $this->isReadonly = true;
    }else{
      $this->isReadonly = false;
    }

  }

  public function show()
  {
    $record = $this->model::findOrFail($this->id);
    $this->masterForm->fill($record);
  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['slug'] = str($validatedForm['title'])->slug();
      $validatedForm['updated_by'] = auth()->user()->username;
      $id = $masterData->id;

      // image_url
      $folderName = $this->baseFolderName . "/{$id}";
      $now = now()->format('Ymd-His-u');
      $imageName =  $id  . '_' . $this->baseImageName . '_' . $now;
      $newImageUrl = $validatedForm['image_url'];
      $oldImageUrl = $masterData['image_url'];

      $validatedForm['image_url'] = $this->saveImage(
        $folderName,
        $imageName,
        $newImageUrl,
        $oldImageUrl,
      );
      // ./image_url


      $masterData->update($validatedForm);

      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to update');
    }
  }

  public bool $showConfirmModal = false;
  public int|null $recordIdToDelete = null;

  public function confirmDelete(int $id)
  {
      // Memancarkan event untuk JavaScript
      $this->emit('confirmDelete', $id);
  }

  
  public function delete()
  {
    $record = $this->model::findOrFail($this->id);

    $this->deleteImage($record->image_url);

    $record->delete();
    session()->flash('success_notification', __('messages.deleted_notification_message'));
    $this->redirect($this->url, true);
  }

  public function updatedMasterFormTitle()
  {
    $this->masterForm->slug = str($this->masterForm->title)->slug;
    $this->masterForm->url = '/p/' . str($this->masterForm->title)->slug;
  }
}
