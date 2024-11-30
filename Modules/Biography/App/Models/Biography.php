<?php

namespace Modules\Biography\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Biography\Database\factories\BiographyFactory;

class Biography extends Model
{
    protected $fillable = ['description'];

}
