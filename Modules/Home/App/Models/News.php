<?php

namespace Modules\Home\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Home\Database\factories\NewsFactory;

class News extends Model
{
    protected $fillable = ['title', 'description', 'date', 'image'];

}
