<?php
session_start();

// Example: Set username for testing (replace this with your actual login system logic)
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'Admin'; // Replace with actual username from your login system.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <!-- <link href="img/favicon.ico" rel="icon"> -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">


    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 href="index.php" class="text-danger">TechDriveLab</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <!-- <a href="chart.php" class="nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a> -->
                    <a href="booking.php" class="nav-link"><i class="fa fa-laptop me-2"></i>Booking</a>
                    <a href="cart_payment.php" class="nav-item nav-link"><i class="fa fa-cart-plus me-2"></i>Carts & Payments</a>

                    <a href="contact.php" class="nav-item nav-link"><i class="fa fa-address-book me-2"></i>Contact</a>
                    <a href="services.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Services</a>
                    <a href="feedback.php" class="nav-item nav-link"><i class="fa fa-comments me-2"></i>Feedback</a>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="add.php" class="dropdown-item"><i class="fa fa-plus me-2"></i>Add</a>
                            <a href="delete.php" class="dropdown-item"><i class="fa fa-trash me-2"></i>Delete</a>
                            <a href="update.php" class="dropdown-item"><i class="fa fa-pen me-2"></i>Update</a>
                            <a href="edit.php" class="dropdown-item"><i class="fa fa-edit me-2"></i>Edit</a>
                        </div>
                    </div> -->
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>

                </a>

                <br>
                <br>

                <div class="h-100 d-inline-flex align-items-center py-3">
                    <!-- <small class="far fa-clock text-primary me-2"></small> -->
                    <small id="liveTime"></small> <!-- This is where the live time and day will appear -->
                    <small id="location"></small> <!-- This is where the live location will appear -->
                </div>

                <script>
                    function updateTime() {
                        const liveTimeElement = document.getElementById('liveTime');
                        const now = new Date();

                        // Get current time
                        const hours = now.getHours().toString().padStart(2, '0');
                        const minutes = now.getMinutes().toString().padStart(2, '0');
                        const seconds = now.getSeconds().toString().padStart(2, '0');
                        const timeString = `${hours}:${minutes}:${seconds}`; // Format HH:MM:SS

                        // Get current day of the week
                        const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                        const day = daysOfWeek[now.getDay()]; // Get the current day from the array

                        // Combine day and time
                        const displayString = `${day}, ${timeString}`;

                        // Display live day and time
                        liveTimeElement.textContent = displayString;
                    }

                    // Get the user's live location
                    function getLocation() {
                        const locationElement = document.getElementById('location');
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(showPosition, showError);
                        } else {
                            locationElement.textContent = "Geolocation is not supported by this browser.";
                        }
                    }

                    // Fetch location details based on coordinates
                    function showPosition(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        // Use a free API like Geolocation DB to get city and country from lat/lon
                        fetch(`https://geolocation-db.com/json/`)
                            .then(response => response.json())
                            .then(data => {
                                const city = data.city;
                                const country = data.country_name;
                                document.getElementById('location').textContent = `, ${city}, ${country}`;
                            })
                            .catch(error => {
                                document.getElementById('location').textContent = ", Unable to fetch location";
                            });
                    }

                    // Handle possible errors from the geolocation request
                    function showError(error) {
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                document.getElementById('location').textContent = ", Location access denied.";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                document.getElementById('location').textContent = ", Location information is unavailable.";
                                break;
                            case error.TIMEOUT:
                                document.getElementById('location').textContent = ", The request to get user location timed out.";
                                break;
                            case error.UNKNOWN_ERROR:
                                document.getElementById('location').textContent = ", An unknown error occurred.";
                                break;
                        }
                    }

                    // Update the time and day immediately and then every second
                    updateTime();
                    setInterval(updateTime, 1000);

                    // Get and display the live location
                    getLocation();
                </script>

                <!-- Toast Notification -->
                <div id="toastMessage" class="alert alert-success position-fixed top-0 start-50 translate-middle-x"
                    style="display: none; z-index: 1050;">
                    Logged out successfully!
                </div>

                <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('confirmLogoutButton').addEventListener('click', function () {
            // Show the toast message
            const toastMessage = document.getElementById('toastMessage');
            toastMessage.style.display = 'block';

            // Redirect to logout.php
            fetch('/techdrivelab/logout.php', {
                method: 'POST', // Ensure the method matches what logout.php handles
            })
                .then(response => {
                    if (response.ok) {
                        // Redirect to the main website after 3 seconds
                        setTimeout(() => {
                            window.location.href = '/techdrivelab/index.php';
                        }, 3000);
                    } else {
                        throw new Error('Logout failed. Server returned an error.');
                    }
                })
                .catch(error => {
                    console.error('Logout error:', error);
                    alert('An error occurred while logging out.');
                });
        });
    });
</script>

                <!-- Styling -->
                <style>
                    .modal-content {
                        border-radius: 10px;
                        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
                    }

                    .modal-header {
                        background-color: #f8f9fa;
                        border-bottom: 2px solid #dee2e6;
                    }

                    .modal-footer .btn-danger {
                        background-color: #dc3545;
                        border: none;
                    }
                </style>


                <!-- Logout Modal -->
                <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to log out?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmLogoutButton">Log Out</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logout Button in Navbar -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav align-items-center ms-auto">
                        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class='bx bx-log-out'></i> Logout
                        </button>
                    </div>
                </div>

            </nav>
            <!-- Navbar End -->