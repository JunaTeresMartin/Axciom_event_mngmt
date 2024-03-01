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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
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
                    <li><a href="admin_login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container main">
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
            <input type="submit" value="Sign Up" onclick="login_page()">
        </form>
    </div>
    <script>
        function login_page(){
                windows.location.href = "admin_login.php";
            }
    </script>
</body>
</html>
