<?php

namespace App\Livewire\Pages\Admin\Contents\MetaPropertyResources;

use Livewire\Component;

class MetaPropertyList extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.contents.meta-property-resources.meta-property-list')
      ->title($this->title);
  }

  public string $title = 'Meta Property';
  public string $url = '/meta-properties';
}
