<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms;

use Livewire\Form;

class ProductContentReviewForm extends Form
{
  public string|null $name = null;
  public float|null $rating = 0;
  public string|null $comment = null;
  public int|null $ordinal = 0;
  public int|null $is_activated = 1;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.name' => 'required|string',
      'masterForm.rating' => 'required|numeric|min:0|max:5',
      'masterForm.comment' => 'required|string',
      'masterForm.ordinal' => 'required|numeric|min:0',
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.rating' => 'Rating',
      'masterForm.comment' => 'Description',
      'masterForm.ordinal' => 'Ordinal',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
