<?php

namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Request;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Csv_import;

class Test2Controller extends BaseController
{
    public $csv_imports;
    public $table_name='csv_imports';
    public $data;

    public function show()
    {

        return view('test2.csvform');
    }

    public function generate_csv()
    {
        if (Request::has('post')) {
            $request = Request::get('post');
            

            if (CSRFToken::verityCSRFToken($request->token)) {

                $rules = [
                    'number' => ['required' => true, 'number' => true]
                ];

                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                    
                if ($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    
                    return view('test2.csvform', [
                         'errors' => $errors
                    ]);
                }
 
                 random_data($request->number); 
    
                return view('test2.csvform', [
                    'success' => 'CSV file genareted'
                ]);
            }

        }
        throw new \Exception('Token mismatch');
    }
    public function store()
    {
        if (Request::has('post')) {
            $request = Request::get('post');
            

            if (CSRFToken::verityCSRFToken($request->token)) {

                $rules = [
                    'csvfile' => ['required' => true, 'string' => true, 'unique' => $this->table_name]
                ];

                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                    
                if ($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    
                    return view('users.create', [
                        'users' => $this->users, 'errors' => $errors
                    ]);
                }
 
                $file = $_FILES['csvfile']['temp_name'];
                $handle = fopen($file, "r");

                $i=0;
                while($cont=fgetcsv($handle, 1000, ",")!==false)
                {
                    if($i === 0){
                        $id = cont[0];
                        $name = cont[1];
                        $surname = cont[2];
                        $initials = cont[3];
                        $age = cont[4];
                        $birthday = cont[5];

                        //process form data
                        Csv_import::schema()->create('csv_imports', function ($table) {
                            $table->increments('id');
                            $table->string('name');
                            $table->string('surname');
                            $table->string('initials');
                            $table->string('age');
                            $table->string('birthday');
                            $table->timestamps();
                        });
                    }else{
                        Csv_import::create([
                            'id' => $request->id,
                            'name' => $request->name,
                            'surname' => $request->surname,
                            'initials' => $request->initials,
                            'age' => $request->age,
                            'birthday' => $request->birthday
                        ]);
                    }
                    $i;
                }
                
                
            
                Request::refresh(); 
                return view('users.create', [
                    'users' => $this->users, 'success' => 'User Created Successfully',
                ]);
            }

        }
        throw new \Exception('Token mismatch');
    }
}
