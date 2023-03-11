<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type_filter = $request->query('type_filter');

        $query = Type::orderBy('label');

        // if there is a type filter
        if ($type_filter) {
            $query->where('id', $type_filter);
        }

        //get types from db
        $types = $query->get();

        return view('admin.tyeps.index', compact('types', 'type_filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = new Type;
        $types = Type::all();
        return view('admin.types.create', compact('type', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('type', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return to_route('admin.types.index')->with('message', "$type->title deleted succesfully.")->with('type', 'danger');;
    }
}
