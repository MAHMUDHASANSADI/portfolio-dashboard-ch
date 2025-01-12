<?php

namespace Modules\Award\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Award\Database\factories\AwardFactory;
use Modules\AwardCategory\App\Models\AwardCategory;

class Award extends Model
{
    protected $fillable = [
        'award_category_id',
        'name',
        'description'
    ];

    function awardCategory(){
        return $this->belongsTo(AwardCategory::class);
    }
}
