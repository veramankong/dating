<?php


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/validation.php');

//Create an instance of the Base class
$f3 = Base::instance();

//set arrays
$f3->set('indoor1', array('TV', 'Movies', 'Eating', 'Sleeping'));
$f3->set('indoor2', array('Puzzles', 'Toys', 'Window watching', 'Treats'));

$f3->set('outdoor1', array('Hiking', 'Playing fetch', 'Swimming', 'Collecting bones'));
$f3->set('outdoor2', array('Walks', 'Climbing', 'Dog park', 'Chasing cars'));

$f3->set('states', array('Alabama','Alaska','Arizona','Arkansas','California',
        'Colorado','Connecticut','Delaware','District of Columbia','Florida','Georgia',
        'Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana',
        'Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri',
        'Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York',
        'North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island',
        'South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington',
        'West Virginia','Wisconsin','Wyoming'));

//turn on fat-free error reporting
$f3->set('DEBUG', 3);

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
$f3->route('GET|POST /info', function($f3) {

    if(!empty($_POST)) {
        //check first name
        if (isset($_POST['fname'])) {
            $fname = $_POST['fname'];
            $f3->set('fname', $fname);

            //validate first name
            if (validName($fname)) {
                $_SESSION['fname'] = $fname;
            } else {
                $f3->set("errors['fname']", "Please enter an alphabetic first name.");
            }
        }

        //check last name
        if (isset($_POST['lname'])) {
            $lname = $_POST['lname'];
            $f3->set('lname', $lname);

            //validate last name
            if (validName($lname)) {
                $_SESSION['lname'] = $lname;
            } else {
                $f3->set("errors['lname']", "Please enter an alphabetic last name.");
            }
        }

        //check age
        if (isset($_POST['age'])) {
            $age = $_POST['age'];
            $f3->set('age', $age);

            //validate age
            if (validAge($age)) {
                $_SESSION['age'] = $age;
            } else {
                $f3->set("errors['age']", "Please enter a numeric age.");
            }
        }

        //check phone number
        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
            $f3->set('phone', $phone);

            //validate phone number
            if (validPhone($phone)) {
                $_SESSION['phone'] = $phone;
            } else {
                $f3->set("errors['phone']", "Please enter a valid phone number.");
            }
        }

        //get gender
        $_SESSION['gender'] = $_POST['gender'];
        if (isset($_SESSION['fname']) && isset($_SESSION['lname']) && isset($_SESSION['age'])
            && isset($_SESSION['phone'])) {
            $f3->reroute('/profile');
        }
    }

    $view = new Template();
    echo $view->render('views/info.html');
});

//Route to profile form
$f3->route('GET|POST /profile', function($f3) {

    if(!empty($_POST)) {
        //check email
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $f3->set('email', $email);

            //validate email
            if (validEmail($email)) {
                $_SESSION['email'] = $email;
            } else {
                $f3->set("errors['email']", "Please enter a valid email address");
            }
        }
        //get remaining form data
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = trim($_POST['bio']);

        if (isset($_SESSION['email'])) {
            $f3->reroute('/interests');
        }
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

//Route to interests form
$f3->route('GET|POST /interests', function($f3) {

    if(!empty($_POST)) {
        //If no interests are selected
        if (empty($_POST['interests'])) {
            $f3->reroute('/summary');
        }
        //If interests are selected
        if (!empty($_POST['interests'])) {
            $interests = $_POST['interests'];
            //Validate interests
            if (validInterests($interests)) {

                //Create string of interests
                $interests_string = implode(', ', $interests);
                trim($interests_string);
                substr($interests_string, -1);

                //Save form info in session
                $_SESSION['interests'] = $interests_string;
                $f3->reroute('/summary');
            } else {
                $f3->set("errors['interests']", "Please select valid interests");
            }
        }
    }

    $view = new Template();
    echo $view->render('views/interests.html');
});

//Route to summary
$f3->route('GET /summary', function() {

    $view = new Template();
    echo $view->render('views/summary.html');
});


//Run fat free
$f3->run();

?>