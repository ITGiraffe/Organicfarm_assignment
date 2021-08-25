<?php
    SESSION_START(); // it is needeed to use session variables across whole website

    // if you are logged in than go to Home page
    if (isset($_SESSION['online']) && $_SESSION['online'] == true)
    {
        header('Location: Home');
        exit(); // do not continue this code
    }

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

        <!-- wrapper above the header -->
        <div class="Container">

            <!-- advert on top -->
            <div class="horizontalLeftStyle"> <p class="topAdvert"><i>Free delivery from £40</i></p></div>
            <!-- top right of the page -->
            <div class="horizontalRightStyle">
                <!-- list to display account options -->
                <ol class="topAccount">
                    <!-- first list item start with the icon -->
                    <li><img src="images/png/user.png"> My account
                        <!-- adding extra list into first list item -->
						<ul>
                            <!-- all list items as links -->
                            <li><a href="Sign-in">Sign in</a></li>
                            <li><a href="Login">Log in</a></li>
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
        <!-- sticky finishes ->  main & footer content wrapper -->
        <div class="Container Content">
            
            <!-- Main content -->
            <main class="sign_in_log_in_main">
                <!-- display message if needed (error occour) -->
                <?php

                    if (isset($_SESSION['msg']))
                    {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    
                ?>

                <!-- Article for logging in -->
                <article>

                    <!-- log in via google (no action) -->
                    <button class="google_btn" >Log in via google</button>

                    <!-- log in via facebook (no action) -->
                    <button class="google_btn" >Log in via facebook</button>

                    <!-- form for logging in -->
                    <form action="Account" method="POST">
                        
                    <!-- simple add -->
                    <p style="text-align: center;">OR</p>

                    <!-- displaying errors if needed -->
                    <?php

                        if (isset($_SESSION['error']))
                        {
                                                        
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            
                        }

                    ?>

                    <!-- message for logging in -->
                    <p style="text-align: center;"> Log in to your account: </p>

                        <!-- email input with attributes and error messages if needed -->
                        <input type="email" name="email" <?php 

                            if (isset($_SESSION['email']))
                            {
                                
                                echo 'value="'.$_SESSION['email'].'"';
                                unset($_SESSION['email']);
                                
                            }?>
                            placeholder="Email:" onfocus="this.placeholder=''" onblur="this.placeholder='Email:'" /><?php  		
                            if (isset($_SESSION['error_email']))
                            {
                                echo '<span class="error" >   !</span>';
                                unset($_SESSION['error_email']);
                            }  ?>

                        <!-- password input with attributes and error messages if needed -->
                        <input type="password" name="password" <?php 
                                if (isset($_SESSION['password']))
                                    {
                                        echo 'value="'.$_SESSION['password'].'"';
                                        unset($_SESSION['password']);
                                    }?> placeholder="Password: (min 8 characters)" onfocus="this.placeholder=''" 
                                    onblur="this.placeholder='Password: (min 8 characters)'" /><?php  		
                                    if (isset($_SESSION['error_password']))
                                    {
                                        echo '<span class="error" >   !</span>';
                                        unset($_SESSION['error_password']);
                                    }  ?>

                    <!-- submit button -->
                    <input class="submit_btn" type="submit" value="Log In" />

                    </form>

                    <!-- signing in message -->
                    <p class="small_text_log_in" >Still don't have account? <a href="Sign-in" >Sign in now</a></p>
                
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

        <!-- javascript files needed to operate this page: JQuery library and sticky file -->
		<script src="JavaScript/jquery-3.4.1.min.js"></script>
        <script src="javaScript/sticky.js"></script>
    </body>
</html>