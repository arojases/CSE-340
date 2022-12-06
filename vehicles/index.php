<?php

//Vehicles controller

// Create or access a Session
session_start();


$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the vehicle model for use as needed
require_once '../model/vehicles-model.php';

// Get the review model
require_once '../model/reviews-model.php';

// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
$navList = navBar($classifications);




switch ($action) {
    case 'addclassification':
        include '../view/addclassification.php';
        break;
    case 'addvehicle':
        include '../view/addvehicle.php';
        break;

    case 'addclassidb':

        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

        // Check for missing data
        if(empty($classificationName)){
            $message = '<p>Please provide the new class name.</p>';
            include '../view/addclassification.php';
            exit; 
        }

        // Send the data to the model
        $modeldb = newClassification($classificationName);

        // Check and report the result
        if($modeldb === 1){

            header("Location: /phpmotors/vehicles/index.php");
            exit;

        } else {

            $message = "<p>Sorry but the adding failed. Please try again.</p>";
            include '../view/addclassification.php';
            exit;
            
        }
        break;

    case 'addvehicledb':

        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING));

        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invDescription) 
        || empty($invImage) || empty($invThumbnail) || empty($invPrice) 
        || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/addvehicle.php';
            exit; 
        }

        // Send the data to the model
        $modeldb = newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail,
            $invPrice, $invStock, $invColor, $classificationId);


        // Check and report the result
        if($modeldb === 1){

            $message = "<p>Thanks for adding your new vehicle.</p>";
            include '../view/vehicle-mana.php';
            exit;

        } else {

            $message = "<p>Sorry, but the vehicle registration failed. Please try again.</p>";
            include '../view/addvehicle.php';
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
        
        if (empty($classificationId) || empty($invMake) || empty($invModel) 
        || empty($invDescription) || empty($invImage) || empty($invThumbnail)
        || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
            include '../view/vehicle-update.php';
            exit;
        }

        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

        if ($updateResult===1) {
            $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
            $_SESSION['message'] = $message;
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
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
        $deleteResult = deleteVehicle($invId);

        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;

    case 'classification':

        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);

        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }

        include '../view/classification.php';
        break;

    case 'pullVehicleData':
        $vehicleId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);
        $invInfo = getInvItemInfo($vehicleId);
        $_SESSION['message'] = null;
    
        if (!$invInfo) {
            $_SESSION['message'] = 'Sorry, no vehicle information could be found.';
        }
        else {
            $vehicle = vehicleDetailPage($invInfo);
        }
    
        include '../view/vehicle-detail.php';
        break;

    case 'vehicleView':
        // Filter the input
        $vehicleId = filter_input(INPUT_GET, 'Vehicle', FILTER_SANITIZE_NUMBER_INT);
    
        // Get the vehicles informations
        $vehiclesDetail = getVehicleInfo($vehicleId);
    
        // Get the vehicle thumbnails
        $thumbnailsPath = getThumbnails($vehicleId);
        $thumbnailsList = thumbnailHTML($thumbnailsPath);
    
        // Get the vehicle reviews.
        $reviewList = getInventoryReviews($vehicleId);
    
        // Build the html for the review list.
        $reviewHTML = '<div class = "reviews">';
        foreach($reviewList as $review){
            $reviewHTML .= buildReview($review['clientFirstname'], $review['clientLastname'], $review['reviewDate'], $review['reviewText']);
        }
        $reviewHTML .= "</div>";
    
        // If empty, return an error message back to the user.
        if (empty($vehiclesDetail)){
            $message = "<p class='notice'>There was an error in getting the vehicle's information</p>";
        } else {
            // If not, build the html for the vehicle information
            $vehicleHTML = buildVehiclesHTML($vehiclesDetail);
        }
        include '../view/vehicle-detail.php';
        break;




    default:

        

        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-mana.php';
        break;
}