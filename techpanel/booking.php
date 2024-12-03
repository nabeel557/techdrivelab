<?php
include('header.php'); // Ensure this file is properly included if it contains any required headers or styles

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
}

// Query to fetch recent booking data from the database
$query = "SELECT * FROM booking"; // Replace 'booking' with your actual table name
$result = $conn->query($query);

if ($result === false) {
    // Output error and stop execution if query fails
    die("Query error: " . $conn->error);
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

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0">Recent Booking</h4>
        </div>
        <div class="table-responsive">
            <table id="salesTable" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Car Model</th>
                        <th scope="col">Services Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['carModel']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['serviceType']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                            echo "<td>
                                    <a href='view.php?id=" . htmlspecialchars($row['ID']) . "' class='btn btn-info btn-sm'>View</a>
                                    <a href='edit.php?id=" . htmlspecialchars($row['ID']) . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete.php?id=" . htmlspecialchars($row['ID']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<script>
$(document).ready(function() {
    $('#salesTable').DataTable();
});
</script>

<?php
$conn->close();

include('footer.php');
?>

