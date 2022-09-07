<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //

    public function show(Category $category, Request $request, Topic $topic)
    {
        //读取分类ID相关联的话题，并按照每20条分页
//        $topics = Topic::query()->where('category_id', $category->id)->paginate(20);
        $topics = $topic->withOrder($request->order)
                        ->where('category_id', $category->id)
            ->with('user', 'category') //预加载，防止N+1问题
            ->paginate(20);
        //传参变量话题和分类到模板中
        return view('topics.index', compact('topics', 'category'));
    }
}
