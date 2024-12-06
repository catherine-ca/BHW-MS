@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Edit Medicine</h3>

    <!-- Edit Medicine Form -->
    <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mt-4 ">
            <!-- Name (Display only) -->
            <div class="col-md-5 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" value="{{ $medicine->name }}" disabled>
            </div>

            <!-- Dosage Form (Editable) -->
            <div class="col-md-5 mb-3">
                <label for="dosage_form" class="form-label">Dosage Form</label>
                <select class="form-select" id="dosage_form" name="dosage_form" required>
                    <option value="Syrup" {{ $medicine->dosage_form == 'Syrup' ? 'selected' : '' }}>Syrup</option>
                    <option value="Capsule" {{ $medicine->dosage_form == 'Capsule' ? 'selected' : '' }}>Capsule</option>
                    <option value="Tablet" {{ $medicine->dosage_form == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                </select>
            </div>

            <!-- Dosage Strength (Editable) -->
            <div class="col-md-5 mb-3">
                <label for="dosage_strength" class="form-label">Dosage Strength</label>
                <input type="text" class="form-control" id="dosage_strength" name="dosage_strength" value="{{ $medicine->dosage_strength }}" required>
            </div>

            <!-- Expiry Date (Editable, Calendar Picker) -->
            <div class="col-md-4 mb-3">
                <label for="expiry_date" class="form-label">Expiry Date</label>
                <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ $medicine->expiry_date }}" required>
            </div>

            <!-- Quantity in Stock (Editable) -->
            <div class="col-md-4 mb-3">
                <label for="quantity_in_stock" class="form-label">Quantity in Stock</label>
                <input type="number" class="form-control" id="quantity_in_stock" name="quantity_in_stock" value="{{ $medicine->quantity_in_stock }}" required>
            </div>
        </div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Medicine</button>
        <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Cancel</a>
        
    </form>
</div>
@endsection
