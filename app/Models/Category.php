<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // mengatur data pada tabel category
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [''];

    // membuat fungsi untuk join ke tabel produk
    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
