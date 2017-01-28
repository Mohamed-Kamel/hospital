<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Doctor extends Model
{
    protected $table = 'doctors';
    
    protected $gaurded = ['doctor_id'];
    
    public $timestamps = false;
    
    
    
    
    public function getDoctorsByFieldIdAndPlaceID($field_id, $place_id){
        $doctors = DB::table('doctors')
            ->join('fields_has_places',
                   ['doctors.place_id' => 'fields_has_places.place_id',
                    'doctors.field_id'=>'fields_has_places.field_id'], '=')
            ->select('doctors.doctor_id', 'doctors.doctor_name')
            ->where(['doctors.field_id' => $field_id, 'doctors.place_id' => $place_id], '=', 'and')
            ->get()
            ->groupBy('doctors.doctor_id');
        //Nice Work what you made    
        return $doctors;
    }
}
