<?php

namespace Laraveldaily\Home\Models;

use Illuminate\Database\Eloquent\Model;
class Feed extends Model
{
    //
    protected $fillable = ['source', 'url', 'category'];
}