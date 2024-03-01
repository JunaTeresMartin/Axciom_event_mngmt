<!-- admin_signup.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $category = $_POST["category"];

   
    $conn = new mysqli("localhost", "root", "", "event_management");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (name, email, password, category) VALUES ('$name', '$email', '$password', '$category')";

    if ($conn->query($sql) === TRUE) {
        echo "Admin registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!-- admin_signup.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
</head>
<body>
    <h2>Admin Sign Up</h2>
    <form action="admin_signup.php" method="post">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        Category: 
        <select name="category">
            <option value="category1">Category 1</option>
            <option value="category2">Category 2</option>
           
        </select><br>
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>

<!-- admin_login.php -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $email = $_POST["email"];
    $password = $_POST["password"];

   
    $conn = new mysqli("localhost", "username", "password", "event_management");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE email = '$email' AND category = 'admin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["admin_id"] = $row["id"];
            header("Location: admin_dashboard.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Admin not found";
    }

    $conn->close();
}
?>

<!-- admin_login.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form action="admin_login.php" method="post">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
