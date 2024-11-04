<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('app.pages.index');

        $pages = Page::latest('id')->get();

        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('app.pages.create');

        return view('backend.pages.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('app.pages.create');

        $request->validate([
            'title' => 'required|string|unique:pages',
            'body' => 'required|string',
            'image' => 'nullable|image'
        ]);

        //Store data
        $page = Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->filled('status')
        ]);

        //Upload image
        if ($request->hasFile('image')) {
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        notify()->success('Page created successfull.', 'success');

        return to_route('app.pages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        Gate::authorize('app.pages.edit');
        return view('backend.pages.form', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        Gate::authorize('app.pages.edit');

        $request->validate([
            'title' => 'required|string|unique:pages,title,' . $page->id,
            'body' => 'required|string',
            'image' => 'nullable|image'
        ]);

        //Update data
        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->filled('status')
        ]);

        //Upload image
        if ($request->hasFile('image')) {
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        notify()->success('Page updated successfull.', 'success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        Gate::authorize('app.pages.destroy');

        $page->delete();

        notify()->success('Page deleted successfull.', 'Success');

        return back();
    }
}
