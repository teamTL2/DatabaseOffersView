<?php

require_once('DBConnection.php');

class GetGpsShops {
    private $_connection;	
	private $_Longitude_User;
	private $_Latitude_User;
	private $_distance;
    private $_Xmin;
    private $_Xmax;
    private $_Ymin;
    private $_Ymax;
	
	
	
    public function __construct(){
        $this->_connection = new DBConnection();
		$this->_Longitude_User = $_POST['Longitude_User'];
		$this->_Latitude_User = $_POST['Latitude_User'];
		$this->_distance = 0.002000;
		$this->_Xmin = $this->_Latitude_User - $this->_distance;
		$this->_Xmax = $this->_Latitude_User + $this->_distance;
		$this->_Ymin = $this->_Longitude_User - $this->_distance;
		$this->_Ymax = $this->_Longitude_User + $this->_distance;
    }

    public function get_Gps_Shops(){
        echo"$this->_Ymax >Longitude > $this->_Ymin      $this->_Xmax > Latitude> $this->_Xmin";
        $stmt=mysqli_stmt_init($this->_connection->dbConnect());
        mysqli_stmt_prepare($stmt,"SELECT Shop_ID , ShopName FROM shops WHERE ( ? >= Longitude AND Longitude >= ? AND ? >= Latitude AND Latitude >= ?)");
        mysqli_stmt_bind_param($stmt,"dddd", $this->_Ymax, $this->_Ymin, $this->_Xmax, $this->_Xmin);
		mysqli_stmt_execute($stmt);

        $stmt->bind_result($_SESSION['Shop_ID'], $_SESSION['ShopName']);
        $i = 1;
        $rows=1;

        $response['shops'] = array();
        $Shop = array();
        while (mysqli_stmt_fetch($stmt)) {
            $Shop["Shop_ID"] =$_SESSION['Shop_ID'];
            $Shop["ShopName"] =$_SESSION['ShopName'];
            array_push($response['shops'], $Shop);
        }
        if(!($Shop==null)){
            $response["success"] = 1;
            // echoing JSON response
            echo json_encode($response);
        } else {
            $response["success"] = 0;
            $response["message"] = "No shops found";
            // epistrefi JSON
            echo json_encode($response);
        }
        mysqli_stmt_close($stmt);
    }
}
$newListShops = new GetGpsShops();
$newListShops->get_Gps_Shops();
?>

