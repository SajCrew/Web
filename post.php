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


    function getPostContent(mysqli $conn, string $idFind, &$post): void
    {
        $sql = "SELECT * FROM post WHERE post_id = $idFind";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $post = $row;
            }
        } else {
            $post = null;
        }
    }

    $post = [];
    $postId = $_GET['id'];
    if ($postId == null) {
        header('Location: https://youtu.be/jDYRnlNLF8g?t=9');
        exit();
    }
    $conn = createDBConnection();
    getPostContent($conn, $postId, $post);
    closeDBConnection($conn);
    if ($post == null) {
        header('Location: https://youtu.be/jDYRnlNLF8g?t=9');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $post['title']?></title>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="Css/post.css" rel="stylesheet"> 
</head>

<body>
    <header class="header">
        <div class="header__content-area">
            <a class="header__logo" href="home.php">Escape.</a>
            <nav id="menu" class="navigation">
				<input type="checkbox" name="menu" id="btn-menu" />
				<label class="label" for="btn-menu"> <img class="logo" src='../images/Menu.png'> </label> 
				<ul class="unordered-list">
					<li class="list"> <a class="navigation__item navigation__item_header" href="#" >home</a> </li>
					<li class="list"> <a class="navigation__item navigation__item_header" href="#" >categories</a> </li>
					<li class="list"> <a class="navigation__item navigation__item_header" href="#" >about</a> </li>
					<li class="list"> <a class="navigation__item navigation__item_header" href="#" >contact</a> </li>
				</ul>
            </nav>
        </div>
    </header>
    <div class="post-content">
        <div class="post-content__tilte-area">
            <h1 class="post-content__title"><?= $post['title']?></h1>
            <h2 class="post-content__subtitle"><?= $post['subtitle']?></h2>
        </div>
        <div>
		  <img class="post-content__image" src=<?= $post['image_url']?> alt='img'>
		</div>
        <div class="post-content__text-area">
            <p class="post-content__text"><?= $post['content']?></p>
        </div>
    </div>
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