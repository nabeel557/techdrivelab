<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TechDriveLab</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small id="liveTime"></small> <!-- Live time and day will appear here -->
                    <small id="location"></small> <!-- Live location will appear here -->
                </div>
            </div>
            <script>
                // Update time and day every second
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
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center">
                    <!-- Admin Button -->
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <a href="./techpanel/index.php" class="btn text-white bg-danger me-3">Admin</a>
                    <?php endif; ?>

                    <!-- Social Links -->
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-0">
        <a href="index.php" class="align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>TechDriveLab</h2>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Services</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="booking.php" class="dropdown-item">Booking</a>
                        <a href="Fuses.php" class="dropdown-item">Fuses</a>
                        <a href="Capacitors.php" class="dropdown-item">Capacitors</a>
                        <a href="Switch Gears.php" class="dropdown-item">Switch Gears</a>
                        <a href="Resistors.php" class="dropdown-item">Resistors</a>
                    </div>
                </div>
            </div>

            <?php if ($_SESSION['username']): ?>
    <span class="navbar-text text-black me-4">
        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
    </span>
    <!-- Logout Button triggers Modal -->
    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fa fa-sign-out-alt"></i>
    </a>

               <!-- Modal Styles -->
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


 <!-- Modal Script -->
 <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Handle logout button click
            const logoutButton = document.getElementById('confirmLogoutButton');
            if (logoutButton) {
                logoutButton.addEventListener('click', () => {
                    // Perform logout via AJAX
                    fetch('logout.php')
                        .then(() => {
                            // Reload the page to update the navbar
                            window.location.reload();
                        });
                });
            }
        });
    </script>

 <!-- Logout Confirmation Modal -->
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
                    <button id="confirmLogoutButton" type="button" class="btn btn-danger">Logout</button>
                </div>
            </div>
        </div>
    </div>



            <?php else: ?>


                <a href="login.php" class="me-4"><i class="fa fa-sign-in-alt"></i></a>
                <a href="signup.php" class="me-4"><i class="fa fa-user-plus"></i></a>
                <a href="Feedback.php" class="me-4"><i class="fa fa-comments"></i></a>
            <?php endif; ?>
        </div>
    </nav>
    <!-- Navbar End -->
</body>

</html>