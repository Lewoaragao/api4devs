<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'height',
        'sex',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}