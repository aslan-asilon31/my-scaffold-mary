<?php

namespace App\Livewire\Pages\Admin\Generals\EmployeeResources;

use Livewire\Component;

use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Writer\Common\Creator\WriterEntityFactory;
use App\Models\Employee;
use OpenSpout\Reader\Common\Creator\ReaderEntityFactory;
use OpenSpout\Writer\XLSX\Writer;

class EmployeeList extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.generals.employee-resources.employee-list')
      ->title($this->title);
  }

  public string $url = '/employees';
  public string $title = 'Employees';

  use \App\Helpers\Permission\Traits\WithPermission;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'employee';
  
  public function amount()
  {
    $this->permission($this->basePageName.'-list');
  }

}
