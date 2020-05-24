<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Http\Resources\Contact as ContactResource;

class SearchController extends Controller
{
    //
    public function index(){

        $data = request()->validate([

            'searchTerm' => 'required'    
        ]);
        $contacts =  Contact::search($data['searchTerm'])
        // authenticated user search
        ->where('user_id',request()->user()->id)
        ->get();

        return ContactResource::collection($contacts);
    }
}
