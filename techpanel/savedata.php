<?php
session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "techdrivelab");

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data and sanitize
    $fullname = $conn->real_escape_string(trim($_POST['CustomerFullname']));
    $email = $conn->real_escape_string(trim($_POST['CustomerEmail']));
    $phone = $conn->real_escape_string(trim($_POST['CustomerPhone']));
    $carModel = $conn->real_escape_string(trim($_POST['BookedCarModel']));
    $serviceType = $conn->real_escape_string(trim($_POST['BookServiceType']));
    $bookingDate = $conn->real_escape_string(trim($_POST['BookingDate']));
    $serviceName = $conn->real_escape_string(trim($_POST['ServiceName']));
    $serviceDate = $conn->real_escape_string(trim($_POST['ServiceDate']));
    $contactRegDate = $conn->real_escape_string(trim($_POST['ContactRegistrationDate']));

    // Validate form data
    if (empty($fullname) || empty($email) || empty($phone) || empty($carModel) || empty($serviceType) || empty($bookingDate) || empty($serviceName) || empty($serviceDate) || empty($contactRegDate)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: add.php"); // Redirect back to the form
        exit();
    }

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO admin_table (customer_fullname, customer_email, customer_phone, booked_car_model, booked_service_type, booking_date, service_name, service_date, contact_registration_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        // Check if statement preparation failed
        $_SESSION['error'] = "Error preparing the statement: " . $conn->error;
        header("Location: add.php");
        exit();
    }

    // Bind the parameters to the SQL query
    $stmt->bind_param("sssssssss", $fullname, $email, $phone, $carModel, $serviceType, $bookingDate, $serviceName, $serviceDate, $contactRegDate);

    // Execute the prepared statement
    if ($stmt->execute()) {
        $_SESSION['success'] = "Record added successfully!";
        header("Location: index.php"); // Redirect to your success page
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: add.php"); // Redirect back to the form
        exit();
    }

    // Close the prepared statement
    $stmt->close();
    
    // Close the database connection
    mysqli_close($conn);
}
?>
