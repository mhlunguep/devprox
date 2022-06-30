<?php
use eftec\bladeone\BladeOne;

function view($path, array $data = [])
{
    $views = __DIR__ . '/../../resources/views';
    $cache = __DIR__ . '/../../bootstrap/cache';
    
    $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
    echo $blade->run($path, $data); // it calls /views/home.blade.php
}

function random_data($number)
{
    $data =[];
    // PHP array containing first names
    $names = ['Phumlani', 'Simbonge', 'Melokuhle', 'Sphiwe', 'Nosisa', 'Wayne', 'Ethan', 
    'Jonathan', 'Samantha', 'Ryan', 'Tiras', 'Asiphe', 'John', 'Cynthia',
    'Trushka', 'Zanele', 'Michelle', 'Zoey', 'Christopher', 'Sarah'];
        
    // PHP array containing surnames
    $surnames = ['Smith', 'Soni', 'Mhlungu', 'Mpithi', 'Sithole', 'Sandaman', 'Ross',
    'Simpson', 'Walker', 'Cunningham', 'Zwane', 'Khuzwayo', 'Zuma',
    'Johnson', 'Ramaphosa', 'Mercado', 'Ronaldo', 'Messi', 'Peltier', 'Sellers'];
    
    for($i = 1; $i <= $number; $i++){
        // Generate a random name
        $random_name = $names[mt_rand(0, sizeof($names) - 1)];
          
        //Get initials.
        $initials = substr($random_name, 0, 1);
        
        // Generate a random surname
        $random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];
        
        //Start point of our date range.
        $start = strtotime("1900-01-01");

        $currentDate = strtotime("2022-06-28");
        //Custom range.
        $rand_date = mt_rand($start, $currentDate);
        $birth_date = date('Y-m-d', $rand_date);
        $age = date_diff(date_create(date("Y-m-d")), date_create($birth_date));
        
        // Combine them together
        $data[$i] = $i . ",". $random_name . "," . $random_surname ."," . $initials . "," . $age->format("%y") . "," . date("Y-m-d", $rand_date); 
        
    }
    return $data;    
}


