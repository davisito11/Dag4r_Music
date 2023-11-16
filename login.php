<?php
require_once('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Inicio de sesión exitoso
        $_SESSION['username'] = $username; // Almacenar el nombre de usuario en la sesión
        header("Location: page.html");
        exit();
    } else {
        echo "Invalid username or password. <a href='index.html'>Go back to login</a>";
        
    }

    $stmt->close();
    $conn->close();
}
?>
