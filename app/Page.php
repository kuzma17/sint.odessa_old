<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Page extends Model
{
    use Eloquence;
    protected $searchableColumns = ['title', 'content'];

}
