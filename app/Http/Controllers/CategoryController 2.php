<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function view(Category $category)
    {
        return view('knowledgebase.category.view', compact('category'));
    }

    public function create()
    {
        return view('knowledgebase.category.category');

    }

    public function store(CategoryUpdateRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = auth()->id();

        Category::create($inputs);

        return redirect()->route('knowledgebase.index');
    }

    public function edit(Request $request, Category $category)
    {
        $categories = Category::where('user_id', auth()->id())->get();

        return view('knowledgebase.category.edit', compact('category', 'categories'));

    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('knowledgebase.index');
    }

    public function destroy(Category $category)
    {
        $category_id = $category->id;
        Category::where('id', $category_id)->delete();

        return redirect()->route('knowledgebase.index');
    }
}
