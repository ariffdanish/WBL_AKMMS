<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AKMMS System</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">

    <style>
    /* Your existing styles */

    /* Clock and Date styles */
    .clock,
    .date {
        color: white; /* Set text color to white */
        margin-right: 10px; /* Adjust margin as needed */
        font-weight: bold; /* Make text bold */
        animation: fadeIn 1s ease-in-out; /* Add fade-in animation */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Sidebar Styles */
    .bg-gradient-primary {
        background: linear-gradient(to right, #007bff, #0056b3); /* Blue gradient */
    }

    /* Navbar Styles */
    .bg-gradient-primary.topbar {
        background: linear-gradient(to right, #007bff, #0056b3); /* Blue gradient */
    }

    /* Navigation Links */
    #accordionSidebar .nav-link {
        color: white;
        transition: color 0.3s ease-in-out;
    }

    #accordionSidebar .nav-link:hover {
        color: #ffc107; /* Change to your desired hover color */
    }

    /* Dropdown Styles */
    .dropdown-menu {
        background: linear-gradient(to right, #007bff, #0056b3); /* Blue gradient */
        animation: fadeInDown 0.5s ease;
        color: white; /* Set the font color to white */
    }

    /* Profile Picture */
    .img-profile {
        border: 2px solid white; /* White border */
    }

    /* Button Styles */
    .btn-primary {
        background: #007bff; /* Blue color */
        border-color: #007bff; /* Blue border color */
    }

    .btn-primary:hover {
        background: #0056b3; /* Darker blue hover color */
        border-color: #0056b3; /* Darker blue hover border color */
    }

    /* Animation Effect */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .bold-and-centered {
        font-weight: bold;
        text-align: center;
    }

    
</style>


</head>


