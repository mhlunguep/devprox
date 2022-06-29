<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Csv_import extends Model
{
    protected $fillable = ['name', 'surname', 'initials', 'age', 'birthday'];

    public function transform($data)
    {
        $csv_imports = [];
        foreach ($data as $item) {
            
            array_push ($csv_imports, 
                ['id' => $item->id,
                'name' => $item->name,
                'surname' => $item->surname,
                'initials' => $item->initials,
                'age' => $item->age,
                'birthday' => $item->birthday
            ]);
        }
        return $csv_imports;
    }
}
