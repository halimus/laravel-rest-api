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
        
        for ($i = 0; $i < 15; $i++) {
            DB::table('author')->insert([
                'first_name' => str_random(6),
                'last_name' => str_random(6),
                //'created_at' => date('Y-m-d H:i:s')
                //'created_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        
    }
}

