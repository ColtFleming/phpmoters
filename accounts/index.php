<?php
//This is the accounts controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the main model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the navigation functions
require_once '../library/functions.php';

// Get the array of classifications from DB using model
$classifications = getClassifications();

// Build a navigation bar using the classifications array
$navList = buildNavigation($classifications);

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action =filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'login-page':
        include '../view/login.php';
        break;
    case 'Login':
        // Filter and store the data
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if( empty($clientEmail) || empty($checkPassword)){
            $message = '<p class="warningMessage">Please provide a valid email address and password.</p>';
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
        $message = '<p class="warningMessage">Please check your password and try again.</p>';
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
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // check for existing email
        $existingEmail = checkExistingEmail($clientEmail);

        // Deal with existing email during registration
        if($existingEmail){
            $message = '<p class="warningMessage">The email address already exists. Do you want to login instead?<p>';
            include '../view/login.php';
            exit;
        }
        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p class="warningMessage">Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if($regOutcome === 1){
            //setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['loggedin'] = TRUE;
            //$message = "<p class='success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            $_SESSION['message'] = "<p class='success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p class='warningMessage'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'register-page':
        include '../view/registration.php';
        break;
    case 'Logout':
        session_unset();
        session_destroy();
        header('Location: /phpmotors/');
    break;
    case 'updateAccView':
        
        include '../view/client-update.php';
        exit;    
    break;
    case 'updateInfo':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = $_SESSION['clientData']['clientId'];

        if($clientEmail !== $_SESSION['clientData']['clientEmail']){
            // check for existing email
            $existingEmail = checkExistingEmail($clientEmail);

            if($existingEmail){
                $message = '<p class="warningMessage">The email address already exists.<p>';
                include '../view/client-update.php';
                exit;
            }
        }
        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) ){
            $message = '<p class="warningMessage">Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }
        $updateInfo = updateInfo($clientFirstname, $clientLastname, $clientEmail, $clientId);
        if ($updateInfo) {
            $clientData = getClientInfo($clientId);
            // Remove the password from the array the array_pop function removes the last element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            $message = "<p class='success'>$clientFirstname, Your information has been updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='warningMessage'>Sorry $clientFirstname, we could not update your account information. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
    break;
    case 'updatePassword':
        $clientId = $_SESSION['clientData']['clientId'];
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        // Check for missing data
        if(empty($clientPassword) ){
            $message2 = '<p class="warningMessage">Please enter the password followed by the prompt in order to update the password.</p>';
            include '../view/client-update.php';
            exit; 
        }
        $checkPassword = checkPassword($clientPassword);
        if($checkPassword == 0){
            $message2 = '<p class="warningMessage">Please make sure your password matches the desired pattern.</p>';
            include '../view/client-update.php';
            exit; 
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $updatePassword = updatePassword($hashedPassword, $clientId);
        if ($updatePassword) {
            $clientData = getClientInfo($clientId);
            // Remove the password from the array the array_pop function removes the last element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            $clientFirstname = $_SESSION['clientData']['clientFirstname'];
            $message = "<p class='success'>$clientFirstname, Your password has been updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message2 = "<p class='warningMessage'>Sorry $clientFirstname, we could not update your account password. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
    break;
    default:
        include '../view/admin.php';
    break;
}
