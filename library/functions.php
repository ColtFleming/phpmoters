<?php


// Build a navigation bar using the classifications array
function buildNavigation($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach($classifications as $classification){
        $navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName=".urldecode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Validate the email
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
   }


// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
   }


// Check path pattern
function checkPath($invImage){
    $pattern = '/^\/phpmotors\/images\/.{1,42}/';
    return preg_match($pattern, $invImage);
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

// Wrap vehicles by classification in a list
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles?action=inventory&invId=".urldecode($vehicle['invId'])."' title='View our $vehicle[invMake] $vehicle[invModel]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '<hr>';
     $dv .= "<a href='/phpmotors/vehicles?action=inventory&invId=".urldecode($vehicle['invId'])."' title='View our $vehicle[invMake] $vehicle[invModel]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     $dv .= '<span>$'.number_format($vehicle["invPrice"]).'</span>';
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

// Wrap vehicle info by invId
function buildVehicleInfoDisplay($vehicleInfo){
    $vd = '<div id="vehicle-display">';
    $vd .= "<img src='$vehicleInfo[invImage]' alt='Image of $vehicleInfo[invMake] $vehicleInfo[invModel] on phpmotors.com'>";
    $vd .= "<table id='vehicle-summary'><tr><th>$vehicleInfo[invMake] $vehicleInfo[invModel] Details</th></tr><tr><td>Price: $".number_format($vehicleInfo['invPrice'])."</td></tr><tr><td>Color: $vehicleInfo[invColor]</td></tr><tr><td># in Stock: $vehicleInfo[invStock]</td></tr><tr><td>$vehicleInfo[invDescription]</td></tr></table>";
    
    $vd .= '</div>';
    return $vd;
}