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
        //App\Models\Book::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Author::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        for ($i = 1; $i < 20; $i++) {
            DB::table('author')->insert([
                'author_id' => $i,
                'first_name' => str_random(6),
                'last_name' => str_random(6),
                //'created_at' => date('Y-m-d H:i:s')
                //'created_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        
    }
}

