<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    // Relation on model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation on model Participant
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    // Relation on model Minutes
    public function minutes()
    {
        return $this->hasOne(Minutes::class);
    }
}
