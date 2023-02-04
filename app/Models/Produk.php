<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'desk_produk',
        'jumlah',
        'diskon',
        'harga',
        'gambar',
    ];

    public function kategori()
    {
        return $this->hasMany(Kategori::class);
    }
}
