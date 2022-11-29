<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // mengatur data pada tabel produk
    use HasFactory;
    protected $table = 'produks';
    protected $guarded = [''];

    // membuat fungsi join ke tabel category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // membuat fungsi join ke tabel post
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
