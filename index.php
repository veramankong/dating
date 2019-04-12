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

//Create an instance of the Base class
$f3 = Base::instance();

//fat-free error reporting
$f3->

//define a default route
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

//Run fat free
$f3->run();

?>