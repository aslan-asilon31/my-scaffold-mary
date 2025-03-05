<?php

namespace App\Livewire\Pages\AuthenticationResources;

use App\Livewire\Pages\AuthenticationResources\Forms\LoginForm;
use Livewire\Component;

class Login extends Component
{
  public function render()
  {
    return view('livewire.pages.authentication-resources.login')
      ->layout('livewire.layouts.auth')
      ->title($this->title);
  }

  public string $title = 'Login';

  public LoginForm $loginForm;

  public function mount()
  {
    if (\Illuminate\Support\Facades\Auth::check()) {
      return redirect()->intended('dashboards');
    }
  }

  public function login()
  {
    $validatedLoginForm = $this->validate(
      $this->loginForm->rules(),
      [],
      $this->loginForm->attributes()
    )['loginForm'] ?? [];
    
    if (\Illuminate\Support\Facades\Auth::attempt(['username' => $validatedLoginForm['username'], 'password' => $validatedLoginForm['password']])) {
      session()->regenerate();
      return redirect()->intended('dashboards');
    } else {
      $this->addError('invalid_account', 'Username atau password salah.');
    }
  }
}
