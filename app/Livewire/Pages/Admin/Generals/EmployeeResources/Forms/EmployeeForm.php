<?php

namespace App\Livewire\Pages\Admin\EmployeeResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;


class EmployeeForm extends Form
{
  public ?string $position_id;
  public ?string $name;
  public ?string $phone;
  public ?string $email;
  public TemporaryUploadedFile|string|null $image_url;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.position_id' => ['required', 'string', 'max:255'],
      'masterForm.name' => ['required', 'string', 'max:255'],
      'masterForm.phone' => ['nullable', 'unique:employees,phone'],
      'masterForm.email' => ['nullable', 'string', 'unique:employees,email'],
      'masterForm.image_url' => ['nullable'],
      'masterForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.position_id' => 'Product Category Second ID',
      'masterForm.name' => 'Name',
      'masterForm.phone' => 'Phone',
      'masterForm.email' => 'Email',
      'masterForm.image_url' => 'Image URL',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
