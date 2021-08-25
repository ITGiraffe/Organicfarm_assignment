<?php

// start using session variables in this page
session_start();

// if there is no form attributes (like someone trying to get to this file via direct link) than send back to Home page
if((!isset($_POST['email'])) && (!isset($_POST['password'])))
{
    header('Location: Home');
    exit(); // do not continue this code
}

// collect details (user, db name, password nad host) about the database
require_once "connect.php";

// connecting into database
$connection = @new mysqli($host, $db_user, $db_password, $db_name);

// if connection failed
if($connection->connect_errno!=0)
{
    // print error message
    echo "Error: ".$connection->connect_errno;

} else
{

    // fetch email and passwords from user form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // defense from SQL injection (code SQL)
    $email = htmlentities($email,ENT_QUOTES, "UTF-8");

    // connect to databese by SQL query to take all data about this account
    if($result = @$connection->query(sprintf("SELECT * FROM users WHERE email = '%s'", 
    mysqli_real_escape_string($connection, $email))))
    {

        // take data about how many accounts was find in this login try
        $user_how_many = $result->num_rows;

        // if account exists
        if($user_how_many > 0)
        {
            // take data from database
            $row = $result->fetch_assoc();

            // check encrypted password 
            if(password_verify($password, $row['password']))
            {

                // user is log in:
                $_SESSION['online'] = true;

                // set variables
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['level'] = $row['level'];

                // clear the buffer
                $result->free_result();

                // go to Home page
                header('Location: Home');

            } else
            {
                // error message
                $_SESSION['error'] = '<h2 class="error">Try again</h2>';

                // go to login page
                header('Location: Login');
            }
        } else
        {
            // error message
            $_SESSION['error'] = '<h2 class="error">Try again</h2>';

            // go to login page
            header('Location: Login');
        }
    }

    // close the connection
    $connection->close();
}



