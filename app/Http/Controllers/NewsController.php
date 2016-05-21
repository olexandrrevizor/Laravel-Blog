<?php
namespace App\Http\Controllers;

use App\News;
use Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class NewsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$el = News::find($id);
		return view('pages.news', ['news' => $el]);
	}

	public function addNews()
	{
		if(Request::ajax()) {

			$news = new News;
			$news->title = trim(Input::get('title'));
			$news->content = trim(Input::get('content'));
			$news->thumb = trim(Input::get('thumb'));
			$save_result = $news->save();

			$status = false;

			if($save_result == true)
				$status = true;

			return Response::json(['result' => $status]);
		}

	}

	public function deleteNews()
	{
		if(Request::ajax())
		{
			$status = false;
			$news_id = Input::get('news_id');

			if(empty($news_id))
				return Response::json(['result' => $status]);

			$news = News::find($news_id);
			$delete_result = $news->delete();

			if($delete_result == true)
				$status = true;

			return Response::json(['result' => $status]);
		}
	}

	public function editNews($id) 
	{
		$el = News::find($id);
		return view('pages.edit_news', ['news' => $el]);
	}
	
	public function updateNews() 
	{
		if(Request::ajax()) {
			$status = false;
			$news_id = Input::get('news_id');

			if(empty($news_id))
				return Response::json(['result' => $status]);

			$news = News::find($news_id);

			$title = trim(Input::get('title'));
			$content = trim(Input::get('content'));
			$thumb = trim(Input::get('thumb'));
			$updated = 0;

			if(strcmp($news->title, $title) != 0) {
				$news->title = $title;
				$updated = 1;
			}

			if(strcmp($news->content, $content) != 0) {
				$news->content = $content;
				$updated = 1;
			}

			if(strcmp($news->thumb, $thumb) != 0) {
				$news->thumb = $thumb;
				$updated = 1;
			}

			if($updated)
				$status = $news->save();

			return Response::json(['result' => $status]);

		}
	}

}
