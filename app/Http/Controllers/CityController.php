<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    // Show all cities
    public function index(Request $request)
    {
        $search = $request->search;

        $cities = City::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                ->orWhere('district', 'like', "%$search%");
        })->paginate(5);

        return view('cities.index', compact('cities'));
    }

    // Show form
    public function create()
    {
        return view('cities.create');
    }

    // Store data
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'population' => 'required|numeric',
        ]);

        // ✅ Save data
        City::create($request->all());

        // ✅ Success message
        return redirect('/admin/cities')->with('success', 'City added successfully');
    }
    // Edit form show
    public function edit($id)
    {
        $city = City::find($id);
        return view('cities.edit', compact('city'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'population' => 'required|numeric',
        ]);

        $city = City::findOrFail($id);
        $city->update($request->all());

        return redirect('/admin/cities')->with('success', 'City updated successfully');
    }

    // Delete
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect('/admin/cities')->with('success', 'City deleted successfully');
    }
}
