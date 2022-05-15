<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'category_id', 'copies', 'isbn'];

    public function category()
    {
        return $this->belongsTo(Catgory::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
