<?php

namespace App\Livewire\Pages\Admin\Contents\ProductCategorySecondResources;

use App\Livewire\Pages\Admin\Contents\ProductCategorySecondResources\Forms\ProductCategorySecondForm;
use Livewire\Component;

class ProductCategorySecondList extends Component
{
  public $title = 'Product Category Second';
  public string $url = '/product-category-seconds';

  public function render()
  {
    return view('livewire.pages.admin.contents.product-category-second-resources.product-category-second-list')
    ->title($this->title);

  }
}
