@extends('layout')

@section('content')
<div class="container">
    <h2>Patient Records</h2>

    <div class="row">
        <div class="col-md-12 mt-2">
            <!-- Records Table -->
            <div class="card shadow" style="background-color: #F8F6F4;">
                <div class="card-header">List of Completed Patients</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Medicine Received</th>
                                <th>Quantity</th>
                                <th>Date Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $record->patient->name }}</td>
                                <td>{{ $record->patient->age }}</td>
                                <td>{{ $record->patient->gender }}</td>
                                <td>{{ $record->medicine_received }}</td>
                                <td>{{ $record->quantity }}</td>
                                <td>{{ $record->created_at->format('F d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No completed records found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
