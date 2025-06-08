<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Country;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    public function index()
    {
        $provinces = Province::with('country')->get();
        return view('provinces.index', compact('provinces'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('provinces.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        Province::create($request->all());
        return redirect()->route('provinces.index')->with('success', 'Province created successfully.');
    }

    public function edit(Province $province)
    {
        $countries = Country::all();
        return view('provinces.edit', compact('province', 'countries'));
    }

    public function update(Request $request, Province $province)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $province->update($request->all());
        return redirect()->route('provinces.index')->with('success', 'Province updated successfully.');
    }

    public function destroy(Province $province)
    {
        $province->delete();
        return redirect()->route('provinces.index')->with('success', 'Province deleted successfully.');
    }
}
