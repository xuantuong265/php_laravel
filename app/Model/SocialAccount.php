<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];
    protected $table      = 'tbl_SocialAccount';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
