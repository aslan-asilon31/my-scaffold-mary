<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms;

use Livewire\Form;

class ProductContentSpecificationForm extends Form
{
  public string|null $name = null;
  public string|null $description = null;
  public int|null $ordinal = 0;
  public int|null $is_activated = 1;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.name' => 'required|string',
      'masterForm.description' => 'required|string',
      'masterForm.ordinal' => 'required|numeric|min:0',
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.description' => 'Description',
      'masterForm.ordinal' => 'Ordinal',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
