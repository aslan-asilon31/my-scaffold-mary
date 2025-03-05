<?php

namespace App\Livewire\Pages\Admin\EmployeeAccountResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;


class EmployeeAccountForm extends Form
{
  public ?string $employee_id;
  public ?string $username;
  public ?string $password;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.employee_id' => ['required', 'string', 'max:255'],
      'masterForm.username' => ['required', 'string', 'max:255', 'unique:employee_accounts,username'],
      'masterForm.password' => ['required', 'string', 'min:4'],
      'masterForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.employee_id' => 'Employee ID',
      'masterForm.username' => 'Username',
      'masterForm.password' => 'Password',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
