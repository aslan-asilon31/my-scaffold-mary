<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Str;  
  
class ProductSeeder extends Seeder  
{  
    public function run()  
    {  
        $products = [  
            // Contoh data produk carlton mesin sostel
            [  
                'id' => (string) Str::uuid(),  
                'product_category_first_id' => '9e02b2a0-a8a9-4c4a-a4ee-b07362ec9738', 
                'product_brand_id' => '9d8c8235-70a3-4269-b59e-62a371e9456',
                'name' => 'Mesin Sosis Telur Mesin Sostel GAS 10 Lubang Egg Roll Hotdog Sausage STG-10',  
                'selling_price' => 100000,  
                'discount_persentage' => 0,  
                'discount_value' => 0,  
                'nett_price' => 0,  
                'weight' => 0,  
                'rating' => 0,  
                'sold_qty' => 0,  
                'availability' => 'in-stock',  
                'image_url' => '',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'is_new' => '1',  
                'is_new' => '1',  
                'is_activated' => true,  
            ],  
            [  
                'id' => (string) Str::uuid(),  
                'product_category_first_id' => '9e02b2a0-a8a9-4c4a-a4ee-b07362ec9738', 
                'product_brand_id' => '9d8c8235-70a3-4269-b59e-62a371e9456',
                'name' => 'Mesin Sosis Telur Mesin Sostel Listrik 4 Lubang Egg Roll Hotdog Sausage STE-4',  
                'selling_price' => 100000,  
                'discount_persentage' => 0,  
                'discount_value' => 0,  
                'nett_price' => 0,  
                'weight' => 0,  
                'rating' => 0,  
                'sold_qty' => 0,  
                'availability' => 'in-stock',  
                'image_url' => '',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'is_new' => '1',  
                'is_new' => '1',  
                'is_activated' => true,  
            ],  
            [  
                'id' => (string) Str::uuid(),  
                'product_category_first_id' => '9e02b2a0-a8a9-4c4a-a4ee-b07362ec9738', 
                'product_brand_id' => '9d8c8235-70a3-4269-b59e-62a371e9456',
                'name' => 'Mesin Sosis Telur Mesin Sostel Listrik 2 Lubang Egg Roll Hotdog Sausage STE-2',  
                'selling_price' => 100000,  
                'discount_persentage' => 0,  
                'discount_value' => 0,  
                'nett_price' => 0,  
                'weight' => 0,  
                'rating' => 0,  
                'sold_qty' => 0,  
                'availability' => 'in-stock',  
                'image_url' => '',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'is_new' => '1',  
                'is_new' => '1',  
                'is_activated' => true,  
            ],  
            [  
                'id' => (string) Str::uuid(),  
                'product_category_first_id' => '9e02b2a0-a8a9-4c4a-a4ee-b07362ec9738', 
                'product_brand_id' => '9d8c8235-70a3-4269-b59e-62a371e9456',
                'name' => 'Mesin Sostel Listrik 10 Lubang - Pembuat Sosis Telur Otomatis, Hemat Energi, Cepat & Praktis STE-10',  
                'selling_price' => 100000,  
                'discount_persentage' => 0,  
                'discount_value' => 0,  
                'nett_price' => 0,  
                'weight' => 0,  
                'rating' => 0,  
                'sold_qty' => 0,  
                'availability' => 'in-stock',  
                'image_url' => '',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'is_new' => '1',  
                'is_new' => '1',  
                'is_activated' => true,  
            ],  
            
            
        ];  
  
        // Insert data ke tabel products  
        DB::table('products')->insert($products);  
    }  
}  
