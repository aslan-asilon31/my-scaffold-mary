<?php

namespace App\Livewire\Pages\AuthenticationResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
  public string|null $username = null;
  public string|null $password = null;

  public function rules()
  {
    return [
      'loginForm.username' => 'required|string',
      'loginForm.password' => 'required|string',
    ];
  }

  public function attributes()
  {
    return [
      'loginForm.username' => 'Username',
      'loginForm.password' => 'Password',
    ];
  }
}
