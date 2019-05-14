<?php


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);



//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/validation.php');

session_start();

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

    //make empty session array
    $_SESSION = array();

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
        if (isset($_POST['gender'])) {
            $gender = $_POST['gender'];
            $f3->set('gender', $gender);
            $_SESSION['gender'] = $_POST['gender'];
        }

        // store in class
        if(isset($_POST['premium'])) {
            $premium = new PremiumMember($fname, $lname, $age, $gender, $phone);
            $_SESSION['memberType'] = $premium;
            $f3->set('memberType', $premium);
        } else {
            $member = new Member($fname, $lname, $age, $gender, $phone);
            $_SESSION['memberType'] = $member;
            $f3->set('memberType', $member);

        }

        //route to next page
        $f3->reroute("/profile");
    }

    $view = new Template();
    echo $view->render('views/info.html');
});

//Route to profile form
$f3->route('GET|POST /profile', function($f3) {

    $memberType = $_SESSION['memberType'];

    if(!empty($_POST)) {
        //save email, state, seeking, and bio
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
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['bio'];

        //add to hive
        $f3->set('state', $state);
        $f3->set('seeking', $seeking);
        $f3->set('bio', $bio);

        //get remaining form data
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = trim($_POST['bio']);

        //save data to class
        $memberType->setEmail($email);
        $memberType->setState($state);
        $memberType->setSeeking($seeking);
        $memberType->setBio($bio);

        $_SESSION['memberType'] = $memberType;
        //check if premium was checked
        if($memberType instanceof PremiumMember) {
            $f3->reroute('/interests');

        //if not checked
        } else {
            //jump to summary
            $f3->reroute('/summary');
        }

    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

//Route to interests form
$f3->route('GET|POST /interests', function($f3) {

    $memberType = $_SESSION['memberType'];

    if(!empty($_POST)) {
        //check outdoor interests
        if(!empty($_POST['outdoor'])) {
            $outdoor = $_POST['outdoor'];
            if(validInterests($outdoor)) {
                $f3->set('outdoor', $outdoor);
                $outdoor_string = implode(', ', $outdoor);
                $memberType->setOutdoorInterests($outdoor_string);
                $_SESSION['outdoor'] = $outdoor_string;
            } else {
                $f3->set("errors['interests']", "Please select valid interests");
            }
        }

        //check indoor interests
        if(!empty($_POST['indoor'])) {
            $indoor = $_POST['indoor'];
            if(validInterests($indoor)) {
                $f3->set('indoor', $indoor);
                $indoor_string = implode(', ', $indoor);
                $memberType->setIndoorInterests($indoor_string);
                $_SESSION['indoor'] = $indoor_string;
            } else {
                $f3->set("errors['interests']", "Please select valid interests");
            }
        }

        // go to summary page
        $f3->reroute('/summary');
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