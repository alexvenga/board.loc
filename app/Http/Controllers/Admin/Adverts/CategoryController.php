<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Http\Controllers\Controller;
use App\Models\Adverts\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::defaultOrder()->withDepth()->get();

        return view('admin.adverts.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::defaultOrder()->withDepth()->get();

        return view('admin.adverts.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required|string|max:250',
            'slug'   => 'required|string|max:250',
            'parent' => 'nullable|integer|exists:advert_categories,id',
        ]);

        $category = Category::create([
            'name'      => $request['name'],
            'slug'      => $request['slug'],
            'parent_id' => $request['parent'],
        ]);

        return redirect()->route('admin.adverts.categories.show', $category);
    }

    public function show(Category $category)
    {

        $parentAttributes = $category->parentAttributes();
        $attributes = $category->attributes()->orderBy('sort')->get();

        return view('admin.adverts.categories.show', compact('category', 'attributes', 'parentAttributes'));
    }

    public function edit(Category $category)
    {

        $parents = Category::defaultOrder()->withDepth()->get();

        return view('admin.adverts.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {

        $this->validate($request, [
            'name'      => 'required|string|max:250',
            'slug'      => 'required|string|max:250',
            'parent_id' => 'nullable|integer|exists:advert_categories,id',
        ]);

        $category->update([
            'name'      => $request['name'],
            'slug'      => $request['slug'],
            'parent_id' => $request['parent_id'],
        ]);

        return redirect()->route('admin.adverts.categories.show', $category);
    }

    public function first(Category $category)
    {

        if ($first = $category->siblings()->defaultOrder()->first()) {
            $category->insertBeforeNode($first);
            return redirect()->route('admin.adverts.categories.index')->with('success', 'Changed');
        }

        return redirect()->route('admin.adverts.categories.index')->with('error', 'Some error');
    }

    public function up(Category $category)
    {

        if ($category->up()) {
            return redirect()->route('admin.adverts.categories.index')->with('success', 'Changed');
        } else {
            return redirect()->route('admin.adverts.categories.index')->with('error', 'Some error');
        }


    }

    public function down(Category $category)
    {

        $category->down();

        return redirect()->route('admin.adverts.categories.index');
    }

    public function last(Category $category)
    {

        if ($first = $category->siblings()->reversed()->first()) {
            $category->insertAfterNode($first);
            return redirect()->route('admin.adverts.categories.index')->with('success', 'Changed');
        }

        return redirect()->route('admin.adverts.categories.index')->with('error', 'Some error');
    }
}
