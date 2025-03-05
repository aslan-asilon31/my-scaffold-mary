<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Str;  
  
class ProductSeeder extends Seeder  
{  
    public function run()  
    {  
        // Contoh data produk  
        $products = [  
            [  
                'id' => (string) Str::uuid(),  
                'product_category_first_id' => '9d91f131-e42a-4153-8f7e-65951df0ca9b', 
                'product_brand_id' => '9d8c8235-70a3-4269-b59e-62a371e94732',
                'name' => 'Produk A',  
                'selling_price' => 100000,  
                'availability' => 'in-stock',  
                'image_url' => 'https://example.com/images/product_a.png',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'is_activated' => true,  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            [  
                'id' => (string) Str::uuid(),  
                'product_category_first_id' => '9d91f131-e42a-4153-8f7e-65951df0ca9b', 
                'product_brand_id' => '9d8c8235-70a3-4269-b59e-62a371e94732',
                
                'name' => 'Produk B',  
                'selling_price' => 150000,  
                'availability' => 'in-stock',  
                'image_url' => 'https://example.com/images/product_b.png',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'is_activated' => true,  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            [  
                'id' => (string) Str::uuid(),  
                'product_category_first_id' => '9d91f131-e42a-4153-8f7e-65951df0ca9b', 
                'product_brand_id' => '9d8c8235-70a3-4269-b59e-62a371e94732',
                
                'name' => 'Produk C',  
                'selling_price' => 200000,  
                'availability' => 'out-of-stock',  
                'image_url' => 'https://example.com/images/product_c.png',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'is_activated' => true,  
                'created_at' => now(),  
                'updated_at' => now(),  
            ],  
            // Tambahkan lebih banyak produk sesuai kebutuhan  
        ];  
  
        // Insert data ke tabel products  
        DB::table('products')->insert($products);  
    }  
}  
