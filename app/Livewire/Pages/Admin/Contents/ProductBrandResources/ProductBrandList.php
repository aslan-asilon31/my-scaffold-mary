<?php

namespace App\Livewire\Pages\Admin\Contents\ProductBrandResources;

use Livewire\Component;

class ProductBrandList extends Component
{
  public $title = 'Product Brand';
  public string $url = '/product-brands';
  use \App\Helpers\Permission\Traits\WithPermission;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'product_brand';
  
  public function amount()
  {
    $this->permission($this->basePageName.'-list');
  }

  public function render()
  {
    return view('livewire.pages.admin.contents.product-brand-resources.product-brand-list')
      ->title($this->title);
  }

}
