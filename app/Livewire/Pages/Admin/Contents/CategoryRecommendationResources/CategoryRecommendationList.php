<?php

namespace App\Livewire\Pages\Admin\Contents\CategoryRecommendationResources;

use App\Livewire\Pages\Admin\Contents\CategoryRecommendationResources\Forms\CategoryRecommendationForm;
use Livewire\Component;

class CategoryRecommendationList extends Component
{
  public $title = 'Product Recommendation';
  public string $url = '/category-recommendations';

  public function render()
  {
    return view('livewire.pages.admin.contents.category-recommendation-resources.category-recommendation-list')
    ->title($this->title);

  }
}
