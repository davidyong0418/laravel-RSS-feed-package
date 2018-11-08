<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/10/2018
 * Time: 2:28 AM
 */

namespace Laraveldaily\Home;

use App\Http\Controllers\Controller;
use Laraveldaily\Home\Controllers\HistoryController;
use Laraveldaily\Home\Controllers\NewsfeedController;
use Laraveldaily\Home\Controllers\CategoryController;

use Illuminate\Http\Request;
use Auth;

class DetailController extends Controller
{
    protected $news_pos = 0;

    public function index()
    {
        $user_id = Auth::user()->id;
//        $user_id = 1;
        $historyController = new HistoryController();
        $newsfeedController = new NewsfeedController();
        $categoryController = new CategoryController();

        $user_feeds = $historyController->readhistory($user_id);
        $user_news = $newsfeedController->readnews(new Request(['feeds'=> $user_feeds->feeds]), $this->news_pos);
        $categories = $categoryController->index();
        $count = count($user_news);
//        return $user_news;
        return view('detail', compact('user_id', 'categories', 'user_news', 'count'));
    }

    public function show($id)
    {
        return $this->index();
    }

    public function store(Request $request)
    {
        return $this->index();
    }

    /**
     * if the scroll is placed at the bottom, fetch data for feeds.
     */
    public function update(Request $request)
    {
        $this->news_pos = $request->news_pos;
        return $this->index();
    }

    public function delete(Request $request, $id)
    {
        return $this->index();
    }

}