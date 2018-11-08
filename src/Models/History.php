<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/8/2018
 * Time: 9:11 PM
 */

namespace Laraveldaily\Home\Models;

use Illuminate\Database\Eloquent\Model;
class History extends Model
{
    //
    protected $fillable = ['user_id', 'feed_id'];
}