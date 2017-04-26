<?php

namespace App\Http\Controllers;

use App\News;
use App\Page;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search($query){
        $page = json_decode(Page::search($query)->get());

        $news = json_decode(News::search($query)->get());
        //$url_hews = 'news/'.$news->id;

        //echo $url_hews;
        //$news['url'] = $url_hews;

        var_dump($news);

        //$post = json_decode(Post::search($query)->get());
        //$url_post = 'news/'.$post->id;
        //$post['url'] = $url_post;

       // $res = array_merge($page_search, $news_search);
        //$results = json_decode( $news_search);

        $results = array_merge(
            $page,
            $news
           // $post
        );

        return view('search', ['results'=>$results]);
    }
}
