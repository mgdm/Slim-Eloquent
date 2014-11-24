<?php

namespace Test\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model {

    public function authors()
    {
        return $this->belongsTo('Test\\Models\\Authors', 'author_id');
    }
}