<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Seeder;  
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Str;  
use Ramsey\Uuid\Uuid;  
use Faker\Factory as Faker; 

class CustomersTableSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     *  
     * @return void  
     */  
    public function run()  
    {  

        // Nonaktifkan foreign key checks  
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  
        
        // Hapus data yang ada di tabel customers  
        DB::table('customers')->truncate();  
  
        // Sample data  
        $customers = [  
            [  
                'id' => Str::uuid(),  

                'first_name' => 'John',  
                'last_name' => 'Doe',  
                'phone' => '1234567890',  
                'email' => 'john.doe@example.com',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'created_at' => now(),  
                'updated_at' => now(),  
                'is_activated' => true,  
            ],  
            [  
                'id' => Str::uuid(),  

                'first_name' => 'Jane',  
                'last_name' => 'Smith',  
                'phone' => '0987654321',  
                'email' => 'jane.smith@example.com',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'created_at' => now(),  
                'updated_at' => now(),  
                'is_activated' => false,  
            ],  
            [  
                'id' => Str::uuid(),  

                'first_name' => 'Alice',  
                'last_name' => 'Johnson',  
                'phone' => '1122334455',  
                'email' => 'alice.johnson@example.com',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'created_at' => now(),  
                'updated_at' => now(),  
                'is_activated' => true,  
            ],  
            [  
                'id' => Str::uuid(),  

                'first_name' => 'Bob',  
                'last_name' => 'Brown',  
                'phone' => '5544332211',  
                'email' => 'bob.brown@example.com',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'created_at' => now(),  
                'updated_at' => now(),  
                'is_activated' => false,  
            ],  
            [  
                'id' => Str::uuid(),  

                'first_name' => 'Charlie',  
                'last_name' => 'Davis',  
                'phone' => '6677889900',  
                'email' => 'charlie.davis@example.com',  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'created_at' => now(),  
                'updated_at' => now(),  
                'is_activated' => true,  
            ],  
        ];  

        $faker = Faker::create();  
  
        for ($i = 0; $i < 20; $i++) {  
            DB::table('customers')->insert([  
                'id' => Str::uuid(),  
                'first_name' => $faker->firstName,  
                'last_name' => $faker->lastName,  
                'phone' => $faker->phoneNumber,  
                'email' => $faker->unique()->safeEmail,  
                'created_by' => 'admin',  
                'updated_by' => 'admin',  
                'created_at' => now(),  
                'updated_at' => now(),  
                'is_activated' => $faker->boolean(1),  
            ]);  
        }  

  
        // Insert sample data into the customers table  
        DB::table('customers')->insert($customers);  

        // Aktifkan kembali foreign key checks  
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');  
        
    }  
}  
