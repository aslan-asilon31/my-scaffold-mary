<?php

namespace App\Livewire\Pages\Admin\Generals\PageResources;

use Livewire\Component;

class PageList extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.generals.page-resources.page-list')
      ->title($this->title);
  }

  public function amount()
  {
    $this->permission($this->basePageName.'-list');
  }

  public string $url = '/pages';
  public string $title = 'Pages';

  use \App\Helpers\Permission\Traits\WithPermission;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'page';

}
