<?php

namespace App\Models;



class Post_
{
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Muhammad Rafie Chautie",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, et magnam doloribus blanditiis qui explicabo, assumenda corporis ratione suscipit itaque, impedit laborum dolorum repudiandae ducimus atque nihil iste architecto quia reiciendis repellat esse? Sit ratione rerum amet ea nulla ut voluptatibus veritatis corrupti suscipit at numquam vel deserunt porro, nam temporibus mollitia esse libero accusantium cupiditate perspiciatis incidunt quo cum repudiandae! Quas, quaerat cum culpa officiis aperiam repellendus aspernatur impedit reiciendis? Sed possimus, dolores saepe doloremque porro totam earum at quo maxime hic dolorem deserunt inventore, voluptas ducimus. Asperiores quas eaque numquam odit, nostrum vel praesentium reiciendis magni consectetur nisi?"
        ],
        [
            "title" => "Judul Post Hani",
            "slug" => "judul-post-kedua",
            "author" => "Izzati Millah Hanifah",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus sunt dolorum delectus commodi, molestiae, quis ipsam aperiam consectetur eligendi, cupiditate quasi asperiores velit distinctio dignissimos. Nesciunt, velit enim. Ipsa dignissimos sit error eius facilis, qui harum. Facilis odit at nostrum! Sequi, veritatis veniam, amet animi molestiae perspiciatis id excepturi aut unde dolorum modi omnis reiciendis suscipit dolorem vel mollitia iure quod dolores accusamus qui corporis officiis accusantium fugit odit. Ducimus quas atque voluptatibus porro itaque voluptates molestiae voluptate asperiores earum cumque, saepe rerum recusandae unde ea temporibus possimus delectus fugiat voluptatum reiciendis magnam consequatur perspiciatis. Doloremque suscipit reprehenderit excepturi dolores! Doloremque vitae eligendi quia, accusantium aperiam asperiores cumque illo deleniti rerum, illum voluptatum excepturi consequuntur minima molestias dolor modi rem molestiae odio atque quod adipisci. Exercitationem ratione delectus necessitatibus deleniti animi quia illo magni ducimus, aspernatur distinctio! At, a ea, distinctio nihil deserunt similique recusandae aliquid consequuntur pariatur doloribus illum laboriosam laborum animi! Dolorum enim hic commodi veritatis voluptatem ipsam natus necessitatibus, ex quae? Aut assumenda accusantium at distinctio deleniti eaque voluptas ea consequuntur vel quos facere tempore nulla numquam, ut rerum sapiente veritatis! Ad aliquam corrupti, nostrum fuga soluta nemo aut sunt error esse aliquid rem reiciendis consequuntur dolore."
        ],
    ];

    //fungsi untuk mengembalikan seluruh data $blog_posts
    public static function all()
    {
        //mengubah array menjadi sebuah collection
        return collect(self::$blog_posts);
    }

    //fungsi untuk mengembalikan data blog_post berdasarkan slug
    public static function find($slug)
    {
        //ambil data $blog_post
        $posts = static::all();
        //mengambil satu daya array berdasarkan slugnya,
        //jika slugnya sama, maka tampung data post ke dalam variable ner_post 
        // $post = [];
        // foreach ($posts as $p) {
        //     if ($p["slug"] === $slug) {
        //         $post = $p;
        //     }
        // }

        //ambil semua post yang bentuknya collection dan cari slug yang sama dengan slug yang dipencet
        return $posts->firstWhere('slug', $slug);
    }
}
