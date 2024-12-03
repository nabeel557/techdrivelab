<?php
include('header.php');
ini_set('display_errors', 0);  // Disable displaying errors
ini_set('log_errors', 1);       // Enable error logging
error_reporting(E_ALL);           // Report all types of errors

// Database connection parameters
$servername = "localhost";
$username = "root";  // Update with your database username
$password = "";      // Update with your database password
$dbname = "techdrivelab"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch recent orders from the database
$query = "SELECT * FROM cart_orders";  // Update 'cart_orders' to your actual table name
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

<!-- Recent Orders Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0">Recent Orders</h4>
        </div>
        <div class="table-responsive">
            <table id="ordersTable" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">Postal Code</th>
                        <th scope="col">Country</th>
                        <th scope="col">Card Number</th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col">CVV</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  // Assuming your table is cart_orders and it has a column 'id'
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        // Ensure that 'id' is the correct column name
        echo "<td>" . htmlspecialchars($row['id']) . "</td>"; // Line 57
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['city']) . "</td>";
        echo "<td>" . htmlspecialchars($row['postal_code']) . "</td>";
        echo "<td>" . htmlspecialchars($row['country']) . "</td>";
        echo "<td>" . htmlspecialchars($row['card_number']) . "</td>";
        echo "<td>" . htmlspecialchars($row['expiry_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cvv']) . "</td>";
        echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
        echo "<td>
            <a href='view.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-info btn-sm'>View</a>
            <a href='edit.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm'>Edit</a>
            <a href='delete.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
            </td>"; // Line 70-72
        echo "</tr>";
    }
}

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Orders End -->

<script>
$(document).ready(function() {
    $('#ordersTable').DataTable();
});
</script>

<?php
include('footer.php');
?>
