<?php
    $conn = mysqli_connect("localhost", "root", "", "blog project");
    $id_post = $_GET["id"];
    $query = "DELETE FROM posts WHERE id = '$id_post'";
    $conn->query($query);
    header("location: index.php");
?>