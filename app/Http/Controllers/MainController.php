<?php
namespace App\Http\Controllers;
use  App\News;

class MainController extends Controller {

    public function __construct()
    {

    }

    public function index()
    {
        $el = News::all();

        foreach ($el as &$value) {
            $short_content = explode(' ', $value->content);
            $short_content = array_slice($short_content, 0, 10);
            $value->content = implode($short_content, ' ') . '...';
        }

        return view('pages.index', ['news' => $el]);
    }

    public function addNews()
    {
        return view('pages.add_news'); 
    }

}