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

    // defining site key for recapcha v2
    define('SITE_KEY', '6Lfx7egUAAAAADkmWam5JjALTk6KBLa4VHSb8mtA');

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

        <!-- script need for recapcha use -->
        <script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
	
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

                <!-- wrapper for table & google map -->
                <div>
                    <!-- div for table (in one line with google map) -->
                    <div class="horizontalLeftStyle">

                        <!-- table title -->
                        <p>Business hours</p>

                        <!-- start table -->
                        <table>
                            <!-- first row and his cells -->
                            <tr>

                                <td>Monday:</td>
                                <td>08:00 - 20:30</td>
                            </tr>
                            <!-- second row and his cells -->
                            <tr>

                                <td>Tuesday:</td>
                                <td>08:00 - 20:30</td>
                            </tr>
                            <!-- third row and his cells -->
                            <tr>

                                <td>Wednesday:</td>
                                <td>08:00 - 20:30</td>
                                
                            </tr>
                            <!-- fourth row and his cells -->
                            <tr>

                                <td>Thursday:</td>
                                <td>08:00 - 20:30</td>
                                
                            </tr>
                            <!-- fifth row and his cells -->
                            <tr>

                                <td>Friday:</td>
                                <td>08:00 - 21:00</td>
                                
                            </tr>
                            <!-- sixth row and his cells -->
                            <tr>

                                <td>Saturday:</td>
                                <td>08:00 - 20:30</td>
                                
                            </tr>
                            <!-- seventh row and his cells -->
                            <tr>

                                <td>Sunday:</td>
                                <td>11:00 - 17:00</td>
                                
                            </tr>
                            </table>
                            <!-- end table -->

                            <p style="font-size: 17px;">Mobile number: 07705654688</p>

                    </div>
                    <!-- div for google map -->
                    <div class="horizontalLeftStyle">

                        <!-- google map and his attributes -->
                        <p><iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14261.320447659524!2d0.15489865690980306!3d50.811364217750736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47df7a9aa043436f%3A0xf7dff4fdf715c48f!2sMilton%20Street%2C%20Polegate%20BN26%205RL!5e0!3m2!1spl!2suk!4v1586978945348!5m2!1spl!2suk"
                            width="480" height="370" style="padding-left: 10px;" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                        </iframe></p>

                    </div>
                    <!-- break the line between table and google map -->
                    <div class="clear"></div>

                </div>

            </main>
            <!-- break the line between main and side navigation -->
            <div class="clear"></div>
            <!-- customer data form for receiving queries from customers -->
            <div class="contact_us_second_main">
                <!-- starting message -->
                <p class="header_contact_us_form">Leave us a message and we’ll get back to you</p>
                <!-- actual form -->
                <form action="Home" method="POST">

                    <!-- section for details -->
                    <section class="contact_us_form_div">
                        <!-- message to prompt the user -->
                        <p class="header_contact_us_form" style="font-size: 18px;text-align: left;">Please enter your details:</p>
                        <!-- first name label (input) -->
                        <label>
                            <!-- details of this input -->
                            <div class="horizontalLeftStyle contact_us_form">First Name<span style="color: red;">*</span></div>
                            <div class="horizontalLeftStyle">
                            <!-- input with attributes -->
                            <input class="contact_us" type="text" name="first_name" 

                                placeholder="Donna" onfocus="this.placeholder=''" 
                                onblur="this.placeholder='Peter'" required />

                            </div>

                            <!-- break line between message & input -->
                            <div class="clear"></div>

                        </label>

                         <!-- last name label (input) -->
                        <label>
                            <!-- details of this input -->
                            <div class="horizontalLeftStyle contact_us_form">Last Name<span style="color: red;">*</span></div>
                            <div class="horizontalLeftStyle">
                            <!-- input with attributes -->
                            <input class="contact_us" type="text" name="last_name" 

                                placeholder="Smith" onfocus="this.placeholder=''" 
                                onblur="this.placeholder='Jones'" required />

                            </div>

                            <!-- break line between message & input -->
                            <div class="clear"></div>

                        </label>

                        <!-- email label (input) -->
                        <label>
                            <!-- details of this input -->
                            <div class="horizontalLeftStyle contact_us_form">Email<span style="color: red;">*</span></div>
                            <div class="horizontalLeftStyle">
                            <!-- input with attributes -->
                            <input class="contact_us" type="email" name="contact_us_email" 

                                placeholder="John_Smith@gmail.com" onfocus="this.placeholder=''" 
                                onblur="this.placeholder='Jones@Yahoo.com'" required />

                            </div>

                            <!-- break line between message & input -->
                            <div class="clear"></div>

                        </label>

                        <!-- Phone Number label (input) -->
                        <label>
                            <!-- details of this input -->
                            <div class="horizontalLeftStyle contact_us_form">Phone Number</div>
                            <div class="horizontalLeftStyle">
                            <!-- input with attributes -->
                            <input class="contact_us" type="tel" name="contact_us_tel" 

                                placeholder="7911-123456" onfocus="this.placeholder=''" 
                                onblur="this.placeholder='5555-555555'" pattern="[0-9]{4}-[0-9]{6}"
                                onkeypress="return event.charCode>=45 && event.charCode<=57"/>

                            </div>
                            <!-- break line between message & input -->
                            <div class="clear"></div>
                            <!-- format note for input (instructions how to behave with this input) -->
                            <div class="note"><span class="note">Format: xxxx-xxxxxx<span></div>

                        </label>
                        <!-- legend -->
                        <div style="font-size: 10px;"><span style="color: red;">*</span>Required fields</div>

                    </section>

                    <!-- section about the issue -->
                    <section class="contact_us_form_div">
                        <!-- message to prompt the user -->
                        <p class="header_contact_us_form" style="font-size: 18px;text-align: left;">How can we help you?</p>

                        <!--  label for reason -->
                        <label>
                            <!-- details of this select option -->
                            <div class="horizontalLeftStyle contact_us_form">Reason for contacting us<span style="color: red;">*</span></div>
                            <div class="horizontalLeftStyle">
                                <!-- select with options to choose-->
                                <select class="contact_us" name="select_contact_us">
                                <option value="volvo">Order</option>
                                    <option value="saab">Payment</option>
                                    <option value="opel">Select</option>
                                    <option value="audi">Shipping & Delivery</option>
                                    <option value="volvo" selected>Claims & Returns</option>
                                    <option value="saab">my OrganicFarm</option>
                                    <option value="opel">Benefits & Shop</option>
                                    <option value="audi">Product Enquiry</option>
                                    <option value="volvo">Data Privacy</option>
                                    <option value="saab">Partner Programme</option>
                                    <option value="opel">Technical issues</option>
                                </select>

                            </div>

                            <!-- break line between message & input -->
                            <div class="clear"></div>

                        </label>

                        <!-- Customer Number label (input) -->
                        <label>
                            <!-- details of this input -->
                            <div class="horizontalLeftStyle contact_us_form">Customer Number</div>
                            <div class="horizontalLeftStyle">
                                <!-- input with attributes -->
                                <input class="contact_us" type="numeric" min="6" max="6" name="customer_number" 
                                    ondrop="return false;" onpaste="return false;"
                                    onkeypress="return event.charCode>=48 && event.charCode<=57"
                                    placeholder="000789" onfocus="this.placeholder=''" 
                                    onblur="this.placeholder='111666'"/>

                            </div>

                            <!-- break line between message & input -->
                            <div class="clear"></div>

                        </label>
                        
                        <!-- Order Number label (input) -->
                        <label>
                            <!-- details of this input -->
                            <div class="horizontalLeftStyle contact_us_form">Order Number</div>
                            <div class="horizontalLeftStyle">
                                <!-- input with attributes -->
                                <input class="contact_us" type="numeric" min="12" max="12" name="order_number" 
                                    ondrop="return false;" onpaste="return false;"
                                    onkeypress="return event.charCode>=48 && event.charCode<=57"
                                    placeholder="000001117789" onfocus="this.placeholder=''" 
                                    onblur="this.placeholder='111333666999'"/>

                            </div>

                            <!-- break line between message & input -->
                            <div class="clear"></div>

                        </label>

                        <!-- textarea for explaining an issue with all the details -->
                        <textarea class="contact_us_textarea" name="message" rows="8" cols="71" 
                                    placeholder="Write your message here please.." onfocus="this.placeholder=''" 
                                    onblur="this.placeholder='You can try again..'"></textarea>

                        <!-- recapcha (I'm not a robot) -->
                        <div class="g-recaptcha horizontalRightStyle" style="margin-right: 300px;" data-sitekey="<?php echo SITE_KEY; ?>">

                        <!-- line break -->
                        </div><div class="clear"></div><br>

                    </section>

                    <!-- submit button -->
                    <input class="submit_btn horizontalRightStyle" style="margin-right: 215px;" type="submit" value="Send" />
                    <!-- line break -->
                    <div class="clear"></div>

                </form>

            </div>
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