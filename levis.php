<?php 
session_start(); #starts the PHP session
$connect = mysqli_connect("localhost", "root", "", "test"); #connect is variable that enables the connection to the backend database
#mysqli_connect("host","username","password","dbname");

if(isset($_POST["add_to_cart"])) #checks to make sure add_to_cart is not NULL - executed when the ADD TO CART BUTTON is clicked
{
	if(isset($_SESSION["shopping_cart"])) #checks to make sure shopping_cart is not NULL
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id"); #parameter 1 - array from which you want to get data, 2 - column name
		if(!in_array($_GET["id"], $item_array_id)) #checks to ensure that item is not already added to order list
		{
			$count = count($_SESSION["shopping_cart"]); #counts the number of elements in the array and store it into the count var
			$item_array = array(
				'item_id'			=>	$_GET["id"], #value from url
				'item_name'			=>	$_POST["hidden_name"], #value from form
				'item_price'		=>	$_POST["hidden_price"], 
				'item_quantity'		=>	$_POST["quantity"] 
			);
			$_SESSION["shopping_cart"][$count] = $item_array; #all item details can be stored in the session shopping_cart variable
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>'; #else displays an alert message
			#echo '<script>window.location="/WP-master/levis.php"</script>' redirects back to the products page
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"])) #isnot null
{
	if($_GET["action"] == "delete") #if the user wants to remove a product from order
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values) #each key and value of shopping cart variable can be accessed
		{
			if($values["item_id"] == $_GET["id"]) #if the URL id is the same as the item_id of the product
			{
				unset($_SESSION["shopping_cart"][$keys]); #destroys that var
				echo '<script>alert("Item Removed")</script>'; #alert is displayed
				echo '<script>window.location="levis.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WINDOWSHOP.COM</title>

    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	
    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/df3f20246d.js" crossorigin="anonymous"></script>

    <!--slick slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>


    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/fontawesome-free-5.14.0-web/css/all.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
     
  <!--header-->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-12">
                    
                </div>
                <div class="col-md-4 col-12 text-center">
                    <h2 class="my-md-3 site-title text-white">WINDOWSHOP.COM</h2>
                </div>
                <div class="col-md-4 col-12 text-right">
                    <p class="my-md-4 header-links">
                        <a href="file:///C:/Users/Stuti/Desktop/WP-master/login.html" class="px-2">Sign In</a>
                        <a href="file:///C:/Users/Stuti/Desktop/WP-master/register.html" class="px-1">Register</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light bg-white">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                    <li class="nav-item active">
                      <a class="nav-link" href="file:///C:/Users/Stuti/Desktop/WP-master/index.html">HOME<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          BRANDS
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="./levis.php">Levi's</a>
                          <a class="dropdown-item" href="#">Van Heusen</a>
                          <a class="dropdown-item" href="#">Park Avenue</a>                          
                        </div>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          CATEGORIES
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="./men.html">Men</a>
                          <a class="dropdown-item" href="./women.html">Women</a>
                          <a class="dropdown-item" href="./kids.html">Kids</a>
                        </div>
                      </li>
                    <li class="nav-item">
                      <a class="nav-link" href="Offers.html">OFFERS</a>
                    </li>  
					<li class="nav-item">
                      <a class="nav-link" href="Cart.html">CART</a>
                    </li>  
                    <li class="nav-item">
                      <a class="nav-link" href="AboutUs.html">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="contactus.html">CONTACT US</a>
                    </li>
                  </ul>
                </div>
				<!--
                <div class="navbar-nav">
                    <li class="nav-item border rounded-circle mx-2 search-icon">
                        <i class="fas fa-search p-2"></i>   
                    </li>
                    <li class="nav-item border rounded-circle mx-2 basket-icon">
                        <i class="fas fa-shopping-basket p-2"></i>   
                    </li>
                </div>-->
              </nav>   
        </div>
    </header>
	

    <!-- main secton -->
    
                <h1>Levi's Fashion</h1>
                <div class="underline"></div>
            </div>
    <body>
		<br />
		<div class="container">
			<br />
			<br />
			<br />
			<br /><br />
			<?php
				#we want to display a product on the webpage from the database
				$query = "SELECT * FROM tbl_product ORDER BY id ASC"; #so we write a query to retrieve the required info
				$result = mysqli_query($connect, $query); #to execute the query
				if(mysqli_num_rows($result) > 0) #function returns the number of rows returned by the query
				{
					while($row = mysqli_fetch_array($result)) #fetches all data and displays on webpage
					{
				?>
			<div class="col-md-4">
				<form method="post" action="levis.php?action=add&id=<?php echo $row["id"]; ?>"> <!--dynamically gets value from the db using echo statement with column name to be retrieved-->
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br /> <!--displays dynamic image from db-->

						<h4 class="text-info"><?php echo $row["name"]; ?></h4> <!--display name of product from db-->

						<h4 class="text-danger">Rs. <?php echo $row["price"]; ?></h4> <!--display price of prod from db-->

						<input type="text" name="quantity" value="1" class="form-control" /> <!--user can enter this-->

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" /> <!--product name that can be used for future use-->

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"])) #check if session variable shopping cart is not empty
					{
						$total = 0; #total item price
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td> <!--key is item_name-->
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>Rs. <?php echo $values["item_price"]; ?></td>
						<td>Rs. <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td> <!--total price with 2 dec point-->
						<td><a href="levis.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
						<!--delete that value using the key value from the URL-->
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">Rs. <?php echo number_format($total, 2); ?></td> <!--prints with 2 dec places-->
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>
		</div>
	</div>
	<br />
	</body>
    <!--/ main secton -->
    
    <!--footer-->
    <hr color="lightblue">
    </main>

    <footer>
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <h4>Contact Us</h4>
                    <div class="row pl-md-1 text-secondary">
                        <div class="col-12">
                            <i class="fas fa-home px-md-2"></i>
                            <small>C.P. Ramaswamy Road, Mylapore, Chennai-600004</small>
                        </div>
                    </div>
                    <div class="row pl-md-1 text secondary py-4">
                        <div class="col-12">
                            <i class="fas fa-paper-plane px-md-2"></i>
                            <small>www.windowshop.com</small>
                        </div>
                    </div>
                    <div class="row pl-md-1 text-secondary">
                        <div class="col-12">
                            <i class="fas fa-phone-volume px-md-2"></i>
                            <small>7811923331</small>
                        </div>
                    </div>
					<!--
                    <div class="row social text-secondary">
                        <div class="col-12 py-3">
                            <i class="fab fa-twitter"></i>
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-google-plus-g"></i>
                            <i class="fab fa-skype"></i>
                            <i class="fab fa-pinterest-p"></i>
                            <i class="fab fa-youtube"></i>
                        </div>
                    </div>-->
                </div>
                <div class="col-md-2 col-sm-12">
                    <h4>Our Locations</h4>
                    <div class="d-flex flex-column pl-md-3">
                        <small class="pt-0">Chennai</small>
                        <small>New Delhi</small>
                        <small>Bangalore</small>
                        <small>Mumbai</small>
                        <small>Kolkata</small>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <h4>Our Pages</h4>
                    <div class="d-flex flex-column pl-md-3">
                        <small class="pt-0">About Store</small>
                        <small>New Collection</small>
                        <small>Contact Us</small>
                        
                    </div>
                </div>
				<!--
                <div class="col-md-4 follow-us col-sm-12">
                    <h4>Follow Instagram</h4>
                    <div class="d-flex flex-row">
                        <img src="./assets/256_n.jpg" alt="insta 1" class="img-fluid">
                        <img src="./assets/792_n.jpg" alt="insta 2" class="img-fluid">
                        <img src="./assets/392_n.jpg" alt="insta 3" class="img-fluid">
                    </div>
                    <div class="d-flex flex-row">
                        <img src="./assets/664_n.jpg" alt="insta 1" class="img-fluid">
                        <img src="./assets/088_n.jpg" alt="insta 2" class="img-fluid">
                        <img src="./assets/896_n.jpg" alt="insta 3" class="img-fluid">
                    </div>
                </div>-->
            </div>
        </div>

        <div class="container text-center">
            <p class="pt-5">
                <img src="./assets/payment.png" alt="payment" class="img-fluid">
            </p>
            <small class="text-secondary py-4">Windowshop.com © 2020 Online Shopping Store. All Rights Reversed. Designed by Stuti Arora.</small>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>