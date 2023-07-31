<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    use Sluggable;


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    /**
     * variable $fillable berguna untuk memberi tahu laravel
     *  value apa saja yang boleh diisi dengan mass assignment, variable yang lain tidak boleh
     */
    // protected $fillable = ['title', 'excerpt', 'body'];

    /**
     * variable $guarded berguna untuk memberi tahu laravel
     *  variable apa saja yang tidak boleh diisi dengan mass assignment, variable yang lain boleh
     */
    protected $guarded = ['id'];
    //bikin agar setiap pemanggilan model Post maka akan membawa data category dan data author juga sehingga tidak terjadi problem N+1
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
        //jika ada value di dalam variable filters ada value search maka jalankan kode yang ada di kurung kurawal,
        //jika tidak maka kembalikan nilai false
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        //kode dibawah ini untuk mencari data sesuai dengan keyword search dan kategorinya adalah yang telah ditentukan oleh user
        $query->when($filters['category'] ?? false, function ($query, $category) {
            //melakukan join table yang mencari data posts yang sesuai dengan yang dicarin dan dia merupakan bagian dari category
            //whereHas 
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) =>
            $query->whereHas(
                'author',
                fn ($query) =>
                $query->where('username', $author)
            )
        );
    }

    public function category()
    {
        /**
         * satu post hanya punya satu category
         */
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        //satu post bisa ditulis hanya satu user
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
