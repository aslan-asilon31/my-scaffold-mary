<?php

namespace App\Livewire\Pages\Admin\Sales\CustomerResources;

use Livewire\Component;

class CustomerList extends Component
{
  
  public function render()
  {
    return view('livewire.pages.admin.sales.customer-resources.customer-list')
      ->title($this->title);
  }

  public function amount()
  {
    $this->permission($this->basePageName.'-list');
  }

  public string $url = '/customers';
  public string $title = 'Customers';

  use \App\Helpers\Permission\Traits\WithPermission;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'customer';

}
