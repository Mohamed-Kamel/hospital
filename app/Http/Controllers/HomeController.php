<?php

namespace App\Http\Controllers;

use App\Place;
use App\Field;
use App\Doctor;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    private $field;
    private $place;
    private $doctor;

    public function __construct(Field $field, Place $place, Doctor $doctor)
    {
        $this->field = $field;
        $this->place = $place;
        $this->doctor = $doctor;
    }

    

    /**
     * Get All Available Fields
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFields()
    {
        $fields = $this->field->getAllFields();
        return view('user.index', compact('fields'));
    }


    
    
    public function getPlaces(Request $request)
    {
        //filter the request
        $input = $request->all();
        $places = $this->place->getPlacesById(1);   
        $result = array();
        foreach($places as $place){
            $result[] = $place[0];
        }
        return response()->json($result, 200);
    }
    
    
    public function getDoctors(Request $request){
        //filter the request
        $input = $request->all();
        $doctors = $this->doctor->getDoctorsByFieldIdAndPlaceID(1, 1);
        $result = array();
        foreach($doctors as $doctor){
            $result[] = $doctor[0];
        }
        
        return response()->json($result, 200);
    }
    
    
    
    public function showDatePicker(Request $request){
        //filter the request
        $input = $request->all();
        echo '<pre>';
        return var_dump($input);
    }
}
