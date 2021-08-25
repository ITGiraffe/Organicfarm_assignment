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
					<p><h3>Fruits:</h3></p>

                    <!-- Items holder -->
					<div>

                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New item form-->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Lemons.jpg" name="path">
                                <input type="hidden" value="Lemons (3 Units)" name="name">
                                <input type="hidden" value="1.25" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Lemons.jpg" class="content_Image">
                                    <br>Lemons (3 Units)<br>£1.25<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Italy<br></span>
                                </button>
                            
                            </form>
                        </div>
                        
                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New item form -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Mandarins(600g).jpg" name="path">
                                <input type="hidden" value="Mandarins(600g)" name="name">
                                <input type="hidden" value="3.50" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Mandarins(600g).jpg" class="content_Image">
                                    <br>Mandarins(600g)<br>£3.50<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Spain<br></span>
                                </button>
                            
                            </form>

                        </div>
                        
                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New item form -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Bananas.jpg" name="path">
                                <input type="hidden" value="Bananas (Bunch Of 5)" name="name">
                                <input type="hidden" value="2.00" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Bananas.jpg" class="content_Image">
                                    <br>Bananas (Bunch Of 5)<br>£2.00<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Peru<br></span>
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
                                <input type="hidden" value="images/fruits/Blueberries.jpg" name="path">
                                <input type="hidden" value="Blueberries (125g)" name="name">
                                <input type="hidden" value="3.50" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Blueberries.jpg" class="content_Image">
                                    <br>Blueberries (125g)<br>£3.50<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Spain<br></span>
                                </button>
                            
                            </form>
                            
                        </div>

                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Strawberries.jpg" name="path">
                                <input type="hidden" value="Strawberries (250g)" name="name">
                                <input type="hidden" value="2.99" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Strawberries.jpg" class="content_Image">
                                    <br>Strawberries (250g)<br>£2.99<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Spain<br></span>
                                </button>
                            
                            </form>

                        </div>
                        
                        <!-- New item wrapper -->
						<div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Raspberries.jpg" name="path">
                                <input type="hidden" value="Raspberries (125g)" name="name">
                                <input type="hidden" value="3.85" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Raspberries.jpg" class="content_Image">
                                    <br>Raspberries (125g)<br>£3.85<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Spain<br></span>
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
                                <input type="hidden" value="images/fruits/Apples.jpg" name="path">
                                <input type="hidden" value="Apples (6 Units)" name="name">
                                <input type="hidden" value="4.15" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Apples.jpg" class="content_Image">
                                    <br>Apples (6 Units)<br>£4.15<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin UK/Italy<br></span>
                                </button>
                            
                            </form>

                        </div>

                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Pears.jpg" name="path">
                                <input type="hidden" value="Pears (1kg)" name="name">
                                <input type="hidden" value="5.25" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Pears.jpg" class="content_Image">
                                    <br>Pears (1kg)<br>£5.25<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Holland/Argentina<br></span>
                                </button>
                            
                            </form>

                        </div>

                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Pineapple.jpg" name="path">
                                <input type="hidden" value="Pineapple (Each)" name="name">
                                <input type="hidden" value="3.15" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Pineapple.jpg" class="content_Image">
                                    <br>Pineapple (Each)<br>£3.15<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Costa Rica<br></span>
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
                                <input type="hidden" value="images/fruits/Melon.jpg" name="path">
                                <input type="hidden" value="Chanterais Melon (Each)" name="name">
                                <input type="hidden" value="6.50" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Melon.jpg" class="content_Image">
                                    <br>Chanterais Melon (Each)<br>£6.50<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Spain<br></span>
                                </button>
                            
                            </form>

                        </div>

                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Grapefruit.jpg" name="path">
                                <input type="hidden" value="Star Ruby Grapefruit (Each)" name="name">
                                <input type="hidden" value="1.75" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Grapefruit.jpg" class="content_Image">
                                    <br>Star Ruby Grapefruit (Each)<br>£1.75<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Spain<br></span>
                                </button>
                            
                            </form>

                        </div>

                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Pomegranate.jpg" name="path">
                                <input type="hidden" value="Pomegranate (Each)" name="name">
                                <input type="hidden" value="2.75" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Pomegranate.jpg" class="content_Image">
                                    <br>Pomegranate (Each)<br>£2.75<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Country of Origin Peru<br></span>
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
                                <input type="hidden" value="images/fruits/Box1.jpg" name="path">
                                <input type="hidden" value="Fruit and Vegetable" name="name">
                                <input type="hidden" value="39.90" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Box1.jpg" class="content_Image">
                                    <br>Fruit and Vegetable Box<br>£39.90<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Freshly picked fruit and vegetables delivered to your door. 
                                    This grocery box is great for singles and couples or smaller families. INGREDIENTS:
                                    <br>Raspberries, Blueberries or Strawberries
                                        Potatoes, New Potatoes, Onions
                                        Cauliflower, Broccoli, Carrots, Courgettes, Cucumber, Tomatoes or Peppers
                                        Avocados, Aubergine, Garlic or Chilli Peppers
                                        Bananas, Apples, Plums, Grapes, Melon or Pineapple.
                                        Oranges, Limes or Lemons, Tangerines or Satsumas<br></span>

                                </button>
                            
                            </form>

                        </div>

                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Box2.jpg" name="path">
                                <input type="hidden" value="Large Fruit and Vegetable" name="name">
                                <input type="hidden" value="59.90" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Box2.jpg" class="content_Image">
                                    <br>Large Fruit and Vegetable Box<br>£59.90<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>Large overflowing box of freshly picked fruit and vegetables delivered to your door. INGREDIENTS:<br>
                                    Potatoes, New Potatoes, Swede or Butternut Squash
                                    Onions, Spring Onion
                                    Lettuce, Cabbage, Cauliflower, Broccoli, Leek
                                    Carrots, Courgettes, Celery, Cucumbers, Mushroom, Tomatoes, Peppers, Asparagus
                                    Ginger, Avocados
                                    Lemons, Limes, Orange, Grapefruit, Satsuma
                                    Bananas, Strawberries, Raspberries, Blueberries
                                    Apples, Plums, Grapes
                                    Melon or Pineapple.<br></span>
                                    
                                </button>
                            
                            </form>

                        </div>

                        <!-- New item wrapper -->
                        <div class="picture_Style_div">

                            <!-- New Item -->
                            <form action="Basket" method="post">
                                
                                <!-- Inputs holding info about products for basket page -->
                                <input type="hidden" value="images/fruits/Box3.jpg" name="path">
                                <input type="hidden" value="Essential Fruit & Veg" name="name">
                                <input type="hidden" value="26.00" name="prize">
                                
                                <!-- Actual view of pruduct and his details -->
                                <button type="submit" class="button_picture_content">
                                    <img src="images/fruits/Box3.jpg" class="content_Image">
                                    <br>Essential Fruit & Veg Box<br>£26.00<br>
                                    <span style="font-size: 12px;">Delivery available from free for orders over £40
                                    <br>The box includes a huge mixture of 16 + different varieties of Fruit & Veg;
                                            <br>
                                    Potatoes 1Kg
                                    Carrots Bunch 500g
                                    Parsnips 1 or 2 depending on size
                                    Ginger 1pc
                                    Apples 700g
                                    Sweet potatoes 700g
                                    Clementines 500g
                                    Tomatoes 700g
                                    Courgette 1 or 2 depending on size
                                    Round or Iceberg Lettuce
                                    Bell Peppers 1
                                    Cucumber 1
                                    Garlic 1
                                    Onions 500g
                                    Closed Cup Mushrooms 250g
                                    Banana 6-7 depending on size<br></span>
                                    
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