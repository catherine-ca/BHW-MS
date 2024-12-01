@extends('layout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Add New Resident</h2>
    <form action="{{ route('residents.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="row">
            <div class="col-md-5 mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" name="age" id="age" class="form-control" placeholder="Enter Age" required>
            </div>

            <div class="col-md-5 mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Enter Middle Name">
            </div>

            <div class="col-md-4 mb-3">
                <label for="sitio" class="form-label">Sitio</label>
                <input type="text" name="sitio" id="sitio" class="form-control" placeholder="Enter Sitio" required>
            </div>

            <div class="col-md-5 mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number">
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4 py-2" style="background-color: #8B9A46; border: none;">Submit</button>
            <a href="{{ route('residents.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
