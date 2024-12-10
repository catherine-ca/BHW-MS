<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {
        $records = Record::with('patient')->get();

        return view('records.index', compact('records'));
    }
}
