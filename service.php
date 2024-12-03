<?php
include ('header.php');
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Service Start -->
<div class="container-xxl service py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">// Our Services //</h6>
            <h1 class="mb-5">Explore Our Services</h1>
        </div>
        <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
            <!-- Your existing service content -->

        </div>
    </div>
</div>
<!-- Service End -->

<!-- Booking Start -->
<div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-6 py-5">
                <div class="py-5">
                    <h1 class="text-white mb-4">Certified and Award Winning Car Repair Service Provider</h1>
                    <p class="text-white mb-0">Experience unparalleled excellence with our award-winning car service, where precision meets professionalism. Our skilled technicians ensure top-notch care and reliability for your vehicle, backed by a reputation for outstanding customer satisfaction. Trust us to keep your car in peak condition with exceptional service that sets the standard.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                    <h1 class="text-white mb-4">Book For A Service</h1>
                    <form id="bookingForm" method="POST" action="">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" name="name" placeholder="Your Name" style="height: 55px;" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control border-0" name="email" placeholder="Your Email" style="height: 55px;" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <select class="form-select border-0" name="service" required style="height: 55px;">
                                    <option selected disabled>Select A Service</option>
                                    <option value="Diagnostic Test">Diagnostic Test</option>
                                    <option value="Engine Servicing">Engine Servicing</option>
                                    <option value="Tires Replacement">Tires Replacement</option>
                                    <option value="Oil Changing">Oil Changing</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="date" class="form-control border-0" name="service_date" required style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0" name="special_request" placeholder="Special Request"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100 py-3" type="submit">Book Now</button>
                            </div>
                        </div>
                    </form>
                    <div id="formResponse">
                        <?php
                        if (isset($formResponse)) {
                            echo $formResponse;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Booking End -->

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Database connection details
    $servername = "localhost";
    $username = "root"; // Your database username
    $password = ""; // Your database password
    $dbname = "techdrivelab"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form data is set
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['service']) && isset($_POST['service_date'])) {
        // Escape the input values to prevent SQL injection
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $service = $conn->real_escape_string($_POST['service']);
        $service_date = $conn->real_escape_string($_POST['service_date']);
        $special_request = $conn->real_escape_string($_POST['special_request']);

        // Insert data into the database
        $sql = "INSERT INTO services (name, email, service, service_date, special_request) VALUES ('$name', '$email', '$service', '$service_date', '$special_request')";

        if ($conn->query($sql) === TRUE) {
            $formResponse = '<p class="text-success">Booking successful! You will be redirected shortly.</p>';
            // Redirect back to the same page to show the message
            header("Refresh: 2; url=services.php");
        } else {
            $formResponse = '<p class="text-danger">Error: ' . $conn->error . '</p>';
        }
    } else {
        $formResponse = '<p class="text-danger">All fields are required!</p>';
    }

    $conn->close();
}
?>

<?php
include ('footer.php');
?>
