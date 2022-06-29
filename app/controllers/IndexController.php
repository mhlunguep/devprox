<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Models\User;

class IndexController extends BaseController 
{
    public function show(){
    
        return view('home');
    }   
   
}