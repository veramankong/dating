<?php


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//define a default route
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

//define a home route
$f3->route('GET /home', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

//Route to information form
$f3->route('GET /information', function() {

    $view = new Template();
    echo $view->render('views/info.html');
});

//Route to profile form
$f3->route('POST /profile', function() {

    //save session variables
    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['lname'] = $_POST['lname'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phone'] = $_POST['phone'];


    $view = new Template();
    echo $view->render('views/profile.html');
});

//Route to interests form
$f3->route('POST /interests', function() {

    //save form info in session for next form
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['bio'] = $_POST['bio'];

    $view = new Template();
    echo $view->render('views/interests.html');
});

//Route to summary
$f3->route('POST /summary', function() {

    //go through interests array
    $interests_string = implode(', ', $_POST['interests']);
    trim($interests_string);
    substr($interests_string, -1);

    //save session variables
    $_SESSION['interests'] = $interests_string;

    $view = new Template();
    echo $view->render('views/summary.html');
});


//Run fat free
$f3->run();

?>