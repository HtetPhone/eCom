<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_list() {
        $categories = Category::latest('id')->get();
        return view('admin.categories.categories_list', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:2|max:255'
        ], [
            'name.required' => 'Category name is required',
            'name.min' => 'Name must be at least 2 characters',
        ]);

        $request->user()->categories()->create($request->only('name'));
        return redirect()->route('category.list')->with(['message' => 'New Category has been addded!']);
    }

    public function edit(Category $category) {
        return view('admin.categories.edit_category', compact('category'));
    }

    public function update(Category $category, Request $request) {
        $request->validate([
            'name' => 'required|min:2|max:255'
        ], [
            'name.required' => 'Category name is required',
            'name.min' => 'Name must be at least 2 characters',
        ]);

        $category->update($request->only('name'));
        return redirect()->route('category.list')->with(['message' => 'Category has been updated']);
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('category.list')->with(['message' => 'Category is deleted!!']);
    }
}

