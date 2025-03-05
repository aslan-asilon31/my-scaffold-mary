<?php

namespace App\Livewire\Pages\Admin\Contents\ProductCategoryFirstResources\Forms;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductCategoryFirstForm extends Form
{
  public ?string $product_category_second_id;
  public ?string $name;
  public ?string $description;
  public TemporaryUploadedFile|string|null $image_url;
  public TemporaryUploadedFile|string|null $header_image_url;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.product_category_second_id' => ['required', 'string', 'max:255'],
      'masterForm.name' => ['required', 'string', 'max:255'],
      'masterForm.description' => ['nullable', 'string'],
      'masterForm.image_url' => ['nullable'],
      'masterForm.header_image_url' => ['nullable'],
      'masterForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.product_category_second_id' => 'Product Category Second ID',
      'masterForm.name' => 'Name',
      'masterForm.description' => 'Description',
      'masterForm.image_url' => 'Image URL',
      'masterForm.header_image_url' => 'Header Image URL',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
