<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    use HasFactory;

    protected $table = 'user_favorite';

    protected $fillable = ['buku_id', 'user_id'];

    public function userFavorite()  
    {
        return $this->belongsTo(User::class);
    }
}
