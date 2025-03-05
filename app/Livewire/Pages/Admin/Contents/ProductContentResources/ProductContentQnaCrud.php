<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources;

use App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms\ProductContentQnaForm;
use Livewire\Component;

class ProductContentQnaCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.contents.product-content-resources.product-content-qna-crud')
      ->title($this->title);
  }

  #[\Livewire\Attributes\Locked]
  public ?string $masterId;
  
  public string $title = 'Product Content Qna';
  public string $url = '/product-contents';
  public string $redirectUrl = '/product-content-qnas';

  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentQnaId = null;
  private string $model = \App\Models\ProductContent::class;

  
  
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
  
  public ProductContentQnaForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-qnas';
  private string $baseImageName = 'product_content_qna_image';
  public bool $myModalProductContentQnaForm = false;


  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentQnas' => function ($q) {
        $q->orderBy('product_content_qnas.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentQna()
  {
    $this->productContentQnaId = null;
    $this->masterForm->reset();

    $this->myModalProductContentQnaForm = true;


    // $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
    //   ?->productContentQnas()
    //   ?->max('ordinal') + 1;

    // $this->modal()->open('productContentQnaCardModal');
  }

  public function storeProductContentQna()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentQnaId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $validatedForm['created_by'] = auth()->user()->username;

    $record = $this->model::findOrFail($this->id);
    $record->productContentQnas()
      ->create($validatedForm);

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
  }

  public function editProductContentQna($productContentQnaId)
  {
    $this->productContentQnaId = $productContentQnaId;
    $record = $this->model::findOrFail($this->id)
      ->productContentQnas()
      ->findOrFail($productContentQnaId)
      ->toArray();

    $this->masterForm->fill($record);
    // $this->modal()->open('productContentQnaCardModal');
    $this->myModalProductContentQnaForm = true;

  }

  public function updateProductContentQna($productContentQnaId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentQnaId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $validatedForm['updated_by'] = auth()->user()->username;

    $record = $this->model::findOrFail($this->id)
      ->productContentQnas()
      ->findOrFail($productContentQnaId)
      ->update($validatedForm);


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

  public function delete($productContentQnaId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentQnas()
      ->findOrFail($productContentQnaId);

    $record->delete();

    $this->toast(
      type: 'success',
      title: 'Data has been stored',
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
