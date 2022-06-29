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
        $birthdayMatchId_error = [];
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

                $id_num_array = str_split($request->id_no);
                $remove_dashes = str_replace('-','',$request->birthday);  
                $birthday = str_split($remove_dashes);
                
                if($request->birthday == 13 && !empty($request->birthday)){
                    $new_birthday = $birthday[2] . $birthday[3] . $birthday[4] . $birthday[5] . $birthday[6] . $birthday[7];
                    $first_six_id_numbers = $id_num_array[0] . $id_num_array[1] . $id_num_array[2] . $id_num_array[3] . $id_num_array[4] . $id_num_array[5];    
                    
                    if ($new_birthday !== $first_six_id_numbers){
                        
                        $birthdayMatchId_error["Error"] = ['The birthday field does not match id number'];
                    }
                }
            
                if ($validate->hasError() || count($birthdayMatchId_error)) {
                 
                    if ($validate->hasError()) {
                    $response = $validate->getErrorMessages();
                    count($birthdayMatchId_error) ? $errors = array_merge($response, $birthdayMatchId_error) : $errors = $response;
                    
                    return view('test1.create', [
                        'users' => $this->users, 'errors' => $errors
                    ]);
                }
 
                    $response = $validate->getErrorMessages();
                    count($birthdayMatchId_error) ? $errors = array_merge($response, $birthdayMatchId_error) : $errors = $response;
                   
                    return view('test1.create', [
                        'users' => $this->users, 'errors' => $errors
                    ]);
                }
 
                //process form data
                User::create([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'id_no' => $request->id_no,
                    'birthday' => $request->birthday,
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
