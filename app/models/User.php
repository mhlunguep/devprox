<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'surname', 'id_no', 'birthday'];

    public function transform($data)
    {
        $users = [];
        foreach ($data as $item) {

            array_push ($users, 
                ['id' => $item->id,
                'name' => $item->name,
                'surname' => $item->surname,
                'id_no' => $item->id_no,
                'birthday' => $item->birthday
            ]);
        }
        return $users;
    }
}
