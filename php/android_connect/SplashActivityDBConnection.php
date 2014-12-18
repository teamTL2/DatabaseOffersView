<?php
require_once('DBConnection.php');

class SplashActivityDBConnection {
    private $_connection;

    public function __construct(){
        $this->_connection = new DBConnection();
    }

    public function checkDbConnect(){

        $stmt=mysqli_stmt_init($this->_connection->dbConnect());
        if(mysqli_stmt_errno($stmt)){
            $response["success"] = 0;
            // echoing JSON response
            echo json_encode($response);
        }else{
            $response["success"] = 1;
            // echoing JSON response
            echo json_encode($response);
        }
    }
}

$newSplashActivityDB = new SplashActivityDBConnection();
$newSplashActivityDB->checkDbConnect();
?>