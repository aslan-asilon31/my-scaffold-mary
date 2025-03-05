<?php

namespace App\Livewire\Pages\Admin\Generals\MarketplaceResources;

use Livewire\Component;

class MarketplaceList extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.generals.marketplace-resources.marketplace-list')
      ->title($this->title);
  }

  public string $title = 'Market Place';
  public string $url = '/marketplaces';
}
