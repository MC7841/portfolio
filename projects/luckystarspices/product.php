<?php
    # Page setup
    require_once('includes/config.php');

    # Get id from url
    $id = $_GET['id'];
    
    # Use query to get values
    require(MYSQL);
    $sql = "SELECT products.product_id, products.product_img, products.product_alt, products.product_name, products.product_description, products.cat_id, products.quantity, product_pricing.product_id, 
                    product_pricing.price_sm, product_pricing.price_md, product_pricing.price_lg
            FROM products, product_pricing
            WHERE product_pricing.product_id = products.product_id AND $id = products.product_id";
    $q = mysqli_query($dbc, $sql) or trigger_error("Query: $q\n<br>MYSQL Error: " . mysqli_error($dbc) );
    $row = mysqli_fetch_array($q, MYSQLI_ASSOC);

    $page_name = 'LSS: ' . $row['product_name'];
    include('includes/header.php');
?>
<main class="overflow-hidden">
    <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-12 image-section d-flex justify-content-center">
            <!-- Product Image -->
            <img class="w-75" src="<?php echo $row['product_img']; ?>" alt="<?php echo $row['product_alt']; ?>">
        </div>
        <div class="col-lg-7 col-md-12 col-sm-12 product-details">
            <!-- Product Details and Options -->
            <div class="ps-2 ms-2">
                <h1 class="display-3"><?php echo $row['product_name']; ?></h1>
                <h2 id="priceChange" class="display-4">
                    <?php 
                        if (isset($_POST['smButton'])) {
                            echo $row['price_sm'];
                        }
                        else if (isset($_POST['mdButton'])) {
                            echo $row['price_md'];
                        }
                        else if (isset($_POST['lgButton'])) {
                            echo $row['price_lg'];
                        } else {
                            echo $row['price_sm'];
                        }
                    ?>
                </h2>
                <p class="h5 pt-2"><?php echo $row['product_description']; ?></p><br>
                <h6 class="h5 pt-1">Size</h6>
                <div class="row me-5 gap-2 w-50">
                    <form id="buttonset1" class="row col-12 g-2" method="post">
                        <button class="col-lg-3 col-sm-12 btn btn-primary me-2" id="smButton" type="submit" name="smButton">Small</button>
                        <button class="col-lg-3 col-sm-12 btn btn-primary me-2" id="mdButton" type="submit" name="mdButton">Medium</button>
                        <button class="col-lg-3 col-sm-12 btn btn-primary me-2" id="lgButton" type="submit" name="lgButton">Large</button>
                    </form>
                </div><br>
                <div class="row w-50">
                    <form id="buttonset2" class="row g-2 gx-5 align-content-center" method="post" action="cart.php?action=add&id=<?php echo $row["product_id"]; ?>&size=<?php
                        if (isset($_POST['smButton'])) {
                           echo 'Small';
                        }
                        else if (isset($_POST['mdButton'])) {
                            echo 'Medium';
                        }
                        else if (isset($_POST['lgButton'])) {
                            echo 'Large';
                        } else {
                            echo 'Small';
                        }
                         ?>" name="addToCart">
                        <input type="hidden" name="productID" value="<?php echo $row['product_id']; ?>">
                        <input type="hidden" name="productName" value="<?php echo $row['product_name']; ?>">
                        <input type="hidden" name="productImg" value="<?php echo $row['product_img']; ?>">
                        <input type="hidden" name="productAlt" value="<?php echo $row['product_alt']; ?>">
                        <input type="hidden" name="productSize" value="<?php
                        if (isset($_POST['smButton'])) {
                            echo 'Small';
                         }
                         else if (isset($_POST['mdButton'])) {
                             echo 'Medium';
                         }
                         else if (isset($_POST['lgButton'])) {
                             echo 'Large';
                         } else {
                             echo 'Small';
                         } ?>">

                        <input type="hidden" name="priceValue" value="<?php
                        if (isset($_POST['smButton'])) {
                            echo $row['price_sm'];
                        }
                        else if (isset($_POST['mdButton'])) {
                            echo $row['price_md'];
                        }
                        else if (isset($_POST['lgButton'])) {
                            echo $row['price_lg'];
                        } else {
                            echo $row['price_sm'];
                        }
                         ?>">
                        <button class="p-2 col-lg-2 col-sm-12 btn btn-primary me-2" onClick="increment()" type="button"> + </button>
                        <input class="col-lg-4 col-md-12 col-sm-12 me-2" type="number" name="itemQuantity" id="itemQuantity" value="1" min=1 max="<?php echo $row['quantity']; ?>">
                        <button class="p-2 col-lg-2 col-md-12 col-sm-12 btn btn-primary me-2" onClick="decrease()" type="button"> - </button>
                        <button class="p-2 col-lg-2 col-md-12 col-sm-12 btn btn-primary me-2" type="submit"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i></button>
                    </form>
                </div>
                <div class="row">
                    <p id="errMessage"></p>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- END OF MAIN -->
<!--Attach footer-->
<?php
    include ('includes/footer.php');
?>
