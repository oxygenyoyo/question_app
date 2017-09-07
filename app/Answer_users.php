<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer_users extends Model
{
    protected $table = 'answer_users';

    public function guest()
    {
        return $this->hasOne('App\Guest', 'id', 'user_id');
    }
}
