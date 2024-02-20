<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\District;

class ApplicationFormController extends Controller
{


    public function index(){

        $districts = District::get();
        return view('admin.applications-form.index',compact('districts'));
    }
}
