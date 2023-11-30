<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuRating extends Model
{
    use HasFactory;

    protected $table = 'rating';

    protected $fillable = ['id', 'buku_id', 'rating_1_count', 'rating_2_count', 
    'rating_3_count', 'rating_4_count', 'rating_5_count'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
