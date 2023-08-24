<?php
// Database connection parameters
$servername = "127.0.0.1"; // Replace with your database server address if it's different
$username = "admin"; // Replace with your database username
$password = "hello"; // Replace with your database password
$dbname = "v"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the verification code is submitted
if (isset($_POST['verificationCode'])) {
    // Sanitize and escape the user input to prevent SQL injection
    $verificationCode = $conn->real_escape_string($_POST['verificationCode']);

    // Query the database based on the verification code
    $sql = "SELECT * FROM your_table WHERE verification_code = '$verificationCode'";
    $result = $conn->query($sql);

    // Check if any matching data is found
    if ($result->num_rows > 0) {
        // Fetch the data and prepare it for display
        $row = $result->fetch_assoc();
        $dataToDisplay = "Name: " . $row['name'] . "<br>Email: " . $row['email']; // Replace 'name' and 'email' with your database column names
        echo $dataToDisplay; // Return the data to the verification page
    } else {
        echo "No data found for the provided verification code.";
    }
}

$conn->close();
?>
