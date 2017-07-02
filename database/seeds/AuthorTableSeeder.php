<?php

use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('author')->delete(); //delete all records
        App\Models\Author::truncate();
        
        for ($i = 0; $i < 13; $i++) {    
            $first_name = str_random(6);
            $last_name = str_random(6);
            
            DB::table('users')->insert([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => mt_rand(200,999).'-'.mt_rand(100,999).'-'.mt_rand(1000,9999),
                'email' => strtolower($first_name . '@gmail.com'),
                'password' => bcrypt('1234'),
                'ip_address' => mt_rand(0,255).'.'.mt_rand(0,255).'.'.mt_rand(0,255).'.'.mt_rand(0,255),
                'role' => 'colaborator',
                //'created_at' => date('Y-m-d H:i:s')
                //'created_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
            
        }
        
    }
}
