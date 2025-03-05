<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms;

use Livewire\Form;

class ProductContentQnaForm extends Form
{
  public string|null $question = null;
  public string|null $answer = null;
  public int|null $ordinal = 0;
  public int|null $is_activated = 1;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.question' => 'required|string',
      'masterForm.answer' => 'required|string',
      'masterForm.ordinal' => 'required|numeric|min:0',
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.question' => 'Name',
      'masterForm.answer' => 'Description',
      'masterForm.ordinal' => 'Ordinal',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
