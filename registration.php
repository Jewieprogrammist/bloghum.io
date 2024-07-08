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
            
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeatPassword = $_POST["repeat_password"];
            
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "E-mail is not valid!");
            }

            if(strlen($password) < 6){
                array_push($errors, "The password cannot be less than 6 characters!");
            }

            if($repeatPassword !== $password){
                array_push($errors, "Password mismatch!");
            }

            $conn = mysqli_connect("localhost", "root", "", "blog project");
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $res = $conn->query($sql);
            $rowCount = mysqli_num_rows($res);

            if ($rowCount > 0){
                array_push($errors, "This email already exists!");
            }

            if(!empty($errors)){
                foreach($errors as $error){
                    echo 
                    "
                    <div class='alert alert-danger'>$error</div>
                    ";
                }
            } else {
                $conn = mysqli_connect("localhost", "root", "", "blog project");

                if(!$conn){
                    die("Failed to connect");
                }

                $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

                $stmt = mysqli_stmt_init($conn);
                $prepareStatement = mysqli_stmt_prepare($stmt, $query);

                if($prepareStatement){
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo 
                    "
                        <div class='alert alert-success'>
                            User successfully registered
                        </div>
                    ";
                    header("location: login.php");
                }
            }
        }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Register">
                <a href="login.php" class="page-login">Already have an account?</a>
            </div>
        </form>
    </div>
</body>
</html>
