<?php

namespace Modules\Business\App\Models;
use Modules\BusinessCategory\App\Models\BusinessCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Business\Database\factories\BusinessFactory;


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
