<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\ArticleUpdateRequest;
use App\Traits\Uploadable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ArticleController extends Controller
{

    use Uploadable;

    public function store(ArticleUpdateRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = auth()->id();
        if ($request->hasFile('file')) {
            $inputs['file'] = $this->uploadOne($request->file('file'), 'uploads');
        }

        $article = Article::create($inputs);
        $article->categories()->attach($inputs['category_id']);

        return redirect()->route('knowledgebase.index');
    }

    /**
     * @param Article $article
     * @return Factory|View
     */
    public function edit(Article $article)
    {
        $cats = Category::orderBy('title')->pluck('title', 'id')->all();

        return view('knowledgebase.articles.edit', compact('article', 'cats'));
    }

    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $inputs = $request->all();

        if ($request->hasFile('file')) {
            $inputs['file'] = $this->uploadOne($request->file('file'), 'uploads');
        }

        $category_id = $inputs['category_id'];
        unset($inputs['_method']);
        unset($inputs['_token']);
        unset($inputs['category_id']);

        Article::find($article->id)->categories()->sync($category_id);
        $article = Article::where('id', $article->id)->update($inputs);


        return redirect()->route('knowledgebase.index');
    }

    /**
     * @param Article $article
     * @return Factory|View
     */
    public function show(Article $article)
    {
        return view('knowledgebase.articles.show', compact('article'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return Redirect
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('knowledgebase.index')->withSuccess('Article has been deleted successfully!');
    }
}
