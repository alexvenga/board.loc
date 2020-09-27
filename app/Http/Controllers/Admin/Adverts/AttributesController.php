<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Http\Controllers\Controller;
use App\Models\Adverts\Attribute;
use App\Models\Adverts\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributesController extends Controller
{

    public function create(Category $category)
    {
        $types = Attribute::typesList();

        return view('admin.adverts.categories.attributes.create', compact('category', 'types'));
    }

    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:250',
            'type'     => [
                'required',
                'string',
                'max:255',
                Rule::in(array_keys(Attribute::typesList()))
            ],
            'required' => 'nullable|string',
            'variants' => 'nullable|string',
            'sort'     => 'required|integer',

        ]);

        $category->attributes()->create([
            'name'     => $request['name'],
            'type'     => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => json_encode(array_map('trim', preg_split('#[\r\n]+#', $request['variants']))),
            'sort'     => $request['sort'],
        ]);

        return redirect()->route('admin.adverts.categories.show', $category);
    }

    public function show(Category $category, Attribute $attribute)
    {

        return view('admin.adverts.categories.attributes.show', compact('category', 'attribute'));
    }

    public function edit(Category $category, Attribute $attribute)
    {

        $types = Attribute::typesList();

        return view('admin.adverts.categories.attributes.edit', compact('category', 'attribute', 'types'));
    }

    public function update(Request $request, Category $category, Attribute $attribute)
    {

        $this->validate($request, [
            'name'     => 'required|string|max:250',
            'type'     => [
                'required',
                'string',
                'max:255',
                Rule::in(array_keys(Attribute::typesList()))
            ],
            'required' => 'nullable|string',
            'variants' => 'nullable|string',
            'sort'     => 'required|integer',

        ]);

        $category->attributes()->findOrFail($attribute->id)->update([
            'name'     => $request['name'],
            'type'     => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort'     => $request['sort'],
        ]);

        return redirect()->route('admin.adverts.categories.show', $category);
    }


}
