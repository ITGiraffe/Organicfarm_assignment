<?php

// start using session variables in this page
session_start();

// destroy session to log out
session_unset();

// go to Home page
header('Location: Home');