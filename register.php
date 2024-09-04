<?php
$servername = "localhost";
$username = "Rizwan";
$password = "12345678";
$dbname = "registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $email = $conn->real_escape_string($_POST['email']);
    $course = $conn->real_escape_string($_POST['course']);
    $purpose = $conn->real_escape_string($_POST['purpose']);
    $fees = $conn->real_escape_string($_POST['fees']);
    $goal = $conn->real_escape_string($_POST['goal']);

    $sql = "INSERT INTO workshop_1 (name, contact, email, course, purpose, fees, goal) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdis", $name, $contact, $email, $course, $purpose, $fees, $goal);

    if ($stmt->execute()) {
        echo "<div class='success'>Registration successful!</div>";
    } else {
        echo "<div class='error'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>
