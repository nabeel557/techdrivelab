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

// Check if 'id' is present in the URL for editing
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID input

    // Query to fetch the specific order
    $query = "SELECT * FROM cart_orders WHERE id = $id";
    $result = $conn->query($query);

    if ($result === false) {
        echo "<p class='text-danger'>SQL Error: " . $conn->error . "</p>"; // Output SQL error if the query fails
    } elseif ($result->num_rows == 0) {
        echo "<p class='text-danger'>No record found with ID: $id</p>"; // No record found
    } else {
        $row = $result->fetch_assoc(); // Fetch the record
    }
}

// Update record logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Sanitize the ID input
    $quantity = $conn->real_escape_string($_POST['quantity']);
    $name = $conn->real_escape_string($_POST['name']);
    $product_name = $conn->real_escape_string($_POST['product_name']);
    
    // Optional: Include a check to ensure the new ID is unique if the ID is being updated
    if (isset($_POST['new_id']) && is_numeric($_POST['new_id'])) {
        $new_id = intval($_POST['new_id']);
        // Update query to also change the ID
        $updateQuery = "UPDATE cart_orders SET id = '$new_id', quantity = '$quantity', name = '$name', product_name = '$product_name' WHERE id = $id";
    } else {
        $updateQuery = "UPDATE cart_orders SET quantity = '$quantity', name = '$name', product_name = '$product_name' WHERE id = $id";
    }

    if ($conn->query($updateQuery) === TRUE) {
        echo "<p class='text-success'>Record updated successfully.</p>";
        // Optionally redirect to another page after successful update
        header("Location: index.php");
        exit();
    } else {
        echo "<p class='text-danger'>Error updating record: " . $conn->error . "</p>";
    }
}

// Delete record logic
if (isset($_POST['delete'])) {
    // Perform deletion
    $deleteQuery = "DELETE FROM cart_orders WHERE id = $id";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "<p class='text-success'>Record deleted successfully.</p>";
        // Optionally redirect to the orders list page
        header("Location: orders.php");
        exit();
    } else {
        echo "<p class='text-danger'>Error deleting record: " . $conn->error . "</p>";
    }
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

<!-- Edit Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h4 class="mb-4">Update Order</h4>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'] ?? ''); ?>">
            <div class="form-group">
                <label for="new_id">New ID:</label>
                <input type="text" name="new_id" id="new_id" value="<?php echo htmlspecialchars($row['id'] ?? ''); ?>" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" id="quantity" value="<?php echo htmlspecialchars($row['quantity'] ?? ''); ?>" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($row['name'] ?? ''); ?>" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" id="product_name" value="<?php echo htmlspecialchars($row['product_name'] ?? ''); ?>" class="form-control" required>
            </div>
            <br>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <!-- Delete Form -->
        <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');" class="mt-3">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'] ?? ''); ?>">
            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<!-- Edit Form End -->

<?php
$conn->close();
include('footer.php');
?>
