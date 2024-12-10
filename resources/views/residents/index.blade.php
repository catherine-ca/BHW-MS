@extends('layout')

@section('content')
<div class="container mt-3">
<h5 class="mt-3">Residents</h5>
    <div class="d-flex justify-content-between mb-3 mt-4">
        <div class="d-flex">
            <form action="{{ route('residents.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search resident..." value="{{ request('search') }}"> <!-- Retains search query -->
                    <button class="btn btn-primary" type="submit">  <i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Refresh Button -->
            <button class="btn btn-secondary" id="refreshButton" onclick="refreshResidents();">  <i class="fas fa-sync-alt"></i></button>
        </div>
        <div>
             <button class="btn btn-success" id="addButton" onclick="addResident();">Add Resident</button>    
        </div>
        <!-- Display Success Message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <!--Table ng residents -->
    <table class="table table-striped" id="residentsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Sitio</th>
                <th>Phone Number</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($residents as $resident)
                <tr>
                    <td>{{ $resident->firstname }} {{ $resident->middlename }} {{ $resident->lastname }}</td>
                    <td>{{ $resident->age }}</td>
                    <td>{{ $resident->sitio }}</td>
                    <td>{{ $resident->phone_number }}</td>
                    <td>
                        <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-warning btn-sm">Update</a>
                        <button data-toggle="modal" data-target="#deleteModal" data-id="{{ $resident->id }}" class="btn btn-danger btn-sm delete-button">Remove</button>     
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
     @if(isset($message) && $message)
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endif
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this resident?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    // Reset table to show all rows
    function refreshResidents() 
    {
        window.location.href = "{{ route('residents.index') }}";
    }
    //  button click 
    $(document).on('click', '.delete-button', function () {
        const id = $(this).data('id');
        $('#deleteForm').attr('action', `/residents/${id}`);
    });
</script>
