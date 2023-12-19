<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuCategory extends Model
{
    use HasFactory;

    protected $table = 'buku_kategori';

    protected $fillable = [
        'buku_id',
        'kategori',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

}
