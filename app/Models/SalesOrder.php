<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SalesOrder extends Model
{
    use HasFactory, HasUuids;
  
    public function newUniqueId(): string
    {
      return (string) str()->orderedUuid();
    }
  
    protected $keyType = 'string';
    public $incrementing = false;
  
    protected $guarded = [];

    public function salesInvoice()
    {
        return $this->hasOne(SalesInvoice::class, 'sales_order_id'); 
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id'); 
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id'); 
    }

    
    public function salesOrderDetail()
    {
      return $this->hasOne(SalesOrderDetail::class, 'sales_order_id'); 
    }


    public function salesShipping()
    {
        return $this->hasOne(SalesShipping::class, 'sales_order_id');  
    }
  }
  