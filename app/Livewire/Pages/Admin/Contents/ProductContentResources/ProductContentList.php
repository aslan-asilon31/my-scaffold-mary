<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources;

use Livewire\Component;

class ProductContentList extends Component
{


  public function render()
  {
    return view('livewire.pages.admin.contents.product-content-resources.product-content-list')
      ->title($this->title);
  }

  public string $title = 'Product Content';
  public string $url = '/product-contents';

}
