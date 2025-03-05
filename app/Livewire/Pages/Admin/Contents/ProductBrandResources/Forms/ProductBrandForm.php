<?php

namespace App\Livewire\Pages\Admin\Contents\ProductBrandResources\Forms;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductBrandForm extends Form
{
  public ?string $product_category_second_id;
  public ?string $name;
  public ?string $desc;
  public TemporaryUploadedFile|string|null $image_url;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.name' => ['required', 'string', 'max:255'],
      'masterForm.slug' => ['nullable', 'string'],
      'masterForm.desc' => ['nullable', 'string'],
      'masterForm.image_url' => ['nullable'],
      'masterForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.image_url' => 'Image URL',
      'masterForm.desc' => 'Description',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
