<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galeri';
    protected $fillable = ['id', 'nama_galeri', 'path', 'foto', 'buku_id'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
