<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Post extends Model
{
    use Eloquence;
    protected $searchableColumns = ['title', 'content'];
}
