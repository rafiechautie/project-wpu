<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        Post::factory(20)->create();

        User::create([
            'name' => 'izzati millah hanifah',
            'username' => 'millah',
            'email' => 'izzati@gmail.com',
            'password' => bcrypt('123456')
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' => 'Programming',
            'slug' => 'programming'
        ]);


        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'category_id' => 2,
        //     'user_id' => 1,
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto asperiores error velit nemo modi blanditiis quibusdam ducimus eius itaque. Fugit nostrum excepturi iure labore quo neque quos, nihil architecto quaerat incidunt quod sint magni adipisci eligendi, doloribus et ipsum tempore voluptatum vel?',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto asperiores error velit nemo modi blanditiis quibusdam ducimus eius itaque. Fugit nostrum excepturi iure labore quo neque quos, nihil architecto quaerat incidunt quod sint magni adipisci eligendi, doloribus et ipsum tempore voluptatum vel? Adipisci minima iste cum perspiciatis dicta. Sapiente nihil quos, numquam tenetur tempora reiciendis at veritatis consequatur dicta assumenda distinctio ullam consectetur dolorum autem minima quis rerum adipisci praesentium nulla repellat odit, culpa veniam! Deserunt rem facilis iste iure minus repellendus beatae harum mollitia, at aperiam saepe reiciendis, optio consectetur pariatur, reprehenderit maxime! In officia rem quas consequuntur molestias quasi nam illum itaque, delectus amet sed ex, neque praesentium atque natus, iusto exercitationem temporibus incidunt laboriosam reprehenderit alias recusandae officiis optio earum? Quisquam asperiores quis et quos reiciendis placeat aut excepturi ex nisi cupiditate minus quas eligendi veritatis nulla, id velit officiis nesciunt illum facilis officia vel.</p><p> At consequuntur rerum necessitatibus magni temporibus non voluptatum distinctio? Iste placeat neque totam in excepturi, odit laudantium aliquid, non corporis temporibus doloremque accusantium sit facere officia, minima rerum vero natus fuga voluptatum ut? Omnis, odio quas aliquam quos autem cumque vitae. Quod explicabo, temporibus quis molestias praesentium qui provident! Asperiores, quo architecto.</p>'
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'category_id' => 1,
        //     'user_id' => 2,
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto asperiores error velit nemo modi blanditiis quibusdam ducimus eius itaque. Fugit nostrum excepturi iure labore quo neque quos, nihil architecto quaerat incidunt quod sint magni adipisci eligendi, doloribus et ipsum tempore voluptatum vel?',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto asperiores error velit nemo modi blanditiis quibusdam ducimus eius itaque. Fugit nostrum excepturi iure labore quo neque quos, nihil architecto quaerat incidunt quod sint magni adipisci eligendi, doloribus et ipsum tempore voluptatum vel? Adipisci minima iste cum perspiciatis dicta. Sapiente nihil quos, numquam tenetur tempora reiciendis at veritatis consequatur dicta assumenda distinctio ullam consectetur dolorum autem minima quis rerum adipisci praesentium nulla repellat odit, culpa veniam! Deserunt rem facilis iste iure minus repellendus beatae harum mollitia, at aperiam saepe reiciendis, optio consectetur pariatur, reprehenderit maxime! In officia rem quas consequuntur molestias quasi nam illum itaque, delectus amet sed ex, neque praesentium atque natus, iusto exercitationem temporibus incidunt laboriosam reprehenderit alias recusandae officiis optio earum? Quisquam asperiores quis et quos reiciendis placeat aut excepturi ex nisi cupiditate minus quas eligendi veritatis nulla, id velit officiis nesciunt illum facilis officia vel.</p><p> At consequuntur rerum necessitatibus magni temporibus non voluptatum distinctio? Iste placeat neque totam in excepturi, odit laudantium aliquid, non corporis temporibus doloremque accusantium sit facere officia, minima rerum vero natus fuga voluptatum ut? Omnis, odio quas aliquam quos autem cumque vitae. Quod explicabo, temporibus quis molestias praesentium qui provident! Asperiores, quo architecto.</p>'
        // ]);
    }
}
