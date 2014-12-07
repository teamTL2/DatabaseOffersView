<?php
 
/*
 * Pernei Shop_ID kai epistrefei
 * ta stixiatoy
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
    $result = mysql_query(" SELECT Shop_ID, ShopName, Street, Phone FROM Shops WHERE Shop_ID='$shop_id'");	

 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $Shop = array();
            $Shop["Shop_ID"] = $result["Shop_ID"];
            $Shop["ShopName"] = $result["ShopName"];
            $Shop["Street"] = $result["Street"];
            $Shop["Phone"] = $result["Phone"];
            
            // success
            $response["success"] = 1;
 
            // user node
            $response["Shop"] = array();
 
            array_push($response["Shop"], $Shop);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no Shop found
            $response["success"] = 0;
            $response["message"] = "No Shop found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no Shop found
        $response["success"] = 0;
        $response["message"] = "No Shop found";
 
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