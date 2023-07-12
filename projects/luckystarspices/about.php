<!-- Created: 3/3/23 By: Marisa Cunningham -->

<?php
    $page_name = 'LSS: About';
    include ('includes/header.php');
?>

<main class="overflow-hidden">

    <div class="aboutsection1"> 
    </div>

    <div class="aboutsection2 text-center">
        <p>We decided to start this business because some spices can be hard to obtain, or you can only get the spice in a large quantity.</p>
    </div>
    <br><br><br>
    <div class="aboutsection3 row justify-content-center">
        <div class="col-lg-6">
            <p>Whether you need to buy in bulk or would need a small sample to try, you can trust us to provide you with…</p>
            <ul>
                <li>Fresh,</li>
                <li>High-Quality,</li>
                <li>And Ethically Sourced Spices.</li>
            </ul>
        </div>
        <!-- Carousel -->
        <div id="aboutCarousel" class="carousel slide col-lg-4 col-md-4 col-sm-8" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slide1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/slide2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/slide3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    
</main>
<!-- END OF MAIN -->

<!--Attach footer-->
<?php
    include ('includes/footer.php');
?>