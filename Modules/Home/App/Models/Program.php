<?php

namespace Modules\Home\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Home\Database\factories\ProgramFactory;

class Program extends Model
{
    protected $fillable = ['title', 'description', 'price', 'image'];

}
