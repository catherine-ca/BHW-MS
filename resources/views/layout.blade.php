<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BHW  RIMS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body 
        {
            margin: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            min-height: 100vh;
            display: flex;
        }

        .navbar 
        {
            width: 100%;
            height: 68px;
            background-color: #FEFAE0;
            color: #fff;
            padding: 0 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            z-index: 1;
        }
        .navbar .profile 
        {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #212529;
        }

        .navbar .profile img 
        {
            width: 55x;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
        }

        .sidebar 
        {
            width: 250px;
            background-color: #C0C78C;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            z-index: 2;
        }
        .sidebar .logo 
        {
            text-align: center;
            padding: 0.5rem 0;
            width: 250px;
            height: 68px;
            background-color: #A6B37D;
            margin-bottom: 1rem;
        }
        .sidebar .logo img 
        {
            display: block;
            margin: 0 auto;
            width: 60px; /* Logo size */
            height: auto;
        }
        .sidebar a 
        {
            color: #000000;
            text-decoration: none;
            padding: 0.8rem 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, background-color 0.3s ease
        }
        .sidebar a:hover 
        {
            background-color: #495057;
            color: black;
            background-color: unset !important;
            transform: scale(0.95);

        }
        .sidebar a .icon 
        {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            transition: transform 0.3s ease;
        }
        .sidebar a:hover .icon 
        {
            transform: scale(1.2);
        }

        /* Show Icons Only on Small Screens */
        .sidebar.compact a span 
        {
            display: none;
        }

        /* Main Content */
        .main-content 
        {
            margin-left: 250px;
            margin-top: 60px;
            padding: 1rem;
            flex: 1;
            transition: margin-left 0.3s ease-in-out;
        }
        .main-content.collapsed 
        {
            margin-left: 0;
        }

        /* Sidebar Responsive */
@media screen and (max-width: 768px) 
    {
    .sidebar 
    {
        width: 60px; 
    }
    .sidebar .logo 
    {
        padding: 0.5rem 0;
        width: 100%; 
        height: 60px; 
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sidebar .logo img 
    {
        width: 40px; 
        height: 40px;
        object-fit: contain;
    }
    .sidebar.compact a span 
    {
        display: none;
    }
    .sidebar a .icon 
    {
        margin-right: 0;
        font-size: 1.5rem;
    }
    .sidebar.compact 
    {
        width: 60px;
    }
    .main-content 
    {
        margin-left: 60px;
    }
    .navbar 
    {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 2;
    }
    .sidebar a 
    {
        justify-content: center;
    }
}
#searchButton, #refreshButton, #addButton 
{
    height: 40px; 
    line-height: 1.5;
}
.refresh-btn 
{
    margin-left: 10px; 
}
</style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="logo"></a>
        <div class="profile">
            <span>Catherine</span>
            <img src="https://static.vecteezy.com/system/resources/previews/005/544/718/original/profile-icon-design-free-vector.jpg" alt="User Profile">
        </div>
    </nav>
    
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="https://www.glmedicals.com/static/home/img/og/grace-and-lord-medicals-facebook-476-476.png" alt="Logo">
        </div>
        <a href="#">
            <i class="fas fa-home icon"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{route('residents.index')}}">
            <i class="fas fa-users icon"></i>
            <span>Residents</span>
        </a>
        <a href="{{ route('medicines.index') }}">
            <i class="fas fa-pills icon"></i>
            <span>Medicine</span>
        </a>
        <a href="">
            <i class="fas fa-file-alt icon"></i>
            <span>Records</span>
        </a>
        <a href="">
            <i class="fas fa-user-injured icon"></i>
            <span>Patients</span>
        </a>

    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        @yield('content')
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
   
    <script>
        const sidebar = document.getElementById('sidebar');
        
        //resposive sidebar
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.add('compact');
            } else {
                sidebar.classList.remove('compact');
            }
        });
        // if (window.innerWidth <= 768) {
        //     sidebar.classList.add('compact');
        // } else {
        //     sidebar.classList.remove('compact');
        // }

        // Initialize on page load
        if (window.innerWidth <= 768) {
            sidebar.classList.add('compact');
        } else {
            sidebar.classList.remove('compact');
        }
        // medicines deletion
       // Handle delete button click and set form action dynamically
$(document).on('click', '.delete-button', function () {
    const id = $(this).data('id');
    $('#deleteFormMedicine').attr('action', `/medicines/${id}`);
});

        // residents deletion
        $(document).on('click', '.delete-button', function () 
        {
            const id = $(this).data('id');
            $('#deleteForm').attr('action', `/residents/${id}`);
        });
        
        function refreshResidents() {
        window.location.href = "{{ route('residents.index') }}";
    }

    function addResident() {
        window.location.href = "{{ route('residents.create') }}";
    }

    function addMedicine() {
        window.location.href = "{{ route('medicines.create') }}";
    }

    function refreshPage() {
        window.location.href = "{{ route('medicines.index') }}";
    }
    </script>
</body>
</html>
