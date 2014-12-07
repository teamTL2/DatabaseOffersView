<?php
 
/*
 * pernai to Username kai Password kai
 * epistrefi ta agapimena katastimata toy
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["Username"]) && isset($_GET["Password"])) {
    $Username = $_GET['Username'];
	$Password = $_GET['Password'];
	
    // get a product from products table
    $result = mysql_query("SELECT Shop_ID FROM favorite WHERE Username='$Username' AND Password='$Password'");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			$response["favorite"] = array();
			 
			while ($row = mysql_fetch_array($result)) {
				// temp user array
				$favorit = array();
				$favorit["Shop_ID"] = $row["Shop_ID"];
							 
				// push single favorit into final response array
				array_push($response["favorite"], $favorit);
			}
			// success
			$response["success"] = 1;
			 
			// echoing JSON response
			echo json_encode($response);
            
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No favorite found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No favorite found";
 
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