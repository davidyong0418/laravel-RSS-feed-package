<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/8/2018
 * Time: 5:23 PM
 */

namespace Laraveldaily\Home\Controllers;

use App\Http\Controllers\Controller;

use Laraveldaily\Home\Models\Category;

use Illuminate\Http\Request;
class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        return Category::find($id);
    }

    public function store(Request $request)
    {
        return Category::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $feed = Category::findOrFail($id);
        $feed->update($request->all());

        return $feed;
    }

    public function delete(Request $request, $id)
    {
        $feed = Category::findOrFail($id);
        $feed->delete();

        return 204;
    }
}