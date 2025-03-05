<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory, HasUuids;

  public function newUniqueId(): string
  {
    return (string) str()->orderedUuid();
  }

  protected $keyType = 'string';
  public $incrementing = false;

  protected $guarded = [];

  public function productContent()
  {
    return $this->hasMany(ProductContent::class);
  }

  public function productCategoryFirst()  
  {  
      return $this->belongsTo(ProductCategoryFirst::class, 'product_category_first_id'); 
  }

  public function productBrand()  
  {  
      return $this->belongsTo(ProductBrand::class, 'product_brand_id');
  }

  
}
