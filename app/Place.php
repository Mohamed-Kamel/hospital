<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    protected $table = 'places';

    protected $guarded = ['place_id'];

    public $timestamps = false;


    public function getPlacesById($field_id)
    {
        $places = DB::table('places')
            ->join('fields_has_places', 'places.place_id', '=', 'fields_has_places.place_id')
            ->select('places.place_id', 'places.place_name')
            ->where('fields_has_places.field_id', $field_id)
            ->get()
            ->groupBy('places.place_id');
        return $places;
    }
}
