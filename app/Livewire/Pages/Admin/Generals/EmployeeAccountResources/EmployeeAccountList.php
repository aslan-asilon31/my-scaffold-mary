<?php

namespace App\Livewire\Pages\Admin\Generals\EmployeeAccountResources;

use Livewire\Component;

class EmployeeAccountList extends Component
{
    
  public function amount()
  {
    $this->permission($this->basePageName.'-list');
  }

  public function render()
  {
    return view('livewire.pages.admin.generals.employee-account-resources.employee-account-list')
      ->title($this->title);
  }
  
  public string $url = '/employee-accounts';
  public string $title = 'Employee Accounts';
  use \App\Helpers\Permission\Traits\WithPermission;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'employee_account';

}
