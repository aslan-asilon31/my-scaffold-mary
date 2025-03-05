<?php

namespace App\Livewire\Pages\Admin\Sales\CustomerResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class CustomerForm extends Form
{
  public ?string $id;
  public ?string $name;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.id' => ['nullable', 'string', 'max:255'],
      'masterForm.name' => ['required', 'string', 'max:255'],
      'masterForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.id' => 'Id',
      'masterForm.name' => 'Name',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}