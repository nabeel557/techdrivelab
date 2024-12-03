<?php
include('header.php');

// Database connection
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

// Query to fetch feedback data
$sql = "SELECT ID, Username, Email, Feedback FROM feedback";  // Assuming your table is 'feedback'
$result = $conn->query($sql);

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

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Recent Feedback</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>"; 
            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Feedback']) . "</td>";
            echo "<td>
                <a href='view.php?id=" . htmlspecialchars($row['ID']) . "' class='btn btn-info btn-sm'>View</a>
                <a href='edit.php?id=" . htmlspecialchars($row['ID']) . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='delete.php?id=" . htmlspecialchars($row['ID']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }
    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
