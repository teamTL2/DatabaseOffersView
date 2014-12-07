<?php
 
/*
 * diagrafi ena agapimeto katastima enos user
 * 
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['Shop_ID']) && isset($_POST['Username']) && isset($_POST['Password'])) {
    $shop_id = $_POST['Shop_ID'];
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched pid
    $result = mysql_query(" DELETE FROM favorite WHERE Shop_ID='$shop_id' AND Username='$Username' AND Password='$Password' ");

    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "favorite successfully deleted";
 
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
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>