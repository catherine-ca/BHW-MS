@extends('layout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Edit Resident</h2>
    <form action="{{ route('residents.update', $resident->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $resident->firstname }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" name="age" id="age" class="form-control" value="{{ $resident->age }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input type="text" name="middlename" id="middlename" class="form-control" value="{{ $resident->middlename }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="sitio" class="form-label">Sitio</label>
                <input type="text" name="sitio" id="sitio" class="form-control" value="{{ $resident->sitio }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $resident->lastname }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <labcel for="phone_number" class="form-label">Phone Number</labcel>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $resident->phone_number }}">
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4 py-2" style="background-color: #8B9A46; border: none;">Update Resident</button>
        </div>
    </form>
</div>
@endsection
