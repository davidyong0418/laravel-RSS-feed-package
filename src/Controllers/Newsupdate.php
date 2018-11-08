<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/11/2018
 * Time: 3:46 AM
 */

namespace Laraveldaily\Home\Controllers;

use Laraveldaily\Home\Models\Feed;
use Laraveldaily\Home\Models\Newsfeed;
class Newsupdate
{
    public function index()
    {
        ini_set('max_execution_time', 3600);
        $feeds = Feed::all();
        foreach ($feeds as $key => $feed) {
            $rss = new \DOMDocument();
            $url = str_replace(' ', '', $feed->url);

            try {
                $rss->load($url);
            } catch (\Exception $e) {
                \Log::error('feed url is invalid');
                \Log::error($e);
            }

            foreach ($rss->getElementsByTagName('item') as $key => $node) {
                try {
                    $date = $node->getElementsByTagName('pubDate')->length ? $node->getElementsByTagName('pubDate')->item(0)->nodeValue : '';
                    $pubDate =  date("Y-m-d H:i:s T", strtotime($date));
                    $news = [
                        'feed_id' => $feed->id,
                        'title' => $node->getElementsByTagName('title')->length ? $node->getElementsByTagName('title')->item(0)->nodeValue : '',
                        'description' => $node->getElementsByTagName('description')->length ? html_entity_decode($node->getElementsByTagName('description')->item(0)->nodeValue) : '',
                        'category' => $feed->category,
                        'link' => $node->getElementsByTagName('link')->length ? $node->getElementsByTagName('link')->item(0)->nodeValue : '',
                        'pubDate' => $pubDate,
                    ];

                    $history = Newsfeed::where('feed_id', $feed->id)->where('pubDate', $pubDate)->get();
                    if(count($history)) break;
                    Newsfeed::create($news);
                } catch (\Exception $e) {
                    \Log::error($news.' is invalid');
                    continue;
                }
            }
        }

        return 'success';
    }
}