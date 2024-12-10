@extends('layout')

@section('content')
<div class="container mt-2">

    <!--  Patients Summary -->
    <div class="row mb-4">
        <div class="col-md-4 mt-2">
            <div class="card text-center shadow" style="background-color: #fefae0; width: 300px; height: 100px;">
                <div class="card-header" style="font-weight: bold;">Patients (Today)</div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <h4>{{ $todayCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="card text-center shadow" style="background-color: #fefae0; width: 300px; height: 100px;">
                <div class="card-header" style="font-weight: bold;">Patients (Month)</div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <h4>{{ $monthCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="card text-center shadow" style="background-color: #fefae0; width: 300px; height: 100px;">
                <div class="card-header" style="font-weight: bold;">Patients (Annual)</div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <h4>{{ $annualCount }}</h4>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <!-- Monthly Patients Chart -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header" style="font-weight: bold;">Monthly Patients</div>
                <div class="card-body">
                    <canvas id="monthlyPatientsChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Average Age of Patients Chart -->
        <div class="col-md-6 mt-2">
            <div class="card shadow">
                <div class="card-header" style="font-weight: bold;">Average Age of Patients</div>
                <div class="card-body">
                    <canvas id="averageAgeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const monthlyPatientsData = {
        labels: @json($monthlyLabels),
        datasets: [{
            label: 'Patients per Month',
            data: @json($monthlyCounts),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    // Config for Monthly Patients Chart
    const monthlyPatientsConfig = {
        type: 'bar',
        data: monthlyPatientsData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    };

    const monthlyPatientsChart = new Chart(
        document.getElementById('monthlyPatientsChart'),
        monthlyPatientsConfig
    );

    const averageAgeData = {
        labels: ['Infancy', 'Toddler', 'Childhood', 'Adolescence', 'Adulthood', 'Senior'],
        datasets: [{
            label: 'Average Age per Category',
            data: @json($averageAges), 
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    };

    // Config for Average Age Chart
    const averageAgeConfig = {
        type: 'bar',
        data: averageAgeData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    };

    // Render Average Age Chart
    const averageAgeChart = new Chart(
        document.getElementById('averageAgeChart'),
        averageAgeConfig
    );
</script>