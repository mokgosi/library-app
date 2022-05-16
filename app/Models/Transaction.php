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
            $model->save();
        });
    }

    public function getDaysOverdueAttribute()
    {
        $issued = Carbon::createFromDate($this->date_issued);
        $due = Carbon::createFromDate($this->date_due);

        return $issued->diffInDays($due);
    }

    public function getPenaltyFeeAttribute()
    {
        if($this->days_overdue > env('BOOKS_BORROWED_TIME_LIMIT_DAYS')) {
            return env('BOOKS_PENALTIES_CHARGE_LIMIT');
        } 
        return $this->days_overdue * env('BOOKS_PENALTIES_CHARGE_PER_DAY');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
