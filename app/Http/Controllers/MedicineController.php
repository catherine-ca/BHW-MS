<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    // Display the list of medicines
    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) 
        {
            // Search medicines by name
            $medicines = Medicine::where('name', 'like', '%' . $query . '%')->get();

            // Check if no medicines are found
            if ($medicines->isEmpty()) 
            {
                $message = "Name of medicine not found.";
            } else 
                {
                    $message = null;
                }
        } else 
            {
            // Show all medicines when no search query
            $medicines = Medicine::all();
            $message = null;
        }

        return view('medicines.index', compact('medicines', 'query', 'message'));
    }

    // Show the form for creating a new medicine
    public function create()
    {
        return view('medicines.create');
    }

    // Store a new medicine in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dosage_form' => 'required|string|max:255',
            'dosage_strength' => 'required|string|max:255',
            'expiry_date' => 'required|date',
            'quantity_in_stock' => 'required|integer|min:0',
        ]);
    
        Medicine::create($request->all());
    
        return redirect()->route('medicines.index');
    }
    

    // Show the form for editing the quantity of a specific medicine
    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    // Update the quantity of a specific medicine
    public function update(Request $request, Medicine $medicine)
    {
        // Validate the input data
    $validated = $request->validate([
        'dosage_form' => 'required|string|max:255',
        'dosage_strength' => 'required|string|max:255',
        'expiry_date' => 'required|date',
        'quantity_in_stock' => 'required|integer|min:0',
    ]);

    // Update the medicine with the validated data
    $medicine->update($validated);

    // Redirect back to the medicines index with a success message
    return redirect()->route('medicines.index');
    }

    // Remove a specific medicine from the database
    public function destroy($id)
{
    $medicine = Medicine::findOrFail($id);
    $medicine->delete();

    // Redirect back to the medicines index page with a success message
    return redirect()->route('medicines.index')->with('success', 'Medicine deleted successfully.');
}



}
