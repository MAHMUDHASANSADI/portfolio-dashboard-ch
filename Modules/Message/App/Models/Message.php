<?php

namespace Modules\Message\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Message\Database\factories\MessageFactory;

class Message extends Model
{
    protected $fillable = [
        'name', 
        'phone',
        'email',
        'subject',
        'message',
    ];
}
