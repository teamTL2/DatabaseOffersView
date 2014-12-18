<?php
require_once('DBConnection.php');

class GetAllOffersShop {
    private $_connection;
    private $_ShopID;



    public function __construct(){
        $this->_connection = new DBConnection();
        $this->_ShopID = $_POST['Shop_ID'];
    }

    public function get_all_Offers_Shop()
    {
        if ($this->_ShopID) {

            $stmt = mysqli_stmt_init($this->_connection->dbConnect());
            mysqli_stmt_prepare($stmt, "SELECT Offer_ID, Shop_ID, Offer FROM offers ");
            $stmt->bind_param("s",$this->_ShopID);
            mysqli_stmt_execute($stmt);

            $stmt->bind_result($_SESSION['Offer_ID'],$_SESSION['Shop_ID'],$_SESSION['Offer']);
            $i = 1;
            $rows=1;

            $response['offers'] = array();
            while ($i == $rows) {
                $Offer = array();
                $cID= $_SESSION['Offer_ID'];
                mysqli_stmt_fetch($stmt);
                $Offer["Offer_ID"] = $_SESSION['Offer_ID'];
                $Offer["Shop_ID"] = $_SESSION['Shop_ID'];
                $Offer["Offer"] = $_SESSION['Offer'];
                if(!($cID==$_SESSION['Offer_ID'])){
                    array_push($response['offers'], $Offer);
                    $rows=$rows+1;
                }
                $i = $i + 1;
            }
            if(!($rows==1)){
                $response["success"] = 1;
                // echoing JSON response
                echo json_encode($response);
            } else {
                $response["success"] = 0;
                $response["message"] = "No Offer found";
                // epistrefi JSON
                echo json_encode($response);
            }
            mysqli_stmt_close($stmt);
        }else {
            $response["success"] = 0;
            $response["message"] = "Required field(s) is missing";

            // epistrefi JSON
            echo json_encode($response);
        }
    }
}
$newListOffersShop = new GetAllOffersShop();
$newListOffersShop->get_all_Offers_Shop();
?>