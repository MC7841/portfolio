<?php ob_start();?>
<?php if (!headers_sent() ){session_start(); } ?>
<?php 
    if (!isset($page_name) ) {
        $page_name = 'Lucky Star Spices';
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <title> <?php echo $page_name; ?> </title>
        <!-- ADD META DATA HERE LATER -->
        <!-- Load custom styles and JavaScript -->
        <link rel="stylesheet" href="css/styles.css" >
        <!-- Load Bootstrap styles and JavaScript -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <!-- Load fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Overlock:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
        <!-- Load Slick Carousel -->
        <link rel="stylesheet" type="text/css" href="plugins/slick/slick.css">
        <!-- Font Awesome -->
        <script src="js/9a0579c196.js" crossorigin="anonymous"></script>
    </head>
    <body class="min-vh-100">
        <div class="overflow-hidden">
            <!--Title block -->
            <div class="title-block row ">
                <div class="col-lg-4 col-md-4 col-sm-12" >
                    <!--Holds site title-->
                    <h1 class="sitename">Lucky Star Spices</h1>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <!--Holds Search Bar-->
                    <input type="text" id="searchInput" class="form-control input-fix" onkeyup="searchFunction()" placeholder="Search..." title="Type spice name">
                </div>
                <div class="text-center row col-lg-4 col-md-4 col-sm-12">
                    <!--Holds buttons for profile and cart-->
                    <p class="col-6"><a href="#"><i class="fa-solid fa-user" style="color: #ffffff; font-size: 26px"></i></a></p>
                    <p class="col-6"><a href="cart.php"><i class="fa-solid fa-cart-shopping" style="color: #ffffff; font-size: 26px"></i></a></p>
                </div>
            </div>

            <!-- Nav -->
            <div class="navbar navbar-expand-lg text-center nav-container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="nav-hover collapse navbar-collapse" id="navbarNavAltMarkup">
                    <!--Home-->
                    <div class="navitem col-3"><a href="home.php">Home</a></div>
                    <!--Shop-->
                    <div class="navitem col-3"><a href="shop.php">Shop</a></div>
                    <!--About-->
                    <div class="navitem col-3"><a href="about.php">About</a></div>
                    <!--Contact-->
                    <div class="navitem col-3"><a href="contact.php">Contact</a></div>
                </div>
            </div>

        </div>
        <!-- END OF HEADER -->