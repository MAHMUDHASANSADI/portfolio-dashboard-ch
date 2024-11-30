<?php

namespace Modules\Home\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Home\Database\factories\GalleryFactory;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = ['image'];
}
