<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/8/2018
 * Time: 9:12 PM
 */

namespace Laraveldaily\Home\Models;

use Illuminate\Database\Eloquent\Model;
class Newsfeed extends Model
{
    //
    protected $fillable = ['feed_id', 'title', 'description', 'category', 'link', 'pubDate'];

}