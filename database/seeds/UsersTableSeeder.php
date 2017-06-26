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

        DB::table('users')->delete(); //delete all records
        
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'first_name' => str_random(10),
                'last_name' => str_random(10),
                'phone' => 'XXXXXXXX',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'colaborator'
            ]);
        }
    }

}
