<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct() {
        //only category view
        $this->middleware('can:admin')
            ->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = config('app.perpage');
        return view('admin.categories.index', [
            'categories' => Category::paginate($perPage)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create', [
            'categories' => Category::with('children')->whereNull('parent_id')->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->only(['title', 'slug', 'parent_id', 'position', 'status']));

        return redirect()->route('admin.categories.edit', $category)->withSuccess(__('Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
//        $this->authorize('view', $category);

        return view('admin.categories.edit', [
            'category' => $category,
            'categories' => Category::with('children')->whereNull('parent_id')->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
//        $this->authorize('update', $category);

        $category->update($request->only(['title', 'slug', 'parent_id', 'position', 'status']));

        return redirect()->route('admin.categories.edit', $category)->withSuccess(__('Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
//        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('admin.categories.index')->withSuccess(__('Deleted'));
    }
}
