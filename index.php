<?php
    SESSION_START(); // it is needeed to use session variables across whole website

    $_SESSION["datetime"] = new Datetime();  // setting up the date using PHP

    if(!isset($_SESSION["counter"])) // if not exist than create
    {
       $_SESSION["counter"] = 0; // how many item are in the basket
    }

    if(!isset($_SESSION["price"])) // if not exist than create
    {
      $_SESSION["price"] = 0.00; // total price for shopping
    }

    // if checkout happened
    if(isset($_POST['checkout']))
    {

        // deleting data
        $_SESSION['counter'] = 0;
        unset($_SESSION['list']);
        $_SESSION['price'] = 0.00;
    }

?>
<!DOCTYPE HTML>
<!-- choose languge -->
<html lang="en">
    <!-- head to set general attributes of the website -->
	<head>
        <!-- Unicode Transformation Format -->
        <meta charset="UTF-8">
        <!-- website title -->
        <title>OrganicFarm</title>
        <!-- website comment on google search -->
        <meta name ="description"  content="This is an organic farm in Sussex. We have fruits, vegetables,
         meat and poultry, which are produced at our farms.">
         <!-- keywords (tags) for google search -->
        <meta name="keywords" content="OrganicFarm, farm, organic, fruits, vegetables, meat, poultry, Sussex, 
        Eggs, beef, pork, chicken, lamb, duck, turkey, shop, food">
        <!-- set website to be displayes normally in internet explorer, chrome and edge -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- connecting to the css organicFarm.css file -->
        <link rel="stylesheet" href="OrganicFarm.css" type="text/css">
        <!-- set an icon in tab (link) -->
        <link rel="shortcut icon" href="images/png/hen.png">
		
		<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
		<![endif]-->
	
    </head>

    <!-- body section -->
    <body>
        <!-- scroll up button -->
        <a href="#" class="scrollUp_button"></a>

        <!-- wrapper above the header -->
        <div class="Container">

            <!-- advert on top -->
            <div class="horizontalLeftStyle"> <p class="topAdvert"><i>Free delivery from ??40</i></p></div>
            <!-- top right of the page -->
            <div class="horizontalRightStyle">
                <!-- list to display account options -->
                <ol class="topAccount">
                    <!-- first list item start with the icon -->
					<li><img src="images/png/user.png"> 
                        <?php 

                            // if user is log in than print proper email / if not -> proceed normally
                            if (isset($_SESSION['online']) && $_SESSION['online'] == true)
                            {
                                echo $_SESSION['email'];

                            } else
                            {
                                echo "My account";
                            }

                        ?>
                        <!-- adding extra list into first list item -->
						<ul>
                            <!-- first list item as link in extra list -->
                            <li><a href="Sign-in">Sign in</a></li>
                            <!-- second list item depend of the situation -->
                            <?php

                                // check if user is logged in
                                if(isset($_SESSION['online']) && $_SESSION['online'] == true)
                                {
                                    echo '<li><a href="logout">Log out</a></li>';

                                } else
                                {
                                    echo '<li><a href="Login">Log in</a></li>';
                                }

                            ?>
                            <!-- third list item -->
							<li><a href="Basket">Basket</a></li>
						</ul>
					</li>
				</ol>
			</div>
            <!-- break the line when list finished -->
            <div class="clear"></div>

        </div>      
        <!-- sticky header & menu (always on top) -->
        <div class="toBeSticky">
            <!-- header wrapper -->
            <header class="Container">
                <!-- dividing the line -->
                <div class="horizontalLeftStyle">
                        
                    <!-- logo with an image as link -->
                    <b><a href="Home" class="logo" title="OrganicFarm"><img src="images/png/hen.png" 
                    class="logoImage">OrganicFarm</a></b>

                </div>
                <!-- container for search field -->
                <div class="horizontalLeftStyle">
                    <!-- form for search field -->
                    <form name="miniSearchBox" action="#" method="post" class="searchForm">
                        <!-- search input -->
                        <input name="query" value="" tabindex="-1" class="search" maxlength="50"
                            placeholder="Over 10,000 Products" type="text" >
                        <!-- icon inside search input as button (no action) -->
                        <button name="submitSearch" type="submit"><img src="images/png/search.png"></button>

                    </form>
                </div>
                <!-- top right of the line with a basket changing icon and his prices depending of the situation -->
                <div class="horizontalRightStyle">
                    
                    <?php if ($_SESSION["price"] == 0) // check if basket is empty
                    {
                        echo '<a href="Basket" title="Basket" class="basketlink">
                        <img src="images/png/001-basket-1.png"><br>??',
                        number_format($_SESSION["price"], 2),'</a>'; // empty basket and price
                    }else
                    {
                        echo '<a href="Basket" title="Basket" class="basketlink">
                        <img src="images/png/002-basket.png"><br>??',
                        number_format($_SESSION["price"], 2),'</a>'; // full basket and price

                    } ?>

                </div>
                <!-- last thing in the line is displaing apriopiate date -->
                <div class="horizontalRightStyle datestyle">

                    <?= $_SESSION["datetime"]->format("d-m-Y") // display date in chosen format (day-month-year)?>

                </div>  
                <!-- end of the line and end of the header -->
                <div class="clear"></div>
            </header>
            <!-- main navigation dropdown sticky menu -->
            <nav class="menu">
                <ol class="topmenu" >
                    <li><a href="Home">Home</a></li>
                    <li><a href="Meat">Meat</a>

                         <ul>
                            <li><a href="Beef">Beef</a></li>
                            <li><a href="Lamb">Lamb</a></li>
                            <li><a href="Pork">Pork</a></li>
                        </ul>
                    </li>

                    <li><a href="Poultry">Poultry</a>

                        <ul>
                            <li><a href="Chicken">Chicken</a></li>
                            <li><a href="Duck">Duck</a></li>
                            <li><a href="Turkey">Turkey</a></li>
                        </ul>
                    </li>

                    <li><a href="Vegetables">Vegetables</a></li>
                    <li><a href="Fruits">Fruits</a></li>
                    <li><a href="Contact-Us">Contact Us</a></li>
                </ol>
            </nav>
        </div>
        <!-- sticky finishes -> side navigation, main & footer content wrapper -->
        <div class="Container Content">
            <!-- side navigation about the products in categories -->
            <nav id="sideNav" class="horizontalLeftStyle">
                
                <ul class="sidemenu" >
                    <li><a class="main_item" href="Meat">Meat</a></li>
                    <li><a href="Beef">Beef</a></li>
                    <li><a href="Lamb">Lamb</a></li>
                    <li><a href="Pork">Pork</a></li>
                    <li><a class="main_item" href="Poultry">Poultry</a></li>
                    <li><a href="Chicken">Chicken</a></li>
                    <li><a href="Duck">Duck</a></li>
                    <li><a href="Turkey">Turkey</a></li>
                    <li><a class="main_item" href="Vegetables">Vegetables</a></li>
                    <li><a class="main_item" href="Fruits">Fruits</a></li>
                </ul>

            </nav>

            <!-- Main content -->
            <main class="horizontalLeftStyle">

                <!-- Article for offers and picture content -->
				<article>
                    <!-- gram this content into one line -->
					<div class="horizontalLeftStyle">

                        <!-- Print some information if needed -->
                        <?php

                            // message for good registration
                            if(isset($_SESSION['registration_Successful']))
                            {
                                echo "<p class='success'>Registration successful</p>";
                                unset($_SESSION['registration_Successful']);

                            // delete registration fields
                            if(isset($_SESSION['email'])) unset($_SESSION['email']);
                            if(isset($_SESSION['password'])) unset($_SESSION['password']);
                            if(isset($_SESSION['password_repeat'])) unset($_SESSION['password_repeat']);
                            if(isset($_SESSION['email_check'])) unset($_SESSION['email_check']);

                            // delete error messages
                            if(isset($_SESSION['error_email_msg'])) unset($_SESSION['error_email_msg']);
                            if(isset($_SESSION['error_password_msg'])) unset($_SESSION['error_password_msg']);
                            if(isset($_SESSION['error_password_msg2'])) unset($_SESSION['error_password_msg2']);
                            if(isset($_SESSION['error_bot_msg'])) unset($_SESSION['error_bot_msg']);

                            }

                            // check if user buy just now
                            if(isset($_SESSION['buy_now']))
                            {
                                // print final message
                                echo "<p class='success'>Thank you for shoping!</p>";
                                unset($_SESSION['buy_now']);

                            }

                            // message for message from contact us page
                            if(isset($_POST['first_name']))
                            {

                                // print final message
                                echo "<p class='success'>Your message has been send!</p>";

                                // deleting data
                                unset($_POST['first_name']);
                                unset($_POST['last_name']);
                                unset($_POST['contact_us_email']);
                                unset($_POST['contact_us_tel']);
                                unset($_POST['select_contact_us']);
                                unset($_POST['customer_number']);
                                unset($_POST['order_number']);
                                unset($_POST['message']);

                            }

                            // message for message from basket page
                            if(isset($_POST['checkout']))
                            {

                                // print final message
                                echo "<p class='success'>Your transaction is in progress!</p>";

                                // deleting data
                                unset($_POST['checkout']);
                            }

                        ?>

                        <!-- offers title -->
                        <p><h3>Offers:</h3></p>
                        <!-- offers list -->
						<ul>
                            <!-- all list items italics -->
							<i>
                                <!-- all list items -->
								<li>Next day delivery!</li>
								<li>Free delivery from ??40!</li>
								<li>Discount up to 15% when shopping over ??60!</li>
							</i>
						</ul>
                    </div>
                    
                    <!-- picture div -->
					<div class="horizontalRightStyle">

                        <!-- picture with atribbutes -->
						<img src="images/png/farmer.jpg" class="farmerImage" title="Photo by Gregory Hayes on Unsplash">

					</div>

                    <!-- Line break between offers & picture -->
					<div class="clear"></div>

				</article>

                <!-- video article in paragraph -->
				<article>

					<p>
                        <!-- title -->
                        <h2>About our organic farm</h2>
                        <!-- video itself with autoplay -->
						<video controls autoplay>
                            
                        <source src="video/organicFarmVideo.mp4" type="video/mp4">
						Your browser does not support HTML5 video.

						</video>
						<br>

					</p>

				</article>

                <!-- Article showing most popular buings -->
				<article>

                    <!-- title -->
					<p><h3>Most popular buyings:</h3></p>

					<div>
                    
                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New item form-->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/veg/Avocado.jpg" name="path">
                                <input type="hidden" value="Avocado Hass (Each)" name="name">
                                <input type="hidden" value="1.85" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/veg/Avocado.jpg" class="content_Image">
                                    <br>Avocado Hass (Each)<br>??1.85<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over ??40
                                    <br>Country of Origin Spain<br></span>
                                </button>
                            
                            </form>
                        </div>
                        
                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/chicken/Cubes.jpg" name="path">
                                <input type="hidden" value="Chicken Cubes (51g)" name="name">
                                <input type="hidden" value="1.60" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/chicken/Cubes.jpg" class="content_Image">
                                    <br>Kallo Organic Very Low Salt Chicken Stock Cubes (51g)<br>??1.60<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over ??40
                                    <br>Kallo Organic Very Low Salt Chicken Stock Cubes have been created especially
                                        to help you reduce salt in your diet but also enhance the natural flavours 
                                        of your home cooked meals.<br></span>
                                </button>

                            </form>

                        </div>

                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                        <!-- New Item -->
                        <form action="Basket" method="post">
                            
                            <!-- Inputs holding info about products for basket page -->
                            <input type="hidden" value="images/chicken/Sliced.jpg" name="path">
                            <input type="hidden" value="Sliced Chicken (80g)" name="name">
                            <input type="hidden" value="4.49" name="prize">
                            
                            <!-- Actual view of pruduct and his details -->
                            <button type="submit" class="button_picture_content">
                                <img src="images/chicken/Sliced.jpg" class="content_Image">
                                <br>Golfera Sliced Chicken (80g)<br>??4.49<br>
                                <span style="font-size: 12px;">Delivery available from free for orders over ??40
                                <br>Order from our full range of fresh & chilled food for delivery thoughout 
                                    the London area. With Flexi or Hourly delivery slots on most days you can 
                                    choose from our large range of fresh organic bread, cheese, eggs, meat, 
                                    fish, fruit and vegetables.<br></span>
                            </button>

                        </form>

                        </div>

                        <!-- Line break -->
                        <div class="clear"></div>
                        
                        <!-- New item wrapper -->
                        <div class="picture_Style_div">
                            
                            <!-- New item form -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/chicken/Chai.jpg" name="path">
                                <input type="hidden" value="Turkey Tail & Reishi" name="name">
                                <input type="hidden" value="19.99" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/chicken/Chai.jpg" class="content_Image">
                                    <br>FS Chai Latte With Turkey Tail & Reishi (60g)<br>??19.99<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over ??40
                                    <br>Country of Origin USA<br></span>
                                </button>
                            
                            </form>

                        </div>

                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/meat/Topside.jpg" name="path">
                                <input type="hidden" value="Beef Mini Joint" name="name">
                                <input type="hidden" value="13.99" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/meat/Topside.jpg" class="content_Image">
                                    <br>Rhug Beef Mini Topside Joint (Kg)<br>??13.99<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over ??40
                                    <br>Product requires cooking before eating and is not ready to eat<br></span>
                                </button>
                            
                            </form>

                        </div>
                        
                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New item form -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/meat/Redcurrant.jpg" name="path">
                                <input type="hidden" value="Cook Lamb Joint" name="name">
                                <input type="hidden" value="8.99" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/meat/Redcurrant.jpg" class="content_Image">
                                    <br>Easy to Cook Lamb Joint with Redcurrant, Rosemary 550g<br>??8.99<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over ??40
                                    <br>INGREDIENTS: lamb (75%), redcurrant and rosemary glaze (sugar, redcurrants, 
                                        water, cornflour, salt, concentrated lemon juice, gelling agent (pectin), 
                                        rosemary), rosemary.<br></span>
                                </button>
                            
                            </form>

                        </div>

                        <!-- Line break -->
                        <div class="clear"></div>

					</div>

				</article>

			</main>
			<!-- Line break -->
            <div class="clear"></div>
            <!-- footer -->
            <footer>
                <!-- information about icons in a new separate line -->
                <div class="horizontalLeftStyle">
                    <div>Icons made by <a href="https://www.flaticon.com/authors/monkik" title="monkik">monkik</a> from <a href="https://www.flaticon.com/"     title="Flaticon">www.flaticon.com</a></div>
                    <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/"     title="Flaticon">www.flaticon.com</a></div>
                </div>
                <!-- information abour the author -->
                <div class="horizontalRightStyle">

                    &copy;Mariusz Cichon<br>CIC18465747

                </div>
                <!-- line break -->
                <div class="clear"></div>
            </footer>

        </div>

        <!-- javascript files needed to operate this page: JQuery, scrollTo libraries and sticky file -->
		<script src="JavaScript/jquery-3.4.1.min.js"></script>
		<script src="jquery.scrollTo.min.js"></script>
        <script src="javaScript/sticky.js"></script>
    </body>
</html>