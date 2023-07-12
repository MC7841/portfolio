<?php
    # Setup Page
    require ('includes/config.php');
    $page_name = 'LSS: Unsubscribe';
    
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

            $q = "DELETE FROM newsletter_subs WHERE news_email = '$e' ";
            $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br>MYSQL Error: " . mysqli_error($dbc) );

            if (mysqli_affected_rows($dbc) == 1) {
                # Email
                $body = "You have Unregistered.\nThanks for testing out my email system!\n ";
                mail($trimmed['news_email'], 'You have Unregistered', $body, 'From: mc445637@mc445.com');
                echo '<script> location.replace("unsub.php?status=success"); </script>';
                exit();
            } else {
                $newsMessage = "Email already removed.";
            }
        } else {
            $newsMessage = "Database error: Please try again later";
            
        }

            
        mysqli_close($dbc);
    }
    include('includes/header.php');
?>

<main>
    <!--Unsubscribe form-->
    <div class="unsub-bg min-vh-100">
        <div class="container text-center">
            <h2>Unsubscribe</h2>
            <p>Please enter your email address below to remove your email from our newsletter.</p>
        </div>
        <form class="row d-flex justify-content-center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input class="form-control w-auto" type="text" name="news_email" size="30" maxlength="60" value="<?php if (isset($trimmed['news_email'])) echo $trimmed['news_email']; ?>" >
            <div class="col-auto"><input class="btn btn-primary" id="submit" type="submit" name="submit" value="Submit"></div>
        </form>
        <p class="text-center">
            <?php
                # Send messages if form is submitted
                if ($_SERVER['REQUEST_METHOD'] == 'POST')  { echo $newsMessage; }
                if (isset($_GET['status'])) {echo 'You have unregistered your email. You will receive another email confirming this action.';}
            ?>
        </p>
    </div>
</main>
<!--END OF MAIN-->
<!--Attach Footer-->
<?php
    include ('includes/footer.php');
?>