<?php

namespace App\Livewire\Pages\Visitor\CartCheckoutResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class CartCheckoutForm extends Form
{
  public string|null $first_name = null;
  public string|null $last_name = null;
  public string|null $phone = null;
  public string|null $email = null;
  public string|null $address = null;
  public string|null $postal_code = null;
  public int|null $is_activated = 1;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.first_name' => 'required|string',
      'masterForm.last_name' => 'required|string',
      'masterForm.phone' => 'required|string',
      'masterForm.email' => 'required|string|unique:customers,email',
      'masterForm.address' => 'required|string',
      'masterForm.postal_code' => 'required|string',
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.first_name' => 'Nama Pertama',
      'masterForm.last_name' => 'Nama Terakhir',
      'masterForm.phone' => 'No Ttelpon/Wa',
      'masterForm.email' => 'Email',
      'masterForm.postal_code' => 'Kode POS',
      'masterForm.is_activated' => '-',
    ];
  }
}
