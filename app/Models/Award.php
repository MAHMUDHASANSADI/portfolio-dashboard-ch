<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

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
