<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/8/2018
 * Time: 5:24 PM
 */

namespace Laraveldaily\Home\Controllers;

use App\Http\Controllers\Controller;

use Laraveldaily\Home\Models\History;

use Illuminate\Http\Request;
class HistoryController extends Controller
{
    public function index()
    {
        return History::all();
    }

    public function show($id)
    {
        return History::find($id);
    }

    public function readhistory($user_id)
    {
        $feed_ids = History::where('user_id', $user_id)->selectRaw("GROUP_CONCAT(feed_id) AS feeds")->get();
        return $feed_ids[0];
    }

    public function store(Request $request)
    {
        return History::create($request->all());
    }

    public function update(Request $request, $flag)
    {
        $history = History::where('user_id', $request->user_id)->where('feed_id', $request->feed_id)->get();

        if($flag && !count($history))
            $this->store($request);
        if(!$flag && count($history))
            $this->delete($request, $history[0]->id);

        return 'success';
    }

    public function delete(Request $request, $id)
    {
        $history = History::findOrFail($id);
        $history->delete();

        return 204;
    }

}