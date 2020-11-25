<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public function addNew($input)
    {
        $check = static::where('facebook_id',$input['facebook_id'])->first();

        if(is_null($check)){
            return static::create($input);
        }

        return $check;
        
    }
}
