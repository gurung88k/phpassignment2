<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./css/site.css" />
    <script src="./js/scripts.js" defer></script>
</head>
<body>
    <header id="navbar">
      <nav class="navbar-container container">
        <a href="mainpage.php" class="home-link">
          <div class="navbar-logo"></div>
          Apple
        </a>
        <button
          type="button"
          class="navbar-toggle"
          aria-label="Toggle menu"
          aria-expanded="false"
          aria-controls="navbar-menu"
        >
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div id="navbar-menu" class="detached">
          <ul class="navbar-links">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
              session_start();
            }         
            
            if (!empty($_SESSION['username'])) {
              echo '<li class="navbar-item">
                <a class="navbar-link" href="add-product.php">Add Product</a>
              </li>';
            }            
            ?>
            <li class="navbar-item">
              <a class="navbar-link" href="products.php">Show Library</a>
            </li>
            <?php
            if (!empty($_SESSION['username'])) {
              echo '<li class="navbar-item">
                <a class="navbar-link" href="add-category.php">Add Category</a>
              </li>
              <li class="navbar-item">
                <a class="navbar-link" href="logout.php">Logout</a>
              </li>
              <li class="navbar-item">
                <a class="navbar-link" href="#">' . $_SESSION['username'] . '</a>
              </li>';
            } 
            else {
              echo '<li class="navbar-item">
                <a class="navbar-link" href="register.php">Register</a>
              </li>
              <li class="navbar-item">
                <a class="navbar-link" href="login.php">Login</a>
              </li>';
            }
            ?>
          </ul>
        </div>
      </nav>
    </header>
