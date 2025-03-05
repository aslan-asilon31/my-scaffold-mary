<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRecommendation extends Model
{
  use HasFactory, HasUuids;

  protected $keyType = 'string';
  protected $table = 'category_recommendations';

  public $incrementing = false;


  protected $guarded = [];
}
