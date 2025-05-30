<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;
  protected $guarded = [];


  public function permissions()
  {
    return $this->hasMany(Permission::class);
  }

}
