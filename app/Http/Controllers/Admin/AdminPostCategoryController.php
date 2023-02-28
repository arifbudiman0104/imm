<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminPostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $postsCategories = PostCategory::with('posts')->get();
        return view('admin.posts-categories.index', compact('postsCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.posts-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        if ($request->slug == null) {
            $slug = strtolower(str_replace(' ', '-', $request->title));
        } else {
            $slug = strtolower(str_replace(' ', '-', $request->slug));
        }
        $postCategory = new PostCategory();
        $postCategory->title = $request->title;
        $postCategory->slug = $slug;
        $postCategory->description = $request->description;
        $postCategory->save();

        return redirect()->route('admin.post-categories.index')->with('success', 'Post Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $postCategory): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostCategory $postCategory): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory): RedirectResponse
    {
        //
    }
}
