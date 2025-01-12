<?php

namespace Modules\Home\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Home\Database\factories\HeroFactory;

class Hero extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image'];
}
