<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SalesInvoice extends Model
{
    use HasFactory, HasUuids;
  
    public function newUniqueId(): string
    {
      return (string) str()->orderedUuid();
    }
  
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];
    protected $table = 'sales_invoices';

    public function salesPayment()
    {
        return $this->hasOne(SalesPayment::class, 'sales_invoice_id'); // Ganti 'sales_order_id' dengan nama kolom yang sesuai di tabel sales_invoices
    }

    public function salesOrder()
    {
      return $this->belongsTo(SalesOrder::class);
    }


  }
  