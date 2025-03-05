<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class SalesOrderForm extends Form
{
  public ?string $id;
  public ?string $employee_id = null; 
  public ?string $customer_id = null; 
  public ?string $customer_name; 
  public ?string $employee_name; 
  public ?string $first_name; 
  public ?string $last_name; 
  public ?string $date = null; 
  public ?string $number = null; 
  public ?int $total_amount = null; 
  public ?string $note = null; 
  public ?string $created_by = null; 
  public ?string $updated_by = null; 
  public ?string $status = null; 
  public ?string $fraud_status = null; 
  public int $is_processed = 1;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.id' => ['nullable', 'string', 'max:255'],
      'masterForm.employee_id' => ['nullable', 'string', 'max:255'],
      'masterForm.customer_id' => ['nullable', 'string', 'max:255'],
      'masterForm.employee_name' => ['nullable', 'string', 'max:255'],
      'masterForm.name' => ['nullable', 'string', 'max:255'],
      'masterForm.first_name' => ['nullable', 'string', 'max:255'],
      'masterForm.last_name' => ['nullable', 'string', 'max:255'],
      'masterForm.date' => ['nullable', 'string', 'max:255'],
      'masterForm.number' => ['nullable', 'string', 'max:255'],
      'masterForm.total_amount' => ['nullable', 'integer'],
      'masterForm.note' => ['nullable', 'string', 'max:255'],
      'masterForm.created_by' => ['nullable', 'string', 'max:255'],
      'masterForm.updated_by' => ['nullable', 'string', 'max:255'],
      'masterForm.status' => ['nullable', 'string', 'max:255'],
      'masterForm.fraud_status' => ['nullable', 'string', 'max:255'],
      'masterForm.is_processed' => ['nullable', 'integer', Rule::in([0, 1])],
      'masterForm.is_activated' => ['nullable', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.id' => 'Id',
      'masterForm.employee_id' => 'Employee ID',
      'masterForm.customer_id' => 'Customer ID',
      'masterForm.customer_name as name' => 'Customer ID',
      'masterForm.employee_name' => 'Employee ID',
      'masterForm.first_name' => 'Nama Awal',
      'masterForm.last_name' => 'Nama Akhir',
      'masterForm.date' => 'Date',
      'masterForm.number' => 'Number',
      'masterForm.total_amount' => 'Total Amount',
      'masterForm.note' => 'Note',
      'masterForm.created_by' => 'Created By',
      'masterForm.updated_by' => 'Updated By',
      'masterForm.status' => 'Status',
      'masterForm.fraud_status' => 'Fraud Status',
      'masterForm.is_processed' => 'Is Processed',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}