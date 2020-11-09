<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getRouteKeyName(){
        return 'category_slug';
    }

    protected $guarded = [];
}