<?php

namespace Modules\AwardCategory\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Award\App\Models\Award;

use Modules\AwardCategory\Database\factories\AwardCategoryFactory;

class AwardCategory extends Model
{
    protected $fillable = [
        'category_name'
    ];

    function awards(){
        return $this->hasMany(Award::class);
    }
}
