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
        
          
            DB::table('author')->insert([
                'language_id' => 1, 'language_name' => 'English', 'language_code' => 'en'
            ]);
            
       
        
    }
}

