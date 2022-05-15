<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'book_id', 'transaction_id','date_issued', 'date_due', 'date_returned', 'penalty', 'status'];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->transaction_id = 'TRANS-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
            $model->save();
        });
    }
}
