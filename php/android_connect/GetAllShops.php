<?php
//
//GetAllShops pernei ola ta katastimata kai ta kanei json
//
require_once('DBConnection.php');

class GetAllShops {
    private $_connection;

    public function __construct(){
        $this->_connection = new DBConnection();
    }

    public function get_all_Shops(){
        //kani connection ston server kai ekteli SELECT erotima
        $stmt=mysqli_stmt_init($this->_connection->dbConnect());
        mysqli_stmt_prepare($stmt,"SELECT Shop_ID , ShopName FROM shops");
        mysqli_stmt_execute($stmt);

        $stmt->bind_result($_SESSION['Shop_ID'], $_SESSION['ShopName']);
        $i = 1;
        $rows=1;

        $response['shops'] = array();

        while ($i == $rows) {
            $Shop = array();
            $cID=$_SESSION['Shop_ID'];
            mysqli_stmt_fetch($stmt);
            $Shop["Shop_ID"] =$_SESSION['Shop_ID'];
            $Shop["ShopName"] =$_SESSION['ShopName'];

            if(!($cID==$_SESSION['Shop_ID'])){
                array_push($response['shops'], $Shop);
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
    }
}
$newListShops = new GetAllShops();
$newListShops->get_all_Shops();
?>

