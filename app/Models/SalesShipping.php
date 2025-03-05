<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesShipping extends Model
{
  use HasFactory, HasUuids;

  public function newUniqueId(): string
  {
    return (string) str()->orderedUuid();
  }

  protected $guarded = [];
  protected $table = 'sales_shippings';

  protected function casts(): array
  {
    return [
      'created_at' => 'datetime: Y-m-d H:i:s',
      'updated_at' => 'datetime: Y-m-d H:i:s',
    ];
  }

  protected function serializeDate(\DateTimeInterface $date): string
  {
    return $date->format('Y-m-d H:i:s');
  }

  public function salesOrder()
  {
    return $this->belongsTo(SalesOrder::class);
  }

}
