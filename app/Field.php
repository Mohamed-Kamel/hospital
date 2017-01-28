<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{

    /**
     * @var Fields table
     */
    protected $table = 'fields';

    /**
     * @var Can't insert or update field_id
     */
    protected $guarded = ['field_id'];


    /**
     * @var Don't use timestamps if you use migrations
     */
    public $timestamps = false;

    public function getAllFields(){
        return Field::all();
    }
}
