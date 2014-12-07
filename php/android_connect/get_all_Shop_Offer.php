<?php
 
/*
 * pernei ena katastima kai soy stelnei tis prosforestoy
 * 
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["Shop_ID"])) {
    $shop_id = $_GET['Shop_ID'];
 
    // get a product from products table
    $result = mysql_query("SELECT Offer FROM User WHERE Shop_ID = '$shop_id'");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			$response["Shops"] = array();
			 
			while ($row = mysql_fetch_array($result)) {
				// temp user array
				$Shop = array();
				$Shop["Offer"] = $row["Offer"];
							 
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