<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_ip',
        'request_method',
        'api_address', 
        'parameters',
        'response_parameters',
        'error_message', 
        'request_time',
        'service_processing_time'
    ];
}
