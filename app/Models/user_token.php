<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_token extends Model
{
    use HasFactory;
    protected $fillable = [
        'telephone',
        'code',
    ];
}
