<?php

namespace Modules\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Database\factories\BlogFactory;

class Blog extends Model
{
    protected $fillable = ['title', 'description', 'date', 'image'];

}
