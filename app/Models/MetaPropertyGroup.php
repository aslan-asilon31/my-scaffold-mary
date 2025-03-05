<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaPropertyGroup extends Model
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
