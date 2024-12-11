<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Resident;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\View\View
     */
    
    public function dashboard()
    {    
        // Patients Summary
        $todayCount = Patient::whereDate('updated_at', today())->where('status', 'Completed')->count();
            $monthCount = Patient::whereMonth('updated_at', today()->month)->where('status', 'Completed')->count();
            $annualCount = Patient::whereYear('updated_at', today()->year)->where('status', 'Completed')->count();

        // Monthly Patients Data
        $monthlyPatients = Patient::selectRaw('MONTH(created_at) as month_number, MONTHNAME(created_at) as month, COUNT(*) as count')
                            ->groupBy('month_number', 'month')
                            ->where('status', 'Completed')
                            ->orderBy('month_number')
                            ->get();

        $monthlyLabels = $monthlyPatients->pluck('month');
        $monthlyCounts = $monthlyPatients->pluck('count'); 
                            

        // Average Age Data
        $averageAges = [
            'Infancy' => Patient::whereBetween('age', [0, 1])->where('status', 'Completed')->count(),
            'Toddler' => Patient::whereBetween('age', [2, 3])->where('status', 'Completed')->count(),
            'Childhood' => Patient::whereBetween('age', [4, 12])->where('status', 'Completed')->count(),
            'Adolescence' => Patient::whereBetween('age', [13, 18])->where('status', 'Completed')->count(),
            'Adulthood' => Patient::whereBetween('age', [19, 60])->where('status', 'Completed')->count(),
            'Senior' => Patient::where('age', '>', 60)->where('status', 'Completed')->count(),
        ];

        return view('dashboard', compact(
            'todayCount', 'monthCount', 'annualCount',
            'monthlyLabels', 'monthlyCounts', 'averageAges'
        ));
    }

 }
