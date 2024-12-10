@extends('layout')

@section('content')
<div class="container">
    
    <!-- Display Success or Error Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h2>Patients Management</h2>
    <div class="row">
        <!-- Patient Summary -->
        <div class="col-md-12 mb-4 mt-2">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center shadow" style="background-color: #fefae0; width: 300px; height: 100px;">
                        <div class="card-header">Patients (Today)</div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h4>{{ $todayCount }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow" style="background-color: #fefae0; width: 300px; height: 100px;">
                        <div class="card-header">Patients (Month)</div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h4>{{ $monthCount }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow" style="background-color: #fefae0; width: 300px; height: 100px;">
                        <div class="card-header">Patients (Annual)</div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <h4>{{ $annualCount }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New Patient Form -->
        <div class="col-md-6">
            <div class="card shadow" style="background-color: #FFFDF9;">
                <div class="card-header" style="font-weight: bold;">Add New Patient</div>
                <div class="card-body">
                    <form action="{{ route('patients.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="name">Complete Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sitio">Sitio</label>
                                <input type="text" name="sitio" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="age">Age</label>
                                <input type="number" name="age" class="form-control" required>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div> 
                        </div>
                        <div class="row -center">
                            <div class="form-group col-md-4">
                                <label for="height">Height (cm)</label>
                                <input type="number" name="height" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="weight">Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="purpose">Purpose</label>
                            <select name="purpose" class="form-control" required>
                                <option value="Injection">Injection</option>
                                <option value="Checkup">Checkup</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="text-center">
                           <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- List of Ongoing Patients -->
        <div class="col-md-6">
            <div class="card shadow" style="background-color: #FBF8EF;">
                <div class="card-header" style="font-weight: bold;">List of Ongoing Patients</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ongoingPatients as $patient)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updatePatientModal{{ $patient->id }}">
                                        Update
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="updatePatientModal{{ $patient->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Status for {{ $patient->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('patients.updateStatus', $patient->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="medicine_received">Medicine Received</label>
                                                    <input type="text" name="medicine_received" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Quantity of Medicine Received</label>
                                                    <input type="number" name="quantity" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Mark as Completed</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($ongoingPatients->isEmpty())
                        <p class="text-center">No ongoing patients found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
