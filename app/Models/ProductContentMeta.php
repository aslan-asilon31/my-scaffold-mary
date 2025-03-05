<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductContentMeta extends Model
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
      return $this->belongsTo(ProductContent::class);  
  }  

  public function metaProperty()  
  {  
      return $this->belongsTo(MetaProperty::class);  
  } 

  public function metaPropertyGroup()  
  {  
      return $this->belongsTo(MetaPropertyGroup::class);  
  } 
}
