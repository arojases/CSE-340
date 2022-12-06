<?php

//Accounts Controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the accounts model
require_once '../model/accounts-model.php';

// Get the reviews model.
require_once '../model/reviews-model.php';

// Get the functions library
require_once '../library/functions.php';


// Get the array of classifications
$classifications = getClassifications();
$navList = navBar($classifications);


$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action){
    
    case 'login':
        include '../view/login.php';     
        break;
        
    case 'registration':
        include '../view/registration.php';
        break;

    case 'Login':

        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordCheck = checkPassword($clientPassword);

        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
        $message = '<p class="notice">Please provide a valid email address and password.</p>';
        include '../view/login.php';
        exit;
        }
        
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;

        // The list of reviews for the client.
        $reviewList = getClientReviews($_SESSION['clientData']['clientId']);
        $reviewHTML = '<ul>';
        foreach($reviewList as $review){
            $reviewHTML .= buildReviewItem($review['reviewDate'], $review['reviewId']);
        }
        $reviewHTML .= '</ul>';


        // Send them to the admin view
        include '../view/admin.php';
        exit;

        break;

    case 'register':

        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if($existingEmail){
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if($regOutcome === 1){
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }

        break;

    case 'login-page':
        include '../view/login.php';
        break;

    case 'Logout':
        //destroy session
        $_SESSION = array();
        unset($_SESSION['loggedin']);
        session_destroy();
        header('Location: /phpmotors');
        exit; 

    case 'update-page':
        include '../view/client-update.php';
        break;

    case 'updateClient':

        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }

        //Checking for existing email address
        $existingEmail = checkExistingEmail($clientEmail);
        if($existingEmail && $clientEmail !== $_SESSION['clientData']['clientEmail']) {
            $_SESSION['message'] = '<p class="notice">A user with that email address already exists. Do you want to login instead?</p>';
            include '../view/client-update.php';
            exit;
        }

        $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
        if($updateOutcome === 1) {
    
            $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
            $_SESSION['clientData']['clientLastname'] = $clientLastname;
            $_SESSION['clientData']['clientEmail'] = $clientEmail;
            $_SESSION['clientData']['clientId'] = $clientId;
    
            $message = "<p>Thanks for updating $clientFirstname.</p>";
            $_SESSION['message'] = $message;

            //$_SESSION['message'] = "Thanks for updating $clientFirstname.";
            header('Location: /phpmotors/accounts');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            $_SESSION['message'] = $message;

            //$_SESSION['message'] = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }

        break;


    case 'admin':
        include '../view/admin.php';
        break;

    case 'updatePassword':
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $checkPassword = checkPassword($clientPassword);
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        if(empty($checkPassword)){    
            $message1 = '<p>*Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }
    
        $passwordOutcome = updatePassword($hashedPassword, $clientId);
        if($passwordOutcome === 1) {
            $message = "Thanks for updating your password, " . $_SESSION['clientData']['clientFirstname'];
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/?action=admin');
            exit;
        } else {

            $message1 = "<p>Sorry " . $_SESSION['clientData']['clientFirstname'] . ", but the update failed. Please try again.</p>";
            //$_SESSION['message'] = $message;

            include '../view/client-update.php';
            exit;
        }

        break;

    default:

    // The list of reviews for the client.
    $reviewList = getClientReviews($_SESSION['clientData']['clientId']);
    $reviewHTML = '<ul>';
    foreach($reviewList as $review){
        $reviewHTML .= buildReviewItem($review['reviewDate'], $review['reviewId']);
    }
    $reviewHTML .= '</ul>';

    include '../view/admin.php';


    break;
   } 