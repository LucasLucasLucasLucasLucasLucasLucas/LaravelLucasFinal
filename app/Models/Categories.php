<?php

namespace App\Models;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //soft deletes are quite nice. you can retrieve the deleted value by going into DB view and setting it to null to "undelete" it.
    //only issue is that it locks all other categories from being named a deleted value.
    use softDeletes;

    protected $table = "categories";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
