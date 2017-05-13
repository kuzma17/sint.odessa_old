<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class News extends Model
{
    use Eloquence;
    protected $table = 'news';
    protected $searchableColumns = ['title', 'content'];

    public static function count(){
        return Settings::find(1)->count_news;
    }

}
