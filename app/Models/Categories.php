<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = "categories";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
