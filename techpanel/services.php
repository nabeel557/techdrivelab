<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_errors', 0);  // Disable displaying errors
ini_set('log_errors', 1);       // Enable error logging
error_reporting(E_ALL);
include('header.php');

// Database connection settings
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

// Query to fetch data from the table
$query = "SELECT * FROM services"; // Change "services" to your table name
$result = $conn->query($query);

if ($result === false) {
    echo "Error: " . $conn->error;
    exit; // Stop script execution if the query fails
}
?>

<style>
    /* Fade in animation for table rows */
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

/* Apply animation to table rows */
.table tbody tr {
    opacity: 0; /* Start hidden */
    animation: fadeIn 0.5s ease forwards; /* Fade in effect */
}

.table tbody tr:nth-child(even) {
    animation-delay: 0.1s; /* Add a slight delay for even rows */
}

.table tbody tr:nth-child(odd) {
    animation-delay: 0.2s; /* Add a slight delay for odd rows */
}

.table tbody tr {
    animation-duration: 0.5s; /* Duration of the animation */
}

</style>

<!-- Recent Services Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0">Recent Services </h4>
        </div>
        <div class="table-responsive">
            <table id="salesTable" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Services</th>
                        <th scope="col">Services Date</th>
                        <th scope="col">Special Request</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['services']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['services_date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['special_request']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                            echo "<td>
                                    <a href='view.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-info btn-sm'>View</a>
                                    <a href='edit.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Services End -->

<script>
$(document).ready(function() {
    $('#salesTable').DataTable();
});
</script>

<?php
include('footer.php');
?>
