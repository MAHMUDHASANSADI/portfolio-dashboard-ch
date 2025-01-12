<?php

namespace Modules\BusinessCategory\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\BusinessCategory\Database\factories\BusinessCategoryFactory;
use Modules\Business\App\Models\Business;

class BusinessCategory extends Model
{
    protected $fillable = [
        'category_name'
    ];

    function businesses(){
        return $this->hasMany(Business::class);
    }
}
