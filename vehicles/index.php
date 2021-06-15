<?php
//This is the vehicles controller

// Create or access a Session
session_start();

// If not login as Admin, redirect to home
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] == 1){
    header('Location: /phpmotors/');
    exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

// Get the database connection file
require_once '../library/connections.php';
// Get the main model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the navigation functions
require_once '../library/functions.php';

// Get the array of classifications from DB using model
$classifications = getClassifications();

// Build a navigation bar using the classifications array
$navList = buildNavigation($classifications);

// Build the select list
// $classifList = '<select name="classificationId">';
// foreach ($classifications as $classification){
//     $classifList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
// }
// $classifList .= '</select>';


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action =filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'add-classification-page':
        include '../view/add-classification.php';
        break;
    case 'add-vehicle-page':
        include '../view/add-vehicle.php';
        break;
    case 'add-classification':
        // Filter and store the data
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);

        // Check for missing data
        if(empty($classificationName)){
            $message = '<p class="warningMessage">Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }

         // Send the data to the model
        $carOutcome = addClassificationName($classificationName);
        
        // Check and report the result
        if($carOutcome === 1){
            include '../view/vehicleManagement.php';
            header("Refresh:0");/**??? */
            exit;
        }else{
            $message = "<p>Sorry, failed to add $classificationName to the database. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
    case 'add-vehicle':
        // Filter and store the data
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_VALIDATE_INT);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId');

        $checkImage = checkPath($invImage);
        $checkThumbnail = checkPath($invThumbnail);

        // Check for missing data
        if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($checkImage) || empty($checkThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p class="warningMessage">Please provide correct information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit;
        }

         // Send the data to the model
        $invOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
        
        // Check and report the result
        if($invOutcome === 1){
            $message = "<p class='success'>The $invMake $invModel was added successfully!</p>";
            include '../view/add-vehicle.php';
            exit;
        }else{
            $message = "<p class='warningMessage'>Sorry, failed to add the vehicle to the database. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }

    break;
    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
    break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;        
    break;
    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
        $message = '<p class="warningMessage">Please complete all information for the item! Double check the classification of the item.</p>';
        include '../view/vehicle-update.php';
        exit;
        }
        $updatetResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        if ($updatetResult) {
            $message = "<p class='success'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='warningMessage'>Error. The $invMake $invModel was not updated.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
    break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
                $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
    break;
    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='success'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='note'>Error: $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
    break;
    default:

        $classificationList = buildClassificationList($classifications);

        include '../view/vehicleManagement.php';
    break;
}