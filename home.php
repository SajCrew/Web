<?php
const HOST = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DATABASE = 'blog';

function createDBConnection(): mysqli
{
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


function closeDBConnection(mysqli $conn): void
{
    $conn->close();
}


function getFeaturePosts(mysqli $conn, &$posts_featured): void
{
    $sql = "SELECT * FROM post WHERE featured = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts_featured[] = $row;
        }
    }
}

function getMostRecentPosts(mysqli $conn, &$posts_most): void
{
    $sql = "SELECT * FROM post WHERE featured = 0";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts_most[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab_2</title>
    <link href="Css/index.css" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="header__menu">
            <a class="header__logo" href="home.php">Escape.</a>
            <nav class="navigation navigation_header">
                <a class="navigation__text" href="home.php">home</a>
                <a class="navigation__text" href="home.php">categories</a>
                <a class="navigation__text" href="home.php">about</a>
                <a class="navigation__text" href="home.php">contact</a>
            </nav>
        </div>
        <div class="header__context">
            <h1 class="header__context-title">Let's do it together.</h1>
            <h4 class="header__context-description">We travel the world in search of stories. Come along for
                the ride.</h4>
            <a class="button" href="post.php"> View Latest Posts </a>
        </div>
    </header>

    <section class="section">
        <nav class="section_nav">
            <a class="section_nav__link" href="post.php">Nature</a>
            <a class="section_nav__link" href="post.php">Photography</a>
            <a class="section_nav__link" href="post.php">Relaxation</a>
            <a class="section_nav__link" href="post.php">Vacation</a>
            <a class="section_nav__link" href="post.php">Travel</a>
            <a class="section_nav__link" href="post.php">Adventure</a>
        </nav>
        <div class="section_unit section_unit__background">
            <div class="section_cards">
                <h2 class="section__title">Featured Posts</h2>
                <div class="cards">
                    <?php 
                    $posts_featured = [];
                    $conn = createDBConnection();
                    getFeaturePosts($conn, $posts_featured);
                    closeDBConnection($conn);
					foreach ($posts_featured as $post) {
						include 'post_preview_featured.php';
					}
					?>
                </div>
            </div>
            <div class="section_box">
                <h2 class="section__title">Most Recent</h2>
                <div class="boxes">
                    <?php
                    $posts_most = [];
                    $conn = createDBConnection();
                    getMostRecentPosts($conn, $posts_most);
                    closeDBConnection($conn); 
					foreach ($posts_most as $post) {
						include 'post_preview_most.php';
					}
					?>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="subscription-form">
            <label class="subscription-form__label">Stay in Touch</label>
            <div class="subscription-form__input-section">
                <input class="subscription-form__input-field" id="input" placeholder="Enter your email address">
                <a class="subscription-form__submit-button">Submit</a>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__menu">
                <a class="footer__logo" href="#">Escape.</a>
                <nav class="navigation navigation_footer">
                    <a class="navigation__item navigation__item_footer">home</a>
                    <a class="navigation__item navigation__item_footer">categories</a>
                    <a class="navigation__item navigation__item_footer">about</a>
                    <a class="navigation__item navigation__item_footer">contact</a>
                </nav>
            </div>
        </div>
    </footer>
</body>
</html>