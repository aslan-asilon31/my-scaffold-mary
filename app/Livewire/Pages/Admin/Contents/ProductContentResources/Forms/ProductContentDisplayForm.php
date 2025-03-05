<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class ProductContentDisplayForm extends Form
{
  public string|null $name = null;
  public TemporaryUploadedFile|string|null $image_url;
  public int|null $ordinal = 0;
  public int|null $is_activated = 1;

  public function rules(): array
  {
    return [
      'masterForm.name' => 'required|string',
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
      'masterForm.image_url' => 'Image URL',
      'masterForm.ordinal' => 'Ordinal',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
