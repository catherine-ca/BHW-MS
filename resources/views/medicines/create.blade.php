@extends('layout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">New Medicine</h2>
    <form action="{{ route('medicines.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="row">
        <div class="col-md-4 mb-3">
                <label for="name" class="form-label">Medicine Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="col-md-5 mb-3">
                <label for="dosage_form" class="form-label">Dosage Form</label>
                <select name="dosage_form" id="dosage_form" class="form-select" required>
                <option value="" selected disabled>Select Dosage Form</option>
                <option value="Syrup">Syrup</option>
                <option value="Capsule">Capsule</option>
                <option value="Tablet">Tablet</option>
                </select>
            </div>
      
            <div class="col-md-4 mb-3">
                <label for="dosage_strength" class="form-label">Dosage Strength</label>
                <input type="text" name="dosage_strength" id="dosage_strength" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="expiry_date" class="form-label">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label for="quantity_in_stock" class="form-label">Quantity in Stock</label>
                <input type="number" name="quantity_in_stock" id="quantity_in_stock" class="form-control" required>
            </div>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4 py-2" style="background-color: #8B9A46; border: none;">Submit</button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection