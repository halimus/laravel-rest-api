<?php

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('book')->delete(); //delete all records
        App\Models\Book::truncate();
        
        DB::table('book')->insert([
            [
                'book_id' => 1, 
                'title' => 'PHP for the Web: Visual QuickStart Guide', 
                'description' => null, 
                'ISBN' => '0134291255', 
                'pages' => '528', 
                'published_at' => '2016-07-09', 
                'created_at' => time(), 
                'language_id' => 1, 
                'author_id' => 1
            ],
            [
                'book_id' => 2, 
                'title' => 'HTML and CSS: Visual QuickStart Guide', 
                'description' => null, 
                'ISBN' => '0321928830', 
                'pages' => '576', 
                'published_at' => '2013-08-19', 
                'created_at' => time(), 
                'language_id' => 1, 
                'author_id' => 2
            ],
            [
                'book_id' => 3, 
                'title' => 'Laravel and AngularJS', 
                'description' => null, 
                'ISBN' => 'B01H0YVS18', 
                'pages' => '314', 
                'published_at' => '2016-06-12', 
                'created_at' => time(), 
                'language_id' => 1, 
                'author_id' => 1
            ],
            [
                'book_id' => 4, 
                'title' => 'Restful Web API Design with Node.Js', 
                'description' => null, 
                'ISBN' => '1783985860', 
                'pages' => '152', 
                'published_at' => '2015-11-23', 
                'created_at' => time(), 
                'language_id' => 1, 
                'author_id' => 3
            ],
            [
                'book_id' => 4, 
                'title' => 'Programmer en JavaScript', 
                'description' => null, 
                'ISBN' => '1507139721', 
                'pages' => '45', 
                'published_at' => '2012-10-04', 
                'created_at' => time(), 
                'language_id' => 34, 
                'author_id' => 5
            ],
            [
                'book_id' => 5, 
                'title' => 'Démarrer Avec Android Studio', 
                'description' => null, 
                'ISBN' => '1633395006', 
                'pages' => '293', 
                'published_at' => '2016-04-06', 
                'created_at' => time(), 
                'language_id' => 34, 
                'author_id' => 5
            ],
            [
                'book_id' => 6, 
                'title' => 'Curso de Programación Java', 
                'description' => null, 
                'ISBN' => '1507571178', 
                'pages' => '508', 
                'published_at' => '2016-02-20', 
                'created_at' => time(), 
                'language_id' => 27, 
                'author_id' => 6
            ],
            [
                'book_id' => 6, 
                'title' => 'كتاب الأذكياء', 
                'description' => null, 
                'ISBN' => '9953881146', 
                'pages' => '224', 
                'published_at' => '2010-02-20', 
                'created_at' => time(), 
                'language_id' => 6, 
                'author_id' => 7
            ],
            [
                'book_id' => 7, 
                'title' => 'The Laravel Survival Guide', 
                'description' => null, 
                'ISBN' => '1783985860', 
                'pages' => '119', 
                'published_at' => '2016-02-20', 
                'created_at' => time(), 
                'language_id' => 1, 
                'author_id' => 1
            ],
            [
                'book_id' => 8, 
                'title' => 'سلسلة إتقان لتعليم اللغة العربية كتاب الطالب', 
                'description' => null, 
                'ISBN' => '9957553747', 
                'pages' => '224', 
                'published_at' => '2015-02-20', 
                'created_at' => time(), 
                'language_id' => 6, 
                'author_id' => 7
            ],
            [
                'book_id' => 9, 
                'title' => 'Learning React', 
                'description' => null, 
                'ISBN' => 'B01N5GPFM2', 
                'pages' => '240', 
                'published_at' => '2016-12-27', 
                'created_at' => time(), 
                'language_id' => 1, 
                'author_id' => 9
            ],
            [
                'book_id' => 10, 
                'title' => 'Typescript Jumpstart', 
                'description' => null, 
                'ISBN' => 'B072TQTBKG', 
                'pages' => '270', 
                'published_at' => '2017-06-17', 
                'created_at' => time(), 
                'language_id' => 1, 
                'author_id' => 9
            ],
           
        ]);
    }
}
