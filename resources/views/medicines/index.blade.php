@extends('layout')

@section('content')
<div class="container mt-4">
    <!-- Header Section with Buttons -->
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex ">
            <form action="{{ route('medicines.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search medicines..." value="{{ request('search') }}"> <!-- Retains search query -->
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
            <!-- Refresh Button -->
            <button class="btn btn-secondary" id="refreshButton" onclick="refreshPage();">Refresh</button>
            <!-- <button class="btn btn-secondary" id="refreshButton" onclick="window.location.href='{{ route('medicines.index') }}';">Refresh</button> -->
        </div>

        <!-- Add Medicine Button -->
        <button class="btn btn-success" id="addButton" onclick="addMedicine();">Add Medicine</button>
        <!-- <button class="btn btn-success" id="addButton" onclick="window.location.href='{{ route('medicines.create')}}';">Add Medicine</button> -->
        
        <!-- Display Success Message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <!-- Medicines Table -->
    <table class="table table-striped" id="medicinesTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Dosage Form</th>
                <th>Dosage Strength</th>
                <th>Expiry Date</th>
                <th>Quantity in Stock</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicines as $medicine)
            <tr class="medicineRow">
                <td>{{ $medicine->name }}</td>
                <td>{{ $medicine->dosage_form }}</td>
                <td>{{ $medicine->dosage_strength }}</td>
                <td>{{ $medicine->expiry_date }}</td>
                <td>{{ $medicine->quantity_in_stock }}</td>
                <td>
                    <a href="{{ route('medicines.edit', $medicine->id) }}" class="btn btn-warning btn-sm">Update</a>
                    <button data-toggle="modal" data-target="#deleteModalMedicine" data-id="{{ $medicine->id }}" class="btn btn-danger btn-sm delete-button">Remove</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        <!-- Message for No Match Found -->
        @if(isset($message) && $message)
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endif

</div>

<!-- Modal for Delete Confirmation -->
<div class="modal fade" id="deleteModalMedicine" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabelMedicine" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabelMedicine">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this medicine?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteFormMedicine" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
   // Reset table to show all rows
   function refreshMedicines() {
        // Reload the page without search query
        window.location.href = "{{ route('medicines.index') }}";
    }
    // Handle delete button click and set form action dynamically
    $(document).on('click', '.delete-button', function () {
        const id = $(this).data('id');
        $('#deleteFormMedicine').attr('action', `/medicines/${id}`);
    });
</script>
@endpush
