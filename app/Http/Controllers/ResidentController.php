<?php
namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        // $residents = Resident::all();
        // return view('residents.index', compact('residents'));
        $query = $request->input('search');

        if ($query) 
        {
            // Search residents by name
            $residents = Resident::where('firstname', 'like', '%' . $query . '%')->get();

            // Check if no residents are found
            if ($residents->isEmpty()) 
            {
                $message = "Name of resident not found.";
            } else 
                {
                    $message = null;
                }
        } else 
            {
            // Show all medicines when no search query
            $residents = Resident::all();
            $message = null;
        }

        return view('residents.index', compact('residents', 'query', 'message'));
  
    }

    public function create()
    {
        return view('residents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'age' => 'required|integer',
            'sitio' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
        ]);

        Resident::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'age' => $request->age,
            'sitio' => $request->sitio,
            'phone_number' => $request->phone_number,
        ]);
        return redirect()->route('residents.index');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        return view('residents.edit', compact('resident'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'age' => 'required|integer',
            'sitio' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
        ]);

        $resident = Resident::findOrFail($id);
        $resident->update([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'age' => $request->age,
            'sitio' => $request->sitio,
            'phone_number' => $request->phone_number,
        ]);
        
        return redirect()->route('residents.index');
    }
    
    public function destroy($id)
    {
        // Find the resident by ID
        $resident = Resident::findOrFail($id);

        // Delete the resident
        $resident->delete();

        // Redirect back with a success message
        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully!');
    }
}
