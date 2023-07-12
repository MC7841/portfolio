<?php
    require ('includes/config.php');
    $page_name = 'LSS: Cart';
    include ('includes/header.php');
    if (isset($_POST["addToCart"])) {

        if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION['shopping_cart'])) {

            $item_array_id = array_column($_SESSION["shopping_cart"], "item_size");

            if (!in_array($_GET["size"], $item_array_id)) {

                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'item_id'			=>	$_GET["id"],
                    'item_name'			=>	$_POST["productName"],
                    'item_price'		=>	$_POST["priceValue"],
                    'item_img'		=>	$_POST["productImg"],
                    'item_alt'		=>	$_POST["productAlt"],
                    'item_size'     =>  $_GET["size"],
                    'item_quantity'		=>	$_POST["itemQuantity"]
                );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        } else { 
            $item_array = array(
                'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["productName"],
				'item_price'		=>	$_POST["priceValue"],
                'item_img'		=>	$_POST["productImg"],
                'item_alt'		=>	$_POST["productAlt"],
                'item_size'     =>  $_GET["size"],
				'item_quantity'		=>	$_POST["itemQuantity"]
            );
            
            $_SESSION["shopping_cart"][0] = $item_array;
        }
}
if (!empty($_GET["action"])) {
    switch ($_GET['action']) {
        case 'delete':
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                if ($values["item_id"] == $_GET["id"] && $values["item_size"] == $_GET["size"]) {
                    unset($_SESSION["shopping_cart"][$keys]);
                }
            }
            break;
        case 'add':
            if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION['shopping_cart'])) {
                $item_array_id = array_column($_SESSION["shopping_cart"], "item_size");

                if (!in_array($_GET['size'], $item_array_id)) {
                    $count = count($_SESSION["shopping_cart"]);
                    $item_array = array(
                        'item_id'			=>	$_GET["id"],
                        'item_name'			=>	$_POST["productName"],
                        'item_price'		=>	$_POST["priceValue"],
                        'item_img'		=>	$_POST["productImg"],
                        'item_alt'		=>	$_POST["productAlt"],
                        'item_size'     =>  $_GET['size'],
                        'item_quantity'		=>	$_POST["itemQuantity"]
                    );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                }
            } else {
                $item_array = array(
                    'item_id'			=>	$_GET["id"],
                    'item_name'			=>	$_POST["productName"],
                    'item_price'		=>	$_POST["priceValue"],
                    'item_img'		=>	$_POST["productImg"],
                    'item_alt'		=>	$_POST["productAlt"],
                    'item_size'     =>  $_GET['size'],
                    'item_quantity'		=>	$_POST["itemQuantity"]
                );
                
                $_SESSION["shopping_cart"][0] = $item_array;
            }
            break;
    }
}
?>
<main class="overflow-hidden">
    <div class="row">
        <div class="col-8">
            <h2 class="Display-4 text-center mt-1 pb-1">My Cart</h2>
            <div class="cartContent position-fixed p-2">  
                <!--If cart is empty display message -->
                <?php if (empty($_SESSION["shopping_cart"])) : ?>
                <div class="row justify-content-center">
                    <h2 class="col-12 text-center display-5">Your Cart is Empty</h2>
                    <a class="col-4 btn btn-primary mt-2" href="shop.php">Go to Shop</a>
                </div>
            </div>
        </div>
        <div class="col-4 row">
            <div class="col-4 ordersum row position-fixed">
                    <div class="nav flex-column flex-nowrap vh-100 p-2">
                        <!-- Order summary -->
                        <h2 class="Display-4 text-center">Order Summary</h2>
                        <h5><b>Subtotal:</b> 0.00 </h5>
                        <button class="btn btn-primary">Checkout</button>
                    </div>
                </div>
            </div>
            <?php endif;?>

            <?php
			if(!empty($_SESSION["shopping_cart"]))
			{
				$subtotal = 0;
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
			?>
            <!-- Generate Cards -->
            <div class="card mb-3 w-75">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="<?php echo $values['item_img']; ?>" class="img-fluid rounded-start" alt="<?php echo $values['item_alt']; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><b><a href="product.php?id=<?php echo $values['item_id']; ?>"><?php echo $values["item_name"]; ?></a></b></h3>
                            <h5><b>Product Size: </b><?php echo $values["item_size"]; ?></h5>
                            <h5><b>Quantity: </b><?php echo $values["item_quantity"]; ?></h5>
                            <h5><b>Price per Item: </b><?php echo $values["item_price"]; ?></h5>
                            <h5><b>Total: </b><?php echo number_format($values["item_price"] * $values["item_quantity"], 2); ?></h5>
                            <a href="cart.php?action=delete&id=<?php echo $values['item_id']; ?>&size=<?php echo $values['item_size']; ?>"><span class="text-danger">Remove</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $subtotal += $values["item_price"] * $values["item_quantity"]; } ?>  
        </div>
    </div>

    <div class="col-4 row">
        <div class="col-4 ordersum position-fixed">
            <div class="nav flex-column flex-nowrap vh-100">
                <!-- Order summary -->
                <h2 class="pt-2 text-center">Order Summary</h2>
                <h5><b>Subtotal: </b><?php echo number_format($subtotal, 2); ?></h5>
                <button class="mt-2 btn btn-primary">Checkout</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</main>