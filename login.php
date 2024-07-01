<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";  // Default XAMPP MySQL username
$password = "";      // Default XAMPP MySQL password
$dbname = "exam";    // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form input
$std_number = $_POST['std_number'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT AccountType FROM login WHERE std_number = ? AND password = ?");
$stmt->bind_param("ss", $std_number, $password);

// Execute query
$stmt->execute();
$stmt->bind_result($account_type);
$stmt->fetch();

if ($account_type) {
    // Credentials are correct
    if ($account_type == "admin") {
        header("Location: dashboard.html");
    } elseif ($account_type == "examinee") {
        header("Location: s_dashboard.html");
    }
} else {
    // Invalid credentials
    echo "<script>alert('Your student number or password is incorrect'); window.location.href = 'index.html';</script>";
}

// Close connection
$stmt->close();
$conn->close();
?>
