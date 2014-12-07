<?php
 
/*
 * Following code will list all the Shops
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all Shops from Shops table
$result = mysql_query("SELECT Shop_ID , ShopName FROM Shops") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // Shops node
    $response["Shops"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $Shop = array();
        $Shop["Shop_ID"] = $row["Shop_ID"];
		$Shop["ShopName"] = $row["ShopName"];

 
        // push single Shop into final response array
        array_push($response["Shops"], $Shop);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no Shops found
    $response["success"] = 0;
    $response["message"] = "No Shops found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>