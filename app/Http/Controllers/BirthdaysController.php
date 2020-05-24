<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Contact Resource
use App\Http\Resources\Contact;

class BirthdaysController extends Controller
{
    //if Invalid JSON was returned then we need to define the logic below

    public function index(){
        //query scope
        $contacts = request()->user()->contacts()->birthdays()->get();


        //contact resource
        return Contact::collection($contacts);
    }
}
