<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;

class KnowledgebaseController extends Controller {

    public function index()
    {
        $categories = Category::orderBy('title')->get();
        $articles = Article::orderBy('title')->get();
        $cats = Category::orderBy('title')->pluck('title', 'id')->all();

        return view('knowledgebase.index', compact('categories', 'articles', 'cats'));
    }
}
