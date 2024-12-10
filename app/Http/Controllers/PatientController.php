<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Record;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function index()
    {
        // Get counts for the patient summary
        $todayCount = Patient::whereDate('updated_at', today())->where('status', 'Completed')->count();
        $monthCount = Patient::whereMonth('updated_at', today()->month)->where('status', 'Completed')->count();
        $annualCount = Patient::whereYear('updated_at', today()->year)->where('status', 'Completed')->count();


        $ongoingPatients = Patient::where('status', 'Ongoing')->get();


        return view('patients.index', compact('todayCount', 'monthCount', 'annualCount', 'ongoingPatients'));
    }
    public function store(Request $request)
{
    $ageCategory = $this->getAgeCategory($request->age);

    $patient = Patient::create([
        'name' => $request->name,
        'sitio' => $request->sitio,
        'age' => $request->age,
        'age_category' => $ageCategory,
        'gender' => $request->gender,
        'height' => $request->height,
        'weight' => $request->weight,
        'purpose' => $request->purpose,
        'status' => 'Ongoing',
    ]);

    return redirect()->route('patients.index');
}

private function getAgeCategory($age)
{
    if ($age <= 1) return 'Infancy';
    if ($age <= 3) return 'Toddler';
    if ($age <= 12) return 'Childhood';
    if ($age <= 18) return 'Adolescence';
    if ($age <= 60) return 'Adulthood';
    return 'Senior';
}

    public function update(Request $request, Patient $patient)
    {
        $medicine = Medicine::where('name', $request->medicine_received)->first();

        if ($medicine && $medicine->quantity_in_stock >= $request->quantity) 
        {
            // Reduce the stock
            $medicine->quantity_in_stock -= $request->quantity;
            $medicine->save(); 

            // Mark the patient as "Completed"
            $patient->status = 'Completed';
            $patient->save();

            // Record the medicine receipt
            Record::create([
                'patient_id' => $patient->id,
                'medicine_received' => $request->medicine_received,
                'quantity' => $request->quantity,
            ]);
        }


        return redirect()->route('patients.index');
    }
    public function updateStatus(Request $request, $id)
    {
        // Validate the input for medicine received and quantity
        $validated = $request->validate([
            'medicine_received' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $patient = Patient::findOrFail($id);
        $medicine = Medicine::where('name', $validated['medicine_received'])->first();

        // Check if the medicine exists
        if (!$medicine) {

            return redirect()->route('patients.index')->with('error', 'The medicine name is incorrect.');
        }

        // Check if the stock is sufficient
        if ($medicine->quantity_in_stock >= $validated['quantity']) {

            $medicine->quantity_in_stock -= $validated['quantity'];
            $medicine->save();

            // Mark the patient as 'Completed'
            $patient->status = 'Completed';
            $patient->save();


            Record::create([
                'patient_id' => $patient->id,
                'medicine_received' => $validated['medicine_received'],
                'quantity' => $validated['quantity'],
            ]);


            return redirect()->route('patients.index')->with('success', 'Patient status updated to Completed and moved to records.');
        } else {
 
            return redirect()->route('patients.index')->with('error', $validated['medicine_received'] . ' is insufficient in quantity.');
        }
    }
}
