@extends('layout')

@section('content')
<div class="container mt-3">
<h5 class="mt-3">Residents</h5>
    <div class="d-flex justify-content-between mb-3 mt-4">
        <div class="d-flex">
            <input type="text" id="searchBar" class="form-control me-2" placeholder="Type a name to search...">
            <button class="btn btn-secondary me-2" id="filterButton" onclick="filterResidents()">Filter</button>
            <button class="btn btn-primary" id="refreshButton" onclick="window.location.reload()">Refresh</button>
        </div>
        <div>
            <button class="btn btn-success" id="addButton" onclick="window.location.href='{{ route('residents.create') }}'">Add Resident</button>
        </div>
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
                        <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this resident?')">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<!-- para mafilter sa search  (di nagana) -->
<script>
    function filterResidents() {
        var input = document.getElementById("searchBar").value.toLowerCase();
        var table = document.getElementById("residentsTable");
        var tr = table.getElementsByTagName("tr"); 
        for (var i = 1; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName("td")[0];  
            if (td) {
                var txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().includes(input)) {
                    tr[i].style.display = "";  
                } else {
                    tr[i].style.display = "none"; 
                }
            }
        }
    }
</script>
@endpush
