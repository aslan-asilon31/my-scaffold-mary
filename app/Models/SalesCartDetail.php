<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SalesCartDetail extends Model  
{  
    use HasFactory, HasUuids;

    public function newUniqueId(): string
    {
      return (string) str()->orderedUuid();
    }
  
    protected $keyType = 'string';
    public $incrementing = false;
  
    protected $guarded = [];
    
  
    protected $table = 'sales_cart_detail';  
  
    protected $fillable = [  
        'sales_cart_id',  
        'product_id',  
        'selling_price',  
        'discount_persentage',  
        'discount_value',  
        'nett_price',  
        'qty',  
        'amount',  
        'weight',  
        'subtotal_weight',  
        'created_by',  
        'updated_by',  
    ];  
  
    public function product()  
    {  
        return $this->belongsTo(Product::class, 'product_id');  
    }  
  
    public function salesCart()  
    {  
        return $this->belongsTo(SalesCart::class, 'sales_cart_id');  
    }  
}  
