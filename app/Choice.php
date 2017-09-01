<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $table = 'choices';

    public function answer()
    {
        return $this->hasOne('App\Answer', 'id', 'answer_id');
    }
}
