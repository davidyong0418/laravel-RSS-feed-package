<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/8/2018
 * Time: 5:23 PM
 */

namespace Laraveldaily\Home\Controllers;

use App\Http\Controllers\Controller;

use Laraveldaily\Home\Models\Feed;

use Illuminate\Http\Request;
class FeedController extends Controller
{
    public function index()
    {
        return Feed::all();
    }

    public function show($id)
    {
        return Feed::find($id);
    }

    public function readfeeds($category, $pos = 0, $count = 0)
    {
        $feed_ids = ((integer)$count == 0) ? Feed::where('category', $category)->get() : Feed::where('category', $category)->offset((integer)$pos)->limit((integer)$count)->get();
        return $feed_ids;
    }

    public function store(Request $request)
    {
        return Feed::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $feed = Feed::findOrFail($id);
        $feed->update($request->all());

        return $feed;
    }

    public function delete(Request $request, $id)
    {
        $feed = Feed::findOrFail($id);
        $feed->delete();

        return 204;
    }
}