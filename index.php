<!--
Vera Mankongvanichkul
4/11/2019
http://vmankongvanichkul.greenriverdev.com/it328/dating
Registration page for an online dog matching site. Made utilizing HTML with Bootstrap.
-->
<?php
/** Created by PhpStorm... */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Header
include('views/header.html');

//Create an instance of the Base class
$f3 = Base::instance();

//define a default route
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

//Route to information form
$f3->route('GET /information', function() {
    $view = new Template();
    echo $view->render('views/info.html');
});

//Route to profile form
$f3->route('GET /profile', function() {
    $view = new Template();
    echo $view->render('views/profile.html');
});

//Route to interests form
$f3->route('GET /interests', function() {
    $view = new Template();
    echo $view->render('views/interests.html');
});

//Route to information form
$f3->route('GET /summary', function() {
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Include footer
include('views/footer.html');


//Run fat free
$f3->run();

?>