<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'id_number', 'date_of_birth', 'home_address'];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
