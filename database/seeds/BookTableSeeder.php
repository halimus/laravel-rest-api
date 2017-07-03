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
                'title' => 'PHP for the Web: Visual QuickStart Guide', 
                'slug' => 'php-for-the-web-visual-quickstart-guide', 
                'description' => null, 
                'ISBN' => '0134291255', 
                'pages' => '528', 
                'published_at' => '2016-07-09', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 1, 
                'author_id' => 1
            ],
            [ 
                'title' => 'HTML and CSS: Visual QuickStart Guide', 
                'slug' => 'html-and-css-visual-quickstart-guide', 
                'description' => null, 
                'ISBN' => '0321928830', 
                'pages' => '576', 
                'published_at' => '2013-08-19', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 1, 
                'author_id' => 2
            ],
            [
                'title' => 'Laravel and AngularJS', 
                'slug' => 'laravel-and-angularjs', 
                'description' => null, 
                'ISBN' => 'B01H0YVS18', 
                'pages' => '314', 
                'published_at' => '2016-06-12', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 1, 
                'author_id' => 1
            ],
            [ 
                'title' => 'Restful Web API Design with Node.Js', 
                'slug' => 'restful-web-api-design-with-nodejs', 
                'description' => null, 
                'ISBN' => '1783985860', 
                'pages' => '152', 
                'published_at' => '2015-11-23', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 1, 
                'author_id' => 3
            ],
            [
                'title' => 'Programmer en JavaScript', 
                'slug' => 'programmer-en-javascript', 
                'description' => null, 
                'ISBN' => '1507139721', 
                'pages' => '45', 
                'published_at' => '2012-10-04', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 34, 
                'author_id' => 5
            ],
            [ 
                'title' => 'Démarrer Avec Android Studio', 
                'slug' => 'demarrer-avec-android-studio', 
                'description' => null, 
                'ISBN' => '1633395006', 
                'pages' => '293', 
                'published_at' => '2016-04-06', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 34, 
                'author_id' => 5
            ],
            [
                'title' => 'Curso de Programación Java', 
                'slug' => 'curso-de-programacion-java', 
                'description' => null, 
                'ISBN' => '1507571178', 
                'pages' => '508', 
                'published_at' => '2016-02-20', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 27, 
                'author_id' => 6
            ],
            [
                'title' => 'كتاب الأذكياء', 
                'slug' => null, 
                'description' => null, 
                'ISBN' => '9953881146', 
                'pages' => '224', 
                'published_at' => '2010-02-20', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 6, 
                'author_id' => 7
            ],
            [
                'title' => 'The Laravel Survival Guide', 
                'slug' => 'the-laravel-survival-guide', 
                'description' => null, 
                'ISBN' => '1783985860', 
                'pages' => '119', 
                'published_at' => '2016-02-20', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 1, 
                'author_id' => 1
            ],
            [
                'title' => 'سلسلة إتقان لتعليم اللغة العربية كتاب الطالب', 
                'slug' => null, 
                'description' => null, 
                'ISBN' => '9957553747', 
                'pages' => '224', 
                'published_at' => '2015-02-20', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 6, 
                'author_id' => 7
            ],
            [ 
                'title' => 'Learning React', 
                'slug' => 'learning-react', 
                'description' => null, 
                'ISBN' => 'B01N5GPFM2', 
                'pages' => '240', 
                'published_at' => '2016-12-27', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 1, 
                'author_id' => 9
            ],
            [
                'title' => 'Typescript Jumpstart', 
                'slug' => 'typescript-jumpstart', 
                'description' => null, 
                'ISBN' => 'B072TQTBKG', 
                'pages' => '270', 
                'published_at' => '2017-06-17', 
                'created_at' => date('Y-m-d H:i:s'), 
                'language_id' => 1, 
                'author_id' => 9
            ],
           
        ]);
    }
}
