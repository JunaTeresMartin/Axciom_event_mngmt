<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle admin login logic
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $conn = new mysqli("localhost", "root", "", "event_management");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE email = '$email' AND category = 'admin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["admin_id"] = $row["id"];
            header("Location: admin_login.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Admin not found";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="logo">
                <h1>Event Management</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="admin_signup.html">Sign Up</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container main">
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="post">
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="Login">
            <a href="admin_signup.php">Sign Up</a>
        </form>
    </div>
</body>
</html>
