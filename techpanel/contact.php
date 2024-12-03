<?php
include('header.php');

// Define connection parameters
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

// Query to fetch recent booking data from the database
$query = "SELECT * FROM contact"; // Replace with your actual table name
$result = $conn->query($query);

if ($result === false) {
    echo "Error: " . $conn->error;
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


<!-- Recent Contacts Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0">Recent Contacts</h4>
        </div>
        <div class="table-responsive">
            <table id="contactsTable" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Reg Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";  // Start a new row
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['reg_date']) . "</td>";
                            echo "<td>
                                <a href='view.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-info btn-sm'>View</a>
                                <a href='edit.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                              </td>";
                            echo "</tr>"; // End the row
                        }
                    } else {
                        echo "<tr><td colspan='7'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Contacts End -->

<!-- Include DataTables JS and CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#contactsTable').DataTable(); // Initialize DataTables for contacts table
});
</script>

<?php
include('footer.php');
?>