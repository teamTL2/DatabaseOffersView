<?php
 
/*
 * perni ta GPS stixia enos user kai
 * mesa se ena tetragono psaxni ta katastimata poy ipasxoyn kai epistrefi pia einai
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["Longitude_User"]) && isset($_GET["Latitude_User"])) {
    $Longitude_User = $_GET['Longitude_User'];
	$Latitude_User = $_GET['Latitude_User'];
	$distance=0.002000;
    $Xmin = $Latitude_User - $distance;
    $Xmax = $Latitude_User + $distance;
    $Ymin = $Longitude_User - $distance;
    $Ymax = $Longitude_User + $distance;
 
    // get a product from products table
    $result = mysql_query("	SELECT Shop_ID, ShopName, Longitude, Latitude FROM Shops WHERE ('$Ymax' >= Longitude AND Longitude >= '$Ymin' AND '$Xmax' >= Latitude AND Latitude >= '$Xmin')");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			$response["Shops"] = array();
			 
			while ($row = mysql_fetch_array($result)) {
				// temp user array
				$Shop = array();
				$Shop["Shop_ID"] = $row["Shop_ID"];
				$Shop["ShopName"] = $row["ShopName"];
				$Shop["Longitude"] = $row["Longitude"];
				$Shop["Latitude"] = $row["Latitude"];
							 
				// push single Shop into final response array
				array_push($response["Shops"], $Shop);
			}
			// success
			$response["success"] = 1;
			 
			// echoing JSON response
			echo json_encode($response);
            
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No Offer found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No Offer found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>