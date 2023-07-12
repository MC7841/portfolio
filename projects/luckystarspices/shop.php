<?php
    require ('includes/config.php');
    $page_name = 'LSS: Shop';
    include ('includes/header.php');
?>

<main class="overflow-hidden">
    <div class="row ">
        <!--Sidebar-->
        <div class="shop-sidebar col-lg-2 col-md-2 col-sm-12 ">
            <div class="text-center navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="sidebarAltMarkup">
                    <table class="table table-sm text-center w-75 mx-auto" id="sidebar">
                        <thead>
                            <th scope="col">Sort & Filter</th>
                        </thead>
                        <tbody class="row">
                            <tr>
                                <td class="row">
                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseCategories" role="button" aria-expanded="false" aria-controls="collapseCategories">Filter by Category</a>
                                    <div class="collapse tablePadding" id="collapseCategories">
                                        <!-- Sort store items by categories-->
                                        <div class="row ">
                                            <div>
                                                <input type="checkbox" class="g1" id="whole_spice" name="whole_spice" value="whole_spice" onclick="wholeFilter()">
                                                <label for="whole_spice">Whole Spices</label>
                                                <br>
                                                <input type="checkbox" class="g1" id="ground_spice" name="ground_spice" value="ground_spice" onclick="groundFilter()">
                                                <label for="ground_spice">Ground Spices</label>
                                            </div> 
                                            <div>
                                                <!--<input type="checkbox" id="discounted_items" name="discounted_items" value="discounted_items">
                                                <label for="discounted_items">Items on Sale</label></div>-->
                                            </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="row">
                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseRange" role="button" aria-expanded="false" aria-controls="collapseRange">Sort by Price</a>
                                    <div class="collapse" id="collapseRange">
                                        <!-- Get store items by price range  action="<#?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"-->
                                        <div class="row">
                                            <form class="tablePadding" method="get" >
                                                <input class="w-25" type="text" id="min_value" name="min_value" placeholder="min" value="<?php if(isset($_GET['min_value'])){echo $_GET['min_value']; }?>">
                                                <input class="w-25" type="text" id="max_value" name="max_value" placeholder="max" value="<?php if(isset($_GET['max_value'])){echo $_GET['max_value']; }?>">
                                                <input class="" id="go" type="submit" name="go" value="Go">
                                            </form>
                                            <!--<div>
                                                <input type="checkbox" class="g2" id="low" name="low" value="low" onClick="">
                                                <label for="low">Low to High</label>
                                                <br>
                                                <input type="checkbox" class="g2" id="high" name="high" value="high">
                                                <label for="high">High to Low</label>
                                            </div>-->
                                        </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>

        <!--Shop Content-->
        <div class="shop-content col-lg-10 col-md-10 col-sm-12">
            <div class="container">
                <!--Shop Top Bar-->
                <div>
                    <div class="d-flex">
                        <h1 class="mx-auto">Shop</h1>
                    </div>
                </div>
                <!--Shop Content-->
                <div>
                    <div class="row row-cols-1 row-cols-md-4 row-cols-sm-1 row-cols-xs-1 g-4 mt-2 p-3 justify-content-center">
                        <?php
                            require(MYSQL);

                            if (!empty($_GET['min_value']) && !empty($_GET['max_value'])) {

                                $min = $_GET['min_value'];
                                $max = $_GET['max_value'];

                                $sql = " SELECT products.product_id, products.product_img, products.product_alt, products.product_name, products.cat_id, product_pricing.product_id, product_pricing.price_sm
                                         FROM products, product_pricing
                                         WHERE product_pricing.product_id = products.product_id AND product_pricing.price_sm BETWEEN $min AND $max";
                            } 

                            else {
                                $sql = " SELECT products.product_id, products.product_img, products.product_alt, products.product_name, products.cat_id, product_pricing.product_id, product_pricing.price_sm
                                     FROM products, product_pricing
                                     WHERE product_pricing.product_id = products.product_id";
                            }
                            $q = mysqli_query($dbc, $sql) or trigger_error("Query: $q\n<br>MYSQL Error: " . mysqli_error($dbc) );
                            $row = mysqli_fetch_array($q, MYSQLI_ASSOC);

                            foreach ($q as $row) :
                        ?>
                        <div class="card text-center">
                            <img src="<?php echo $row['product_img']; ?>" class="card-img-top mx-auto" alt="<?php echo $row['product_alt']; ?>">
                            <div class="card-body">
                                <p class="catID" hidden><?php echo $row['cat_id']; ?></p>
                                <h5 class="card-title"><?php echo $row ['product_name']; ?></h5>
                                <h6 class="Card-text cardPrice"><?php echo $row['price_sm']; ?></h6>
                                <a href="product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-primary">View</a>
                            </div>
                        </div>    
                        <?php endforeach; ?>
                    </div>
                </div>
        </div><!--END OF SHOP CONTENT-->
    </div>
</main>
<!-- END OF MAIN -->

<!--Attach footer-->
<?php
    include ('includes/footer.php');
?>