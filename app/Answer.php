<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    public function choice()
    {
        return $this->belongsTo('App\Choice', 'answer_id', 'id');
    }
}
