<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    protected $fillable = [
        'category_name'
    ];

    function businesses(){
        return $this->hasMany(Business::class);
    }
}
