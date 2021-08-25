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
            <div class="horizontalLeftStyle"> <p class="topAdvert"><i>Free delivery from £40</i></p></div>
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
                        <img src="images/png/001-basket-1.png"><br>£',
                        number_format($_SESSION["price"], 2),'</a>'; // empty basket and price
                    }else
                    {
                        echo '<a href="Basket" title="Basket" class="basketlink">
                        <img src="images/png/002-basket.png"><br>£',
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
                
                <!-- Article in main content (could be more than one) -->
				<article>

                    <!-- Items category title -->
					<p><h3>Pork:</h3></p>

                    <!-- Items holder -->
					<div>

                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New item form-->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/meat/Loin.jpg" name="path">
                                <input type="hidden" value="Thin Cut Pork" name="name">
                                <input type="hidden" value="5.00" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/meat/Loin.jpg" class="content_Image">
                                    <br>British Thin Cut Pork Loin Steaks 450g<br>£5.00<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Cook thoroughly until the juices run clear and there is no pink meat. 
                                        Appliances vary, this a guideline only. Wash hands, all surfaces and 
                                        utensils after touching raw meat and packaging..<br></span>
                                </button>
                            
                            </form>
                        </div>
                        
                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New item form -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/meat/Sausages.jpg" name="path">
                                <input type="hidden" value="6 Pork Sausages" name="name">
                                <input type="hidden" value="2.99" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/meat/Sausages.jpg" class="content_Image">
                                    <br>6 Gourmet Pork Sausages 400g<br>£2.99<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>INGREDIENTS: Pork (84%), water, potato starch, pea flour, salt, black pepper, 
                                        nutmeg, preservative sodium metabisulphite, stabilisers tetrasodium 
                                        diphosphate and disodium diphosphate.<br></span>
                                </button>
                            
                            </form>

                        </div>
                        
                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New item form -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/meat/Mozzarella.jpg" name="path">
                                <input type="hidden" value="Pork Meatballs 565g" name="name">
                                <input type="hidden" value="4.19" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/meat/Mozzarella.jpg" class="content_Image">
                                    <br>Easy To Cook Mozzarella Stuffed Pork Meatballs 565g<br>£4.19<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Pork and mozzarella meatballs, cherry tomatoes and basil pesto in a tomato 
                                        polpa sauce topped with grated grana padano cheese PDO and breadcrumbs<br></span>
                                </button>
                            
                            </form>

                        </div>

                        <!-- Line break -->
                        <div class="clear"></div>
                        
                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/meat/Medallions.jpg" name="path">
                                <input type="hidden" value="Pork Medallions 240g" name="name">
                                <input type="hidden" value="2.66" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/meat/Medallions.jpg" class="content_Image">
                                    <br>Free Range Pork Medallions 240g<br>£2.66<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>These pork medallions are tender and full of flavour and have been hand 
                                        trimmed for a leaner meat. They come from pigs sired by pedigree 
                                        Hampshire boars<br></span>
                                </button>
                            
                            </form>
                            
                        </div>

                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/meat/Schnitzel.jpg" name="path">
                                <input type="hidden" value="Pork Schnitzel 266g" name="name">
                                <input type="hidden" value="4.19" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/meat/Schnitzel.jpg" class="content_Image">
                                    <br>Easy to Cook Pork Schnitzel 266g<br>£4.19<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>2 Pork leg escalopes with cheese, lemon and thyme crumb
                                        with Lemon, Thyme and Gruyere Crumb<br></span>
                                </button>
                            
                            </form>

                        </div>
                        
                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/meat/Fillet.jpg" name="path">
                                <input type="hidden" value="British Pork Fillet" name="name">
                                <input type="hidden" value="5.04" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/meat/Fillet.jpg" class="content_Image">
                                    <br>British Pork Fillet<br>£5.04<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Oven cook: Preheat oven. Remove all packaging. Heat a 1tsp of oil in a 
                                        frying pan on medium heat. Add fillet to the pan and cook for 3 minutes, 
                                        turning occasionally. Transfer the fillet to an oven proof tray and place 
                                        into the oven. Rest for 5 minutes before serving. (Time Pan fry 3 mins + 
                                        4mins per 500g, Oven: 180°C, Fan: 160°C, Gas: Gas Mark 5)
                                        <br></span>
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