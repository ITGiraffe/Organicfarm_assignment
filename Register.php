<?php

// start using session variables in this page
session_start();

// if there is no form attributes (like someone trying to get to this file via direct link) than send back to login page
if(!isset($_POST['email']))
{
    header('Location: Sign-in');
    exit(); // do not continue this code
}

// set flag into true if something brakes than error will show up
$_SESSION['allGOOD'] = true;

// check email
$_SESSION['email'] = $_POST['email'];

// sanitization of email
$_SESSION['email_check'] = filter_var($_SESSION['email'], FILTER_SANITIZE_EMAIL);

// check if email is incorrect / if filters do not cut or change anything 
if((filter_var($_SESSION['email_check'], FILTER_VALIDATE_EMAIL) == false) || ($_SESSION['email_check']!=$_SESSION['email']))
{
    // incorrect email / set the flag and save error message
    $_SESSION['allGOOD'] = false;
    $_SESSION['error_email_msg'] = "<h2 class='error'>Insert correct email format please</h2>";
}

// check password
$_SESSION['password'] = $_POST['password'];
$_SESSION['password_repeat'] = $_POST['password_repeat'];

// check lenght of passwords
if((strlen($_SESSION['password']) < 8) || strlen(($_SESSION['password']) > 20))
{
    $_SESSION['allGOOD'] = false;
    $_SESSION['error_password_msg'] = "<h2 class='error'>Password incorrect! (minimum 8 and maximum 20 characters)</h2>";

}

// check if the passwords are the same / if not than break registration and display an error message
if($_SESSION['password'] != $_SESSION['password_repeat'])
{
    $_SESSION['allGOOD'] = false;
    $_SESSION['error_password_msg2'] = "<h2 class='error'>Passwords are not the same!</h2>";

}

// encryption of password
$_SESSION['password_hash'] = password_hash($_SESSION['password'], PASSWORD_DEFAULT);

// chceck recapcha

    // save secret key
    $secret_key = "6Lfx7egUAAAAAFVaBHMMjGgktcW1mU_g00pbWqpj";

    // check from google site
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST[
        'g-recaptcha-response']);

    // decode format json from google
    $answer = json_decode($check);

    if($answer->success == false)
    {

        $_SESSION['allGOOD'] = false;
        $_SESSION['error_bot_msg'] = "<h2 class='error'>Confirm that you aren't a bot!</h2>";

    }

// connecting into database
require_once "connect.php";

// reports errors
mysqli_report(MYSQLI_REPORT_STRICT);

// block for error hadling as exceptios try/catch
try
{

    // connecting into database
    $connection = new mysqli($host, $db_user, $db_password, $db_name);

    // if connection failed
    if($connection->connect_errno!=0)
    {
        // error message
        throw new Exception(mysqli_connect_errno());

    } else
    {
        // for SQL purposes
        $email = $_SESSION['email'];

        // is email exist
        $result = $connection->query("SELECT id FROM users WHERE email = '$email'");

        // if connection do not connect
        if(!$result) throw new Exception($connection->error);

        // check how many emails this connection found (0 or 1)
        $how_many_emails = $result->num_rows;

        // check if connection found any
        if($how_many_emails > 0)
        {

            $_SESSION['allGOOD'] = false;
            $_SESSION['error_email_msg'] = "<h2 class='error'>This email is already in use!</h2>";

        }

        // if there is no errors than save into database
        if($_SESSION['allGOOD'] == true)
        {

            // for sql purposes
            $pass = $_SESSION['password_hash'];
            unset($_SESSION['password_hash']);

            // add new user into database
            if($connection->query("INSERT INTO users VALUES (NULL, '$email', '$pass', 'user')"))
            {

                //variable to tell another page that ragistration is succesful
                $_SESSION['registration_Successful'] = true;

                // go to Home page
                header('Location: Home');

            } else // if query fail
            {
                throw new Exception($connection->error);
            }

            
        } else
        {

        header('Location: Sign-in');

        }

        // delete flag
        unset($_SESSION['allGOOD']);
        
        // closing connection
        $connection->close();
    }


} catch(Exception $e)
{
    // error message
    $_SESSION['error_connection'] ="<h2 class='error'>Server error!</h2>";
    header('Location: Sign-in');

}

