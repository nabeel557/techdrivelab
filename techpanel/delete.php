<?php

include('header.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "techdrivelab"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Uncomment for testing connection
    // echo "Connected successfully<br>";
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletebtn'])) {
    $identifier = $_POST['identifier'];

    // Check if the identifier is numeric (assumed to be ID) or string (assumed to be fullname)
    if (is_numeric($identifier)) {
        // It's a Booking ID
        $sql_check = "SELECT * FROM booking WHERE ID = {$identifier}";
    } else {
        // It's a Customer Fullname
        $sql_check = "SELECT * FROM booking WHERE fullname = '" . mysqli_real_escape_string($conn, $identifier) . "'";
    }

    $result_check = mysqli_query($conn, $sql_check);
    if (!$result_check) {
        echo "Query Error: " . mysqli_error($conn); // Output error if the query fails
        exit; // Stop further execution
    }

    if (mysqli_num_rows($result_check) > 0) {
        // If the record exists, get the record details
        $record = mysqli_fetch_array($result_check);
        
        // Start transaction
        mysqli_begin_transaction($conn);

        try {
            // Delete from the booking table using the ID
            $sql_delete = "DELETE FROM booking WHERE ID = {$record['ID']}";
            if (mysqli_query($conn, $sql_delete)) {
                // Commit transaction if delete is successful
                mysqli_commit($conn);
                echo "<p class='alert alert-success'>Record Deleted Successfully.</p>";
            } else {
                // Rollback transaction if delete fails
                mysqli_rollback($conn);
                echo "<p class='alert alert-danger'>Error deleting record: " . mysqli_error($conn) . "</p>";
            }
        } catch (Exception $e) {
            // Rollback transaction on exception
            mysqli_rollback($conn);
            echo "<p class='alert alert-danger'>Error deleting record: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>No record found with the provided ID or Name.</p>";
    }

    mysqli_close($conn);
}
?>

<style>
    /* Fade in animation for the form */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px); /* Start slightly below */
        }
        to {
            opacity: 1;
            transform: translateY(0); /* End in original position */
        }
    }

    .container-fluid {
        animation: fadeIn 0.5s ease forwards; /* Apply fade-in effect to the container */
    }

    /* Focus effect for form inputs */
    .form-control:focus {
        border-color: #dc3545; /* Change border color on focus */
        box-shadow: 0 0 5px rgba(220, 53, 69, 0.5); /* Add a subtle shadow */
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for border and shadow */
    }
</style>

    <div class="container">
        <h4 class="mt-5">Delete Record</h4>
        <form method="POST" action="">
            <div class="form-group">
                <label for="identifier">Enter ID or Fullname</label>
                <input type="text" class="form-control" name="identifier" id="identifier" required>
            </div>
            <br>
            <button type="submit" class="btn btn-danger" name="deletebtn">Delete</button>
        </form>
    </div>

  
<?php
include('footer.php');
?>
