<?php
include('header.php');

// Database connection parameters
$servername = "localhost";
$username = "root"; // Update with your DB username
$password = ""; // Update with your DB password
$dbname = "techdrivelab"; // Update with your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Fetch the existing record based on Booking ID
    $query = "SELECT * FROM admin_table WHERE booking_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        echo "<p class='alert alert-danger'>Error preparing statement: " . $conn->error . "</p>";
        exit;
    }

    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p class='alert alert-danger'>No record found with Booking ID: $booking_id.</p>";
        exit; // Stop further execution
    }
} else {
    echo "<p class='alert alert-danger'>No Booking ID provided.</p>";
    exit; // Stop further execution
}

// Update record logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $booking_id = intval($_POST['booking_id']); // Sanitize the ID input
    $fullname = $conn->real_escape_string($_POST['CustomerFullname']);
    $email = $conn->real_escape_string($_POST['CustomerEmail']);
    $phone = $conn->real_escape_string($_POST['CustomerPhone']);
    $carModel = $conn->real_escape_string($_POST['BookedCarModel']);
    $serviceType = $conn->real_escape_string($_POST['BookServiceType']);
    $bookingDate = $conn->real_escape_string($_POST['BookingDate']);
    $serviceName = $conn->real_escape_string($_POST['ServiceName']);
    $serviceDate = $conn->real_escape_string($_POST['ServiceDate']);
    $contactRegDate = $conn->real_escape_string($_POST['ContactRegistrationDate']);

    // Perform update
    $updateQuery = "UPDATE admin_table SET customer_fullname = ?, customer_email = ?, customer_phone = ?, booked_car_model = ?, book_service_type = ?, booking_date = ?, service_name = ?, service_date = ?, contact_registration_date = ? WHERE booking_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sssssssssi", $fullname, $email, $phone, $carModel, $serviceType, $bookingDate, $serviceName, $serviceDate, $contactRegDate, $booking_id);

    if ($updateStmt->execute()) {
        echo "<p class='text-success'>Record updated successfully.</p>";
        header("Location: orders.php"); // Redirect to your success page
        exit();
    } else {
        echo "<p class='text-danger'>Error updating record: " . $updateStmt->error . "</p>";
    }
    $updateStmt->close();
}

// Delete record logic
if (isset($_POST['delete'])) {
    // Perform deletion
    $deleteQuery = "DELETE FROM admin_table WHERE booking_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $booking_id);

    if ($deleteStmt->execute()) {
        echo "<p class='text-success'>Record deleted successfully.</p>";
        header("Location: orders.php"); // Redirect to your orders list page
        exit();
    } else {
        echo "<p class='text-danger'>Error deleting record: " . $deleteStmt->error . "</p>";
    }
    $deleteStmt->close();
}
?>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">View Record</h2>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Booking Details</h4>
                <form action="" method="post">
                    <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($row['booking_id']); ?>">
                    <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($row['booking_id']); ?></p>
                    <div class="form-group">
                        <label for="CustomerFullname">Customer Fullname:</label>
                        <input type="text" name="CustomerFullname" id="CustomerFullname" value="<?php echo htmlspecialchars($row['customer_fullname']); ?>" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="CustomerEmail">Customer Email:</label>
                        <input type="email" name="CustomerEmail" id="CustomerEmail" value="<?php echo htmlspecialchars($row['customer_email']); ?>" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="CustomerPhone">Customer Phone:</label>
                        <input type="text" name="CustomerPhone" id="CustomerPhone" value="<?php echo htmlspecialchars($row['customer_phone']); ?>" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="BookedCarModel">Booked Car Model:</label>
                        <input type="text" name="BookedCarModel" id="BookedCarModel" value="<?php echo htmlspecialchars($row['booked_car_model']); ?>" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="BookServiceType">Book Service Type:</label>
                        <input type="text" name="BookServiceType" id="BookServiceType" value="<?php echo htmlspecialchars($row['booked_service_type']); ?> " class="form-control"required >
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="BookingDate">Booking Date:</label>
                        <input type="date" name="BookingDate" id="BookingDate" value="<?php echo htmlspecialchars($row['booking_date']); ?>" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ServiceName">Service Name:</label>
                        <input type="text" name="ServiceName" id="ServiceName" value="<?php echo htmlspecialchars($row['service_name']); ?>" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ServiceDate">Service Date:</label>
                        <input type="date" name="ServiceDate" id="ServiceDate" value="<?php echo htmlspecialchars($row['service_date']); ?>" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ContactRegistrationDate">Contact Registration Date:</label>
                        <input type="date" name="ContactRegistrationDate" id="ContactRegistrationDate" value="<?php echo htmlspecialchars($row['contact_registration_date']); ?>" class="form-control" required>
                    </div>
                    <br>
                </form>

                <!-- Delete Form -->
                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');" class="mt-3">
                    <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($row['booking_id']); ?>">
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
                <a href="index.php" class="btn btn-secondary mt-3">Back to List</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<?php
// Close connection
$stmt->close();
$conn->close();

include('footer.php');
?>
