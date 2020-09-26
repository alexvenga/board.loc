<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionsController extends Controller
{

//    private $register;
//
//    /**
//     * UsersController constructor.
//     * @param RegisterService $register
//     */
//    public function __construct(RegisterService $register)
//    {
//        $this->register = $register;
//    }

    public function index()
    {

        $regions = Region::where('parent_id', null)->orderBy('name')->get();

        return view('admin.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent = null;

        if ($request->get('parent')) {
            $parent = Region::findOrFail($request->get('parent'));
        }

        return view('admin.regions.create', compact('parent'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'name'   => 'required|string|max:255|unique:regions,name,null,id,parent_id,' . ($request['parent'] ?: null),
            'slug'   => 'required|string|max:255|unique:regions,slug,null,id,parent_id,' . ($request['parent'] ?: null),
            'parent' => 'exists:regions,id',
        ]);

        $region = Region::create([
            'name'      => $request['name'],
            'slug'      => $request['slug'],
            'parent_id' => $request['parent'],
        ]);

        return redirect()->route('admin.regions.show', $region);

    }


    public function show(Region $region)
    {

        $regions = Region::where('parent_id', '=', $region->id)->orderBy('name')->get();


        return view('admin.regions.show', compact('region', 'regions'));
    }


    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }


    public function update(Request $request, Region $region)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255|unique:regions,name,' . $region->id . ',id,parent_id,' . $region->parent_id,
            'slug' => 'required|string|max:255|unique:regions,slug,' . $region->id . ',id,parent_id,' . $region->parent_id,
        ]);

        $region->update($request->all());

        return redirect()->route('admin.regions.show', $region);
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('admin.regions.index');
    }

//    public function verify(Region $region)
//    {
//        try {
//            $this->register->verify($user->id);
//        } catch (\DomainException $e) {
//            return redirect()->route('admin.regions.show', $user)
//                ->with('error', $e->getMessage());
//        }
//
//        return redirect()->route('admin.regions.show', $user);
//    }
}
