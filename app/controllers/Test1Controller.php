<?php

namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Request;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\User;

class Test1Controller extends BaseController
{
    public $users;
    public $table_name='users';

    public function show()
    {

        return view('test1.create');
    }

    public function store()
    {
        if (Request::has('post')) {
            $request = Request::get('post');
            

            if (CSRFToken::verityCSRFToken($request->token)) {

                $rules = [
                    'name' => ['required' => true, 'string' => true],
                    'surname' => ['required' => true, 'string' => true],
                    'id_no' => ['required' => true, 'number' => true, 'unique' => $this->table_name,'idNumberLength' => 13],
                    'birthday' => ['required' => true]
                ];

                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                    
                if ($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    
                    return view('test1.create', [
                        'users' => $this->users, 'errors' => $errors
                    ]);
                }
 
 
                //process form data
                User::create([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'id_no' => $request->id_no,
                    'birthday' => date("d/m/Y", strtotime($request->birthday))
                ]);


                Request::refresh(); 
                return view('test1.create', [
                    'users' => $this->users, 'success' => 'User Created Successfully',
                ]);
            }

        }
        throw new \Exception('Token mismatch');
    }
}
