<?php

namespace App\Livewire\Pages\Admin\Contents\CategoryRecommendationResources\Forms;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class CategoryRecommendationForm extends Form
{
  public ?string $name;
  public ?string $description;
  public TemporaryUploadedFile|string|null $image_url;
  public ?string $created_by;
  public ?string $updated_by;
  public ?string $created_at;
  public ?string $updated_at;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.name' => ['required', 'string', 'max:255'],
      'masterForm.description' => ['nullable', 'string'],
      'masterForm.image_url' => ['nullable'],
      'masterForm.created_by' => ['nullable', 'string', 'max:255'],
      'masterForm.updated_by' => ['nullable', 'string', 'max:255'],
      'masterForm.created_at' => ['nullable', 'date'],
      'masterForm.updated_at' => ['nullable', 'date'],
      'masterForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.description' => 'Description',
      'masterForm.image_url' => 'Image URL',
      'masterForm.created_by' => 'Created By',
      'masterForm.updated_by' => 'Updated By',
      'masterForm.created_at' => 'Created At',
      'masterForm.updated_at' => 'Updated At',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
