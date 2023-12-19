<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{   
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'id';
    protected $fillable = ['judul', 'penulis', 'harga', 'tgl_terbit', 'filename', 'filepath'];

    protected $dates = ['tgl_terbit'];

    public function galleries() : HasMany
    {
        return $this->hasMany(Gallery::class);
    }
    public function photos() {
        return $this->hasMany('app\Models\Buku', 'id', 'buku_id');
    }

    public function ratings() : HasMany {
        return $this->hasMany(BukuRating::class);
    }

    public function categories() : HasMany {
        return $this->hasMany(BukuCategory::class);
    }
}
