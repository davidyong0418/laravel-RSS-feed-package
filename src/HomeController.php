<?php

namespace Laraveldaily\Home;

use App\Http\Controllers\Controller;

use Laraveldaily\Home\Controllers\FeedController;
use Laraveldaily\Home\Controllers\HistoryController;
use Laraveldaily\Home\Controllers\CategoryController;

use Illuminate\Http\Request;

use DB;
use Auth;

class HomeController extends Controller
{

    protected $selected_category = 'Featured';
    protected $feed_pos = 0;
    /**
     * feeder categories list view
     */
    public function index()
    {
        $user_id = Auth::user()->id;
//        $user_id = 1;
        $historyController = new HistoryController();
        $feed_ids = $historyController->readhistory($user_id);

        $categoryController = new CategoryController();
        $categories = $categoryController->index();

        $feedController = new FeedController();
        $feeds = $feedController->readfeeds($this->selected_category, $this->feed_pos, 12);

        $selected_category = $this->selected_category;

//        return $feeds;
        return view('home', compact('user_id', 'categories', 'feeds', 'selected_category', 'feed_ids'));
    }

    public function show($id)
    {
        return $this->index();
    }

    /**
     * save id of feeds you check/uncheck item of feed list by categories
     */
    public function store(Request $request, $flag)
    {
        $historyController = new HistoryController();
        $historyController->update( $request, $flag);
        return $this->index();
    }

    /**
     * save id of feeds you check/uncheck item of feed list by categories
     */
    public function defaultselect(Request $request)
    {
        $user_id = Auth::user()->id;
//        $user_id = 1;

        $this->selected_category = 'Featured';
        $this->feed_pos = 0;

        $feedController = new FeedController();
        $feeds = $feedController->readfeeds($this->selected_category, $this->feed_pos);

        $historyController = new HistoryController();
        foreach ($feeds as $key => $feed) {
            $historyController->update( new Request([
                'user_id' => $user_id,
                'feed_id' => $feed->id
            ]), 1);
        }
        return $this->index();
    }

    /**
     * if the scroll is placed at the bottom, fetch data for feeds.
     */
    public function update(Request $request)
    {
        $this->selected_category = $request->category;
        $this->feed_pos = $request->feed_count;
        return $this->index();
    }

    public function delete(Request $request, $id)
    {
        return $this->index();
    }

}
