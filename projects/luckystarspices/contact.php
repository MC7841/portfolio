<!-- Created: 3/13/23 By: Marisa Cunningham -->

<?php
    require ('includes/config.php');
    $page_name = 'LSS: Contact';

    # Form Post action
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require (MYSQL);
        $trimmed = array_map('trim', $_POST);
        $fn = $e = $m = false;

        # Check first name
        if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name']) ) {
            $fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
        } else {
           
        }

        # Check email
        if (filter_var($trimmed['contact_email'], FILTER_VALIDATE_EMAIL) ) {
            $e = mysqli_real_escape_string($dbc, $trimmed['contact_email']);
        } else {
        }
        
        if (preg_match('/^[a-zA-Z0-9 ! ? . \s \-]+$/i m', $trimmed['message']) ) {
            $m = mysqli_real_escape_string($dbc, $trimmed['message']);
        } else {
        }

        # Pass name, email, and message to db if data is valid
        if ($fn && $e && $m) {

            $q = "SELECT contact_id FROM contact_details WHERE contact_email = '$e' ";
            $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br>MYSQL Error: " . mysqli_error($dbc) );

            if (mysqli_num_rows($r) == 0) {

                $q = "INSERT INTO contact_details (first_name, contact_email, message, contact_date)
                VALUES ('$fn', '$e', '$m', NOW() )";
                $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br>MYSQL Error: " . mysqli_error($dbc) );
                
                if (mysqli_affected_rows($dbc) == 1) {
                    # Email
                    $body = "We have received your message.\nThis is a website for a college course and the emails recieved will not be used for any purposes.\n ";
                    mail($trimmed['contact_email'], 'We got your message!', $body, 'From: mc445637@mc445.com');
                    echo '<script> location.replace("contact.php?status=success"); </script>';
                    exit();
                } else {
                   $regMessage = "Database error: Please try again later";
                }
            } else {
                $regMessage = "We already have your message";
            }
        } else {
            $regMessage = "Input error: Please check the input fields";
        }
        mysqli_close($dbc);
    }
    include ('includes/header.php');
?>

<main class="enableCount">
    <!--Section 1: Page introduction-->
    <div class="contactsection1">
        <!-- Image Attribute for Image
        <a href="https://www.freepik.com/free-vector/spices-kitchen-pattern_1380864.htm#query=spices&position=27&from_view=keyword&track=sph">Image by nenilkime</a> on Freepik -->
        <h1 class="text-center"><mark>Get in touch</mark></h1>
    </div>

    <!--Section 2: Description and Form-->
    <div class="contactsection2  mx-auto">
        <!--Description-->
        <div class="formdescription text-center">
            <h2><b>Have any questions for us?</b></h2>
            <p>Use the form below to send us a message. We'll do our best to get back to you soon!</p>
        </div>
        <!--Form-->
        <div class="container row mx-auto">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <fieldset class="form-control p-5 justify-content-center">
                    <div class="row mb-3">
                        <label class="form-label" for="first_name"><b>First Name: </b></label>
                        <input class="form-control" id="first_name" type="text" name="first_name" size="30" maxlength="50" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>">
                    </div>
                    <div class="row mb-3">
                        <label class="form-label" for="contact_email"><b>Email: </b></label>
                        <input class="form-control" id="contact_email" type="text" name="contact_email" size="30" maxlength="100" value="<?php if (isset($trimmed['contact_email'])) echo $trimmed['contact_email']; ?>">
                    </div>
                    <div class="row mb-3">
                        <label class="form-label" for="message"><b>Message Remaining Characters: </b><span id="remainder"></span></label>
                        <textarea class="form-control" id="message" name="message" rows="3" maxLength="300" value="<?php if (isset($trimmed['message'])) echo $trimmed['message']; ?>"></textarea>
                    </div>
                    <div class="row mb-3">
                        <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Submit">
                    </div> 
                </fieldset>
            </form><br>
            <p class="text-center">
                <?php
                    # Send messages if form is submitted
                    if ($_SERVER['REQUEST_METHOD'] == 'POST')  { echo $regMessage;}
                    if (isset($_GET['status'])) {echo 'Thanks for the message! If you used a real email address you should have an email confirming the process.';}
                ?>
            </p>
        </div>
</main>

<!--Attach footer-->
<?php
    include ('includes/footer.php');
?>