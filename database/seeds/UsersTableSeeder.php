<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        //DB::table('users')->delete(); //delete all records
        App\Models\Users::truncate();
        
        for ($i = 0; $i < 20; $i++) {
            
            $first_name = str_random(6);
            $last_name = str_random(6);
            
            DB::table('users')->insert([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => mt_rand(200,999).'-'.mt_rand(100,999).'-'.mt_rand(1000,9999),
                'email' => strtolower($first_name . '@domain.com'),
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
