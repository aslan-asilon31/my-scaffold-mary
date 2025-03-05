<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductContentFeatureForm extends Form
{
  public string|null $name = null;
  public string|null $description = null;
  public TemporaryUploadedFile|string|null $image_url = null;
  public int|null $ordinal = 0;
  public int|null $is_activated = 1;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.name' => 'required|string',
      'masterForm.description' => 'required|string',
      'masterForm.image_url' => [
        'nullable',
        new \App\Rules\StringOrImageRule,
      ],
      'masterForm.ordinal' => 'required|numeric|min:0',
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.description' => 'Description',
      'masterForm.image_url' => 'Image URL',
      'masterForm.ordinal' => 'Ordinal',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
