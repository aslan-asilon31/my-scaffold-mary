<?php

namespace App\Livewire\Pages\Admin\Generals\PositionResources;

use Livewire\Component;

class PositionList extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.generals.position-resources.position-list')
      ->title($this->title);
  }

  public function amount()
  {
    $this->permission($this->basePageName.'-list');
  }
  
  
  public string $url = '/positions';
  public string $title = 'Positions';
  use \App\Helpers\Permission\Traits\WithPermission;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'position';

}
