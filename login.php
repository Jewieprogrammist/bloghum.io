<?php
    session_start();
    if(isset($_SESSION["user"])){
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php 
        if(isset($_POST["submit"])){
            
            $email = $_POST["email"];
            $password = $_POST["password"];

            $conn = mysqli_connect("localhost", "root", "", "blog project");
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $res = $conn->query($sql);
            $row = mysqli_fetch_assoc($res);

            if ($row && password_verify($password, $row["password"])){
                $_SESSION["user"] = $row["username"];
                header("location: index.php");
            } else {
                echo 
                "
                <div class='alert alert-danger'>
                    Invalid email or password!
                </div>
                ";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Login">
                <a href="registration.php" class="page-register">Don't have an account? Register here</a>
            </div>
        </form>
    </div>
</body>
</html>
