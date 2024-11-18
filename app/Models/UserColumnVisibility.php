<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserColumnVisibility extends Model
{
    protected $fillable = [
        'user_id', 
        'url',
        'columns'
    ];
}
