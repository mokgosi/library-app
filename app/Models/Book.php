<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'category_id', 'no_of_issues', 'isbn'];

    public function category()
    {
        return $this->belongsTo(Catgory::class);
    }
}
