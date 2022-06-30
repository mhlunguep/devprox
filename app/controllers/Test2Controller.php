<?php

namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Request;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Pdo;

class Test2Controller extends BaseController
{
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
                    'number' => ['required' => true, 'number' => true],
                ];

                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);

                if ($validate->hasError()) {
                    $errors = $validate->getErrorMessages();

                    return view('test2.csvform', [
                        'errors' => $errors,
                    ]);
                }

                // call a function that returns random data array
                $data = random_data($request->number + 1);

                $count = 0;

                // check and remove duplicates
                do {
                    if (count($data) === count(array_unique($data))) {

                        $headers = array("Id", "Name", "Surname", "Initials", "Age", "Birthday");

                        // Create/open a file in write mode ('w')
                        $fp = fopen('output/output.csv', 'w');
                        //Create the headers
                        fputcsv($fp, $headers);

                        // Loop through file pointer and a line
                        foreach ($data as $fields) {
                            fputcsv($fp, explode(",", $fields));
                        }

                        fclose($fp);
                    } else {
                        unset($data);
                        $count++;
                        $data = random_data($request->number + 1);
                    }
                } while ($count > 0);

                return view('test2.csvform', [
                    'success' => 'CSV file generated under public/output/output.csv',
                ]);
            }

        }
        throw new \Exception('Token mismatch');
    }

    public function import_csv()
    {
        if (Request::has('post')) {
            $request = Request::get('post');

            if (CSRFToken::verityCSRFToken($request->token)) {

                $rules = [
                    'file' => ['required' => true],
                ];

                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);

                if ($validate->hasError()) {
                    $errors = $validate->getErrorMessages();

                    return view('test2.csvform', [
                        'errors' => $errors,
                    ]);
                }

                // Allowed types
                $fileType = array(
                    'text/x-comma-separated-values',
                    'text/comma-separated-values',
                    'application/octet-stream',
                    'application/vnd.ms-excel',
                    'application/x-csv',
                    'text/x-csv',
                    'text/csv',
                    'application/csv',
                    'application/excel',
                    'application/vnd.msexcel',
                    'text/plain',
                );

                

                // Validate whether selected file is a CSV file
                if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileType)) {
                    
                    $pdo = Pdo::get_connection();
                    
                    // Open uploaded CSV file with read-only mode
                    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                    // Skip the first line
                    fgetcsv($csvFile);

                    // Parse data from CSV file line by line
                    while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
                        
                       //Insert data
                        $alldata = "INSERT INTO `csv_import` (id_no, name, surname, initials, age, birthday) 
                        VALUES ('$getData[0]', '$getData[1]', '$getData[2]','$getData[3]','$getData[4]','$getData[5]')";
                        $pdo->exec($alldata);
                    }
                    $rowid = $pdo->lastInsertId();
                    Request::refresh();
                 
                 return view('test2.csvform', [
                     'success' => 'Csv file imported Successfully with '.$rowid. ' rows'
                 ]);
                
                    // Close opened CSV file
                    fclose($csvFile);

                } else {
                    return view('test2.csvform', [
                         'errors' => 'Please attach valid csv file'
                    ]);
                }
               
            }

        }
        throw new \Exception('Token mismatch');
    }
}