<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Concerns\HasUuids;
  
class SalesCart extends Model  
{  
    use HasFactory, HasUuids;

    public function newUniqueId(): string
    {
      return (string) str()->orderedUuid();
    }
  
    protected $table = 'sales_carts';  
  
    protected $fillable = [  
        'session_id',  
        'date',  
        'created_by',  
        'updated_by',  
        'is_activated',  
    ];  
  
    public function details()  
    {  
        return $this->hasMany(SalesCartDetail::class, 'sales_cart_id');  
    }  
}  
