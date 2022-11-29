<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // mengatur data pada tabel post
    use HasFactory;
    protected $table = 'posts';
    protected $guarded = [''];

    // membuat fungsi untuk join dengan tabel produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
