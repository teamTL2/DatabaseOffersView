<?php
require_once('DBConnection.php');

class GetDetailsShop {
    private $_connection;
    private $_ShopID;

    public function __construct(){
        $this->_connection = new DBConnection();
        $this->_ShopID = $_POST['Shop_ID'];
    }

    public function get_Details_Shop(){

        if ($this->_ShopID) {
            $stmt=mysqli_stmt_init($this->_connection->dbConnect());
            mysqli_stmt_prepare($stmt,"SELECT Shop_ID , ShopName, Street, Email, Phone FROM shops WHERE Shop_ID= ?");
            $stmt->bind_param("s",$this->_ShopID);

            mysqli_stmt_execute($stmt);
            $stmt->bind_result($_SESSION['Shop_ID'], $_SESSION['ShopName'], $_SESSION['Street'], $_SESSION['Email'], $_SESSION['Phone']);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            if(!($_SESSION['Shop_ID']==null)){
                $response['shops'] = array();
                $Shop = array();

                $Shop["Shop_ID"] =$_SESSION['Shop_ID'];
                $Shop["ShopName"] =$_SESSION['ShopName'];
                $Shop["Street"] =$_SESSION['Street'];
                $Shop["Email"] =$_SESSION['Email'];
                $Shop["Phone"] =$_SESSION['Phone'];
                array_push($response['shops'], $Shop);

                $response["success"] = 1;
                // echoing JSON response
                echo json_encode($response);
            }else {
                $response["success"] = 0;
                $response["message"] = "No Details found";
                // epistrefi JSON
                echo json_encode($response);
            }
        }else {
            $response["success"] = 0;
            $response["message"] = "Required field(s) is missing";

            // epistrefi JSON
            echo json_encode($response);
        }
    }
}
$newDetailsShop = new GetDetailsShop();
$newDetailsShop->get_Details_Shop();
?>

