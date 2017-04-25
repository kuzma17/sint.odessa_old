<?php

namespace App\Http\Controllers;

use App\News;
use App\Page;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search($query){
        $page_search = Page::search($query)->get();
        $news_search = News::search($query)->get();
       // $res = array_merge($page_search, $news_search);
        $results = json_decode( $news_search);
        return view('search', ['results'=>$results]);
    }
}
