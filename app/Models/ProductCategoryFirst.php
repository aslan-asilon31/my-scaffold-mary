<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryFirst extends Model
{
  use HasFactory, HasUuids;

  public function newUniqueId(): string
  {
    return (string) str()->orderedUuid();
  }

  protected $keyType = 'string';
  public $incrementing = false;

  protected $guarded = [];

  public function product()
  {
    return $this->hasMany(Product::class, 'product_category_first_id');
  }


  
  public function productCategorySecond()  
  {  
      return $this->belongsTo(ProductCategorySecond::class, 'product_category_second_id'); 
  }


}
