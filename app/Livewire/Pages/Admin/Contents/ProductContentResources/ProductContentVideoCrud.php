<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources;

use App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms\ProductContentVideoForm;
use Livewire\Component;

class ProductContentVideoCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.contents.product-content-resources.product-content-video-crud')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\VideoUpload\Traits\WithVideoUpload;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public string $title = 'Product Content';

  #[\Livewire\Attributes\Locked]
  public string $url = '/product-contents';

  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/product-contents';

  #[\Livewire\Attributes\Locked]
  private string $subFolderName = '/product-content-videos';

  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'product-content-video-image';

  #[\Livewire\Attributes\Locked]
  private string $baseVideoName = 'product-content-video';

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
  protected $masterModel = \App\Models\ProductContentVideo::class;

  public ProductContentVideoForm $masterForm;

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
      'productContentVideos' => function ($q) {
        $q->orderBy('product_content_videos.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function create()
  {
    $this->masterId = null;
    $this->masterForm->reset();

    $this->masterForm->ordinal = (int) $this->parentModel::findOrFail($this->id)
      ?->productContentVideos()
      ?->max('ordinal') + 1;

    $this->masterForm->name = $this->productContent['product']['name'] . ' Video ' . sprintf('%02d', $this->masterForm->ordinal);

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
      $id = $this->id;

      // thumbnail_url
      $folderName = $this->baseFolderName . "/{$id}" . $this->subFolderName;
      $now = now()->format('Ymd-His-u');
      $imageName =  $id  . '_' . $this->baseImageName . '_' . $now;
      $newImageUrl = $validatedForm['thumbnail_url'];

      $validatedForm['thumbnail_url'] = $this->saveImage(
        $folderName,
        $imageName,
        $newImageUrl,
      );
      // ./thumbnail_url

      // video_url
      $folderName = $this->baseFolderName . "/{$id}" . $this->subFolderName;
      $now = now()->format('Ymd-His-u');
      $videoName =  $id  . '_' . $this->baseVideoName . '_' . $now;
      $newVideoUrl = $validatedForm['video_url'];

      $validatedForm['video_url'] = $this->saveVideo(
        $folderName,
        $videoName,
        $newVideoUrl,
      );
      // ./video_url

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
      $id = $this->id;

      // thumbnail_url
      $folderName = $this->baseFolderName . "/{$id}" . $this->subFolderName;
      $now = now()->format('Ymd-His-u');
      $imageName =  $id  . '_' . $this->baseImageName . '_' . $now;
      $newImageUrl = $validatedForm['thumbnail_url'];
      $oldImageUrl = $masterData['thumbnail_url'];

      $validatedForm['thumbnail_url'] = $this->saveImage(
        $folderName,
        $imageName,
        $newImageUrl,
        $oldImageUrl,
      );
      // ./thumbnail_url

      // video_url
      $folderName = $this->baseFolderName . "/{$id}" . $this->subFolderName;
      $now = now()->format('Ymd-His-u');
      $videoName =  $id  . '_' . $this->baseVideoName . '_' . $now;
      $newVideoUrl = $validatedForm['video_url'];
      $oldVideoUrl = $masterData['video_url'];

      $validatedForm['video_url'] = $this->saveVideo(
        $folderName,
        $videoName,
        $newVideoUrl,
        $oldVideoUrl,
      );
      // ./video_url

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

      $this->deleteImage($masterData['thumbnail_url']);
      $this->deleteVideo($masterData['video_url']);

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();
      $this->initialize();
      $this->success('Data has been deleted');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }
}
