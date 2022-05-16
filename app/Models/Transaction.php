<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'book_id', 'transaction_id','date_issued', 'date_due', 'date_returned', 'penalty', 'status'];

    protected $appends = ['days_overdue', 'penalty_fee'];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->transaction_id = 'TRANS-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
            if(empty($model->date_due)) {
                $due = Carbon::now();
                dd($due);
                $model->date_due = $due->addDays(env('BOOKS_BORROWED_TIME_LIMIT_DAYS'));
            }
            $model->save();
        });

        self::creating(function ($model) { 
            if(empty($model->getOriginal('date_due'))) {
                $due = Carbon::now();
                $model->date_due = $due->addDays(env('BOOKS_BORROWED_TIME_LIMIT_DAYS'));
            }        
        });
    }

    public function getDaysOverdueAttribute()
    {
        // $due = Carbon::createFromDate($this->date_due);
        $now = Carbon::now();
        return ($now->gt($this->date_due)) ? $this->date_due->diffInDays($now) : 0;
    }

    public function getPenaltyFeeAttribute()
    {
        if($this->days_overdue > env('BOOKS_BORROWED_TIME_LIMIT_DAYS')) {
            return env('BOOKS_PENALTIES_CHARGE_LIMIT');
        } else 
        return $this->days_overdue * env('BOOKS_PENALTIES_CHARGE_PER_DAY');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
