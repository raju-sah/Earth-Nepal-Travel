<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Traits\StatusTrait;

class BlogController extends Controller
{
    use StatusTrait;

    public function index(): View
    {
        return view('admin.blog.index', [
            'blogs' => Blog::query()->select(['id', 'user_id', 'title', 'slug', 'is_popular', 'status'])->latest()->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.blog.create');
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        $blog = auth()->user()->blogs()->create($request->safe()->except('image'));

        if ($request->hasFile('image')) {
            $blog->storeImage('image', 'blog-images', $request->file('image'),1600,600);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Created Successfully!');
    }

    public function show(Blog $blog): View
    {
        $blog->load('user');

        return view('admin.blog.show', compact('blog'));
    }

    public function edit(Blog $blog): View
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(BlogUpdateRequest $request, Blog $blog): RedirectResponse
    {
        $data = $request->safe()->except('image');

        if ($request->input('image_removed') == 'true') {
            $blog->deleteImage('image', 'blog-images');
            $data['image'] = null;
        }

        $blog->update($data);

        if ($request->hasFile('image')) {
            $blog->updateImage('image', 'blog-images', $request->file('image'),1600,600);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Updated Successfully!');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->image) {
            $blog->deleteImage('image', 'blog-images');
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('error', 'Blog Deleted Successfully!');
    }

    public function changeStatus(Request $request): void
    {
        $this->changeItemStatus('Blog', $request->id, $request->status);
    }
}
