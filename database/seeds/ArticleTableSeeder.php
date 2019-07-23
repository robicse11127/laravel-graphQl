<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Article::truncate();
        \App\Article::unguard();

        $faker = \Faker\Factory::create();

        \App\User::all()->each(function ($user) use ($faker) {
            foreach (range(1, 5) as $i) {
                \App\Article::create([
                    'user_id' => $user->id,
                    'title'   => $faker->sentence,
                    'content' => $faker->paragraphs(3, true),
                ]);
            }
        });
    }
}
