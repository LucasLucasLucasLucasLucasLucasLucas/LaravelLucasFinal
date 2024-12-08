<?php

namespace App\Models;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use softDeletes;

    protected $table = "items";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function categories() {
        return $this->hasOne('App\Models\Categories', 'id', 'category_id');
    }
}
