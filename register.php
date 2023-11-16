<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    // Check if the username already exists
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "Error: Username already exists. Please choose a different username.";
    } else {
        // Insert new user
        $insertStmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sss", $username, $password, $email);

        if ($insertStmt->execute()) {
            echo "Registration successful! <a href='index.html'>Go back to login</a>";
        } else {
            echo "Error: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>
