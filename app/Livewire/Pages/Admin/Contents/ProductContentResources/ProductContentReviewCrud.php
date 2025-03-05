<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources;

use App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms\ProductContentReviewForm;
use Livewire\Component;

class ProductContentReviewCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.contents.product-content-resources.product-content-review-crud')
      ->title($this->title);
  }

  #[\Livewire\Attributes\Locked]
  public ?string $masterId;
  
  public string $title = 'Product Content Review';
  public string $url = '/product-contents';
  public string $redirectUrl = '/product-content-reviews';

  use \App\Helpers\FormHook\Traits\WithFormHook;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  public null|string $id = null;
  #[\Livewire\Attributes\Locked]
  public null|string $productContentReviewId = null;
  private string $model = \App\Models\ProductContent::class;
  
  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\ProductContentReview::class;


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
  
  public ProductContentReviewForm $masterForm;

  private string $uploadFolderName = 'files/images/product-content-reviews';
  private string $baseImageName = 'product_content_review_image';
  public bool $myModalProductContentReviewForm = false;


  public array $productContent = [];

  public function edit()
  {
    $this->productContent = $this->model::with([
      'product',
      'productContentReviews' => function ($q) {
        $q->orderBy('product_content_reviews.ordinal', 'asc');
      }
    ])
      ->findOrFail($this->id)
      ->toArray();
  }

  public function createProductContentReview()
  {
    $this->productContentReviewId = null;
    $this->masterForm->reset();

    $this->masterForm->ordinal = (int) $this->model::findOrFail($this->id)
      ?->productContentReviews()
      ?->max('ordinal') + 1;

    $this->myModalProductContentReviewForm = true;
  }

  public function storeProductContentReview()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentReviewId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];


    $validatedForm['created_by'] = auth()->user()->username;

    $record = $this->model::findOrFail($this->id);
    $record->productContentReviews()
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

  public function editProductContentReview($productContentReviewId)
  {
    $this->productContentReviewId = $productContentReviewId;
    $record = $this->model::findOrFail($this->id)
      ->productContentReviews()
      ->findOrFail($productContentReviewId)
      ->toArray();

    $this->masterForm->fill($record);
    // $this->modal()->open('productContentReviewCardModal');
    $this->myModalProductContentReviewForm = true;

  }

  public function updateProductContentReview($productContentReviewId)
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules($this->productContentReviewId),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $validatedForm['updated_by'] = auth()->user()->username;

    $record = $this->model::findOrFail($this->id)
      ->productContentReviews()
      ->findOrFail($productContentReviewId)
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

  public function delete($productContentReviewId)
  {
    $record = $this->model::findOrFail($this->id)
      ->productContentReviews()
      ->findOrFail($productContentReviewId);

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
