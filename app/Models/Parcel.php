<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'price',
        'quantity',
        'market_address',
        'comment',
        'user_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
