<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SalesPayment extends Model
{
    use HasFactory, HasUuids;
  
    public function newUniqueId(): string
    {
      return (string) str()->orderedUuid();
    }
  
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

  }
  