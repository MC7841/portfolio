<?php
    # Page setup
    require ('includes/config.php');
    $page_name = 'LSS: Home';
    
    # Newsletter Post action
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require (MYSQL);
        $trimmed = array_map('trim', $_POST);
        $e = false;

        # Check email
        if (filter_var($trimmed['news_email'], FILTER_VALIDATE_EMAIL) ) {
            $e = mysqli_real_escape_string($dbc, $trimmed['news_email']);
        } else {
            $newsMessage = "Please enter a valid email address.";
        }

        # Pass email to db if data is valid
        if ($e) {

            $q = "SELECT news_id FROM newsletter_subs WHERE news_email = '$e' ";
            $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br>MYSQL Error: " . mysqli_error($dbc) );

            if (mysqli_num_rows($r) == 0) {

                $q = "INSERT INTO newsletter_subs (news_email, sub_date)
                VALUES ('$e', NOW() )";
                $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br>MYSQL Error: " . mysqli_error($dbc) );
                
                if (mysqli_affected_rows($dbc) == 1) {
                    # Email
                    $body = "Thanks for registering!\nThis is a website for a college course and the emails recieved will not be used for any purposes.\nVisit this link here [https://mc445.com/LSS/unsub.php] to remove your email.\n ";
                    mail($trimmed['news_email'], 'Thanks for Registering!', $body, 'From: mc445637@mc445.com');
                    echo '<script> location.replace("home.php?status=success"); </script>';
                    exit();
                } else {
                   $newsMessage = "Database error: Please try again later";
                }
            } else {
               $newsMessage = "Email is already registered";
            }
        } else {
            $newsMessage = "Email error: Please enter a valid email.";
        }
        mysqli_close($dbc);
    }
    include('includes/header.php');
?>
<main>
    <!-- Sale Banner -->
    <div class="sale-section overflow-hidden">
        <div class="row">
            <!--Image section-->
            <div class="saleouter col-lg-5 col-md-4">
                <div>
                    <img class="img-move w-100 h-100" src="images/whole-spices.jpg" alt="" >
                </div>
            </div>
            <!--Sale Description-->
            <div class="saleinner col-lg-7 col-md-8 col-sm-12 col-xs-12">
                <div class="sm-center offset-lg-2 offset-md-1 ">
                    <h2 class="saleDisplay">Two Day Flash Sale!</h2><br>
                    <p>Add some spice to your life with our new sample packs!</p>
                    <p>These discounted sample packs only lasts two days!</p>
                    <p>Sale runs through MM/DD – MM/DD </p><br>
                    <a class="btn btn-primary" href="shop.php">Shop Now!</a> 
                </div>
            </div>
        </div>
    </div>
    
    <!-- Display shop items *WORK IN PROGRESS Add php function to grab items from db *-->
    <div class="carousel-section">
        <h2 class="text-center"><b>Featured Products</b></h2>
        <div class="container">
            <div class="row align-items-center">
                <!-- Button Control -->
                <div id="carousel-btn1" class="col-1 text-center">
                    <button type="button" class="prev btn btn-primary">&lt;</button>
                </div>
                <div class="homecarousel row col-xl-10 col-lg-10 col-md-10 col-sm-auto align-self-center">
                    <!-- Load 6 Cards -->
                    <?php
                        require(MYSQL);
                        $sql = " SELECT products.product_id, products.product_img, products.product_alt, products.product_name, products.cat_id, product_pricing.product_id, product_pricing.price_sm
                                 FROM products, product_pricing
                                 WHERE product_pricing.product_id = products.product_id";

                        $q = mysqli_query($dbc, $sql) or trigger_error("Query: $q\n<br>MYSQL Error: " . mysqli_error($dbc) );
                        $row = mysqli_fetch_array($q, MYSQLI_ASSOC);

                        $counter = 0;
                        foreach ($q as $row) :
                            if ($counter == 6) {break;}
                        ?>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-auto align-items-stretch">
                            <div class="card text-center">
                                <img src="<?php echo $row['product_img']; ?>" class="card-img-top mx-auto" alt="<?php echo $row['product_alt']; ?>">
                                <div class="card-body">
                                    <p class="catID" hidden><?php echo $row['cat_id']; ?></p>
                                    <h5 class="card-title"><?php echo $row ['product_name']; ?></h5>
                                    <h6 class="Card-text cardPrice"><?php echo $row['price_sm']; ?></h6>
                                    <a href="#" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <?php $counter++;  ?>
                        <?php endforeach; ?>
                </div> 
                <!-- Button Control -->
                <div id="carousel-btn2" class="col-1 text-center">
                    <button type="button" class="next btn btn-primary">&gt;</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Section -->
    <div class="newsletter">
        <div class="container">
                <h4 class="text-center"><b>Sign-Up for Our Weekly Newsletter!</b></h4>
                <p class="text-center">Join our newsletter to receive information on sales and new items.</p>
                <!-- Newsletter Form -->
                <form class="row d-flex justify-content-center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input class="form-control w-auto" type="text" name="news_email" size="30" maxlength="40" value="<?php if (isset($trimmed['news_email'])) echo $trimmed['news_email']; ?>" > 
                    <div class="col-auto"><input class="btn btn-primary" id="submit" type="submit" name="submit" value="Submit"></div>
                </form>
                <p class="text-center">
                    <?php
                        # Send messages if form is submitted
                        if ($_SERVER['REQUEST_METHOD'] == 'POST')  { echo $newsMessage; }
                        if (isset($_GET['status'])) {echo 'Thanks for registering! If you used a real email address you should have an email confirming the process.';}
                    ?>
                </p>
        </div> 
    </div>
</main>
<!-- END OF MAIN -->
<!--Attach footer-->
<?php
    include ('includes/footer.php');
?>
