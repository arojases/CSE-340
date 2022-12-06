<?php

function checkEmail($clientEmail){

    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;

}

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
function checkPassword($clientPassword){

    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
    
}

function navBar($carclassifications) {
    // Build a navigation bar using the $classifications array
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($carclassifications as $classification) {
       $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}

//will build a display of vehicles within an unordered list.
function buildVehiclesDisplay($vehicles){

    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<a href='/phpmotors/vehicles/?action=pullVehicleData&vehicleId={$vehicle["invId"]}'>";
        $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= "</a>";
        //$dv .= '<hr>';
        $dv .= "<a href='/phpmotors/vehicles/?action=pullVehicleData&vehicleId={$vehicle["invId"]}'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
        //$dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $money = number_format($vehicle['invPrice'], 0, ".", ",");
        $dv .= "<span>$$money</span>";
        $dv .= '</li>';
    }    
    $dv .= '</ul>';
    
    return $dv;
}

function vehicleDetailPage($vehicle) {
    $money = number_format($vehicle['invPrice'], 0, ".", ",");
    $dv = "<h1>$vehicle[invMake] $vehicle[invModel]</h1>";
    $dv .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= "<p>Price: $$money</p>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel] Details</h2>";
    $dv .= "<p>$vehicle[invDescription]</p>";
    $dv .= "<p><b>Color: </b>$vehicle[invColor]</p>";
    $dv .= "<p><b>Quantity in Stock: </b>$vehicle[invStock]</p>";
    //$dv .= "<p><b>Classification: </b>$vehicle[classificationId]</p>";
    
    return $dv;
}

// The function builds a block of html for a review.
function buildReview($clientFirstName, $clientLastName, $date, $reviewText){
    $htmlText = "<p>";
    
    // Put in the clients name.
    $htmlText .= substr($clientFirstName, 0, 1).". ".$clientLastName;

    // Add a brake and then put in the date.
    $timestamp = strtotime($date);
    $htmlText .= "<br>Posted on: ".date('m/d/Y H:i:s', $timestamp);

    // Add another brake and then post the review text.
    $htmlText .= "<br><br>".$reviewText;

    $htmlText .= "</p>";
    return $htmlText;
}

// The function builds a block of html for the review list.
function buildReviewItem($reviewDate, $reviewId) {
    $htmlText = '<li>';
    $timestamp = strtotime($reviewDate);
    $htmlText .= 'Review Created on: '.date('m/d/Y H:i:s', $timestamp);
    $htmlText .= ' <a href = "/phpmotors/reviews/index.php?action=confirmEdit&review='.$reviewId.'">Edit</a>';
    $htmlText .= ' | ';
    $htmlText .= '<a href = "/phpmotors/reviews/index.php?action=confirmDelete&review='.$reviewId.'">Delete</a>';
    $htmlText .= '</li>';
    return $htmlText;
}