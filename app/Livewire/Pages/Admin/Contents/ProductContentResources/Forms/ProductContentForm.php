<?php

namespace App\Livewire\Pages\Admin\Contents\ProductContentResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductContentForm extends Form
{
  public string|null $product_id = null;
  public string|null $title = null;
  public string|null $slug = null;
  public string|null $excerpt = null;
  public string|null $url = null;
  public TemporaryUploadedFile|string|null $image_url = null;
  public int|null $is_activated = 1;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.product_id' => 'required|string',
      'masterForm.title' => 'required|string',
      'masterForm.slug' => 'required|string',
      'masterForm.url' => 'required|string',
      'masterForm.excerpt' => 'nullable|string',
      'masterForm.image_url' => [
        'nullable',
        new \App\Rules\StringOrImageRule,
      ],
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.product_id' => 'Product',
      'masterForm.title' => 'Title',
      'masterForm.slug' => 'Title',
      'masterForm.url' => 'Title',
      'masterForm.excerpt' => 'Except',
      'masterForm.image_url' => 'Image',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
