<?php
$conn = mysqli_connect("localhost", "root", "", "blog project"); // Ensure the correct database name

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM posts WHERE id = $post_id";
$res = $conn->query($query);

if ($res->num_rows == 0) {
    die("Post not found");
}

$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['title']; ?> - Blog Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="mainpage.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index.php">Blog</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="navbar-brand" href="index.php">My office</a>
                        <ul class="drop-panel">
                            <li class="nav-item">
                                <a class="navbar-brand drops-item" href="#">Admin Panel</a>
                            </li>
                            <li class="nav-item">
                                <a class="navbar-brand drops-item" href="users.php">All users</a>
                            </li>
                            <li class="nav-item">
                                <a class="navbar-brand logout drops-item" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="content row container">
        <div class="main-content col-md-9 col-12">
            <h2 class="main-content-title"><?php echo $row['title']; ?></h2>
            <div class="single_post row">
                <div class="img col-8">
                    <img src='images/<?php echo $row['image']; ?>' class="img-thumbnail">
                </div>
                <div class="info">
                    <i class="far fa-user">Artem</i>
                    <i class="far fa-calendar"><?php echo $row['created_date']; ?></i>
                </div>
                <div class="single_post_text col-12">
                    <?php echo $row['content']; ?>
                </div>
            </div>
        </div>
        <div class="sidebar col-md-3 col-12">
            <div class="section search">
                <h4>Search</h4>
                <form action="/" method="post">
                    <input type="text" name="search-inp" class="input-search" placeholder="Keyword...">
                </form>
            </div>
            <div class="section categories">
                <h4>Categories</h4>
                <ul>
                    <li><a href="#">Sport</a></li>
                    <li><a href="#">Animals</a></li>
                    <li><a href="#">Music</a></li>
                    <li><a href="#">Programming</a></li>
                    <li><a href="#">Games</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer container-fluid">
        <div class="footer-content container">
            <div class="row">
                <div class="footer-section about col-md-4 col-12">
                    <h4 class="logo-text">
                        My blog
                    </h4>
                    <p>
                        Blog - is a website whose main content is regularly added user posts containing text, images or multimedia.
                    </p>

                    <p class="email-info">info@bloghuman.com</p>

                </div>
                <div class="footer-section links col-md-4 col-12">
                    <h4>Searched links</h4>
                    <ul>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                        <li>
                            <a href="#">Posts</a>
                        </li>
                        <li>
                            <a href="#">Gallery</a>
                        </li>
                        <li>
                            <a href="#">Other...</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-section contact-form col-md-4 col-12">
                    <h4>Contacts</h4>
                    <form action="index.php" method="post">
                        <input type="email" name="email" class="text-input contact-input" placeholder="Email">
                        <textarea rows="4" name="message" class="text-input contact-input" placeholder="Message"></textarea>
                        <button type="submit" class="btn btn-big contact-btn">
                            Send
                        </button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; bloghum.com | Created by Artem Lenko
            </div>
        </div>
    </div>
</body>

</html>
