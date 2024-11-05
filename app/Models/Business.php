<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'business_category_id',
        'name',
        'description'
    ];

    function businessCategory(){
        return $this->belongsTo(BusinessCategory::class);
    }
}
