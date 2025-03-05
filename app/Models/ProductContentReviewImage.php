<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductContentReviewImage extends Model
{
  use \Illuminate\Database\Eloquent\Factories\HasFactory;
  use \Illuminate\Database\Eloquent\Concerns\HasUuids;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'name',
    'product_content_id',
    'image_url',
    'ordinal',
    'is_activated',
  ];
}
