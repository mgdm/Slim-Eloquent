<?php

namespace Test\Models;

use Illuminate\Database\Eloquent\Model;
use Test\Models\Books;

class Authors extends Model {

    public function books()
    {
        return $this->hasMany('Test\\Models\\Books', 'author_id');
    }
} 