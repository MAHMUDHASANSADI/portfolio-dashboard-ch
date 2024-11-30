<?php

namespace Modules\Video\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Video\Database\factories\VideoFactory;

class Video extends Model
{
    protected $fillable = ['title', 'description','url'];
}
