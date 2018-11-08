<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/8/2018
 * Time: 5:25 PM
 */

namespace Laraveldaily\Home\Controllers;

use App\Http\Controllers\Controller;

use Laraveldaily\Home\Models\Newsfeed;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class NewsfeedController extends Controller
{
    public function index()
    {
        return Newsfeed::all();
    }

    public function show($id)
    {
        return Newsfeed::find($id);
    }

    public function readnews(Request $request, $pos = 0, $count = 5)
    {
        $feeds = explode(",",$request->feeds);
        $news = Newsfeed::whereIn('feed_id', $feeds)->orderBy('pubDate', 'desc')->offset((integer)$pos)->limit((integer)$count)->get();
        return $news;
    }

    public function store(Request $request)
    {
        return Newsfeed::create($request->all());
    }

    public function update(Request $request)
    {
        foreach($request as $key => $news){
            $history = Newsfeed::where('feed_id', $news->feed_id)->where('pubDate', $news->pubDate)->get();
            if(!count($history)) $this->store($news);
        };

        return $request;
    }

    public function delete(Request $request, $id)
    {
        $newsfeed = Newsfeed::findOrFail($id);
        $newsfeed->delete();

        return 204;
    }
}