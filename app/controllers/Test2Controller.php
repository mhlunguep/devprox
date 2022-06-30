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
                        
                    //The SQL query.
                    $sql = "SELECT COUNT(*) AS num FROM `csv_import` WHERE id_no = :id_no";

                    //Prepare the SQL statement.
                    $stmt = $pdo->prepare($sql);
                       
                    //Bind our id_no value to the :id_no parameter.
                    $stmt->bindValue(':id_no', $getData[0]);

                    //Execute the statement.
                    $stmt->execute();
                    
                    //Fetch the row / result.
                    $row = $stmt->fetch();

                    //If num is bigger than 0, the id_no already exists.
                    if($row['num'] > 0){

                        $sql = "UPDATE csv_import SET name=:name, surname=:surname, initials=:initials, 
                        age=:age, birthday=:birthday WHERE id_no=:id_no";
                        $stmt= $pdo->prepare($sql);
                        $stmt->bindValue(':id_no', $getData[0]);
                        $stmt->bindValue(':name', $getData[1]);
                        $stmt->bindValue(':surname', $getData[2]);
                        $stmt->bindValue(':initials', $getData[3]);
                        $stmt->bindValue(':age', $getData[4]);
                        $stmt->bindValue(':birthday', $getData[5]);
                        $stmt->execute();
                        $rows = $stmt->rowCount();

                    } else{
                        //Insert data
                        $stmt = "INSERT INTO `csv_import` (id_no, name, surname, initials, age, birthday) 
                        VALUES ('$getData[0]', '$getData[1]', '$getData[2]','$getData[3]','$getData[4]','$getData[5]')";
                        $stmt = $pdo->exec($stmt);
                        $rows .= $stmt->rowCount();    
                    }
                    
                    }
                    Request::refresh();
                 
                 return view('test2.csvform', [
                     'success' => 'Csv file imported successfully with '.$rows. ' rows affected'
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
