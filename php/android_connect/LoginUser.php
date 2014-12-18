<?php
/**
 * Created by PhpStorm.
 * User: STRATOS
 * Date: 8/12/2014
 * Time: 6:12 μμ
 */

require_once('DBConnection.php');


class LoginUser {
    private $_connection;
    private $_Username;
    private $_Password;
    private $_checkUsername;
    private $_checkPassword;

    public $stmt;


    public function __construct(){
        $this->_connection = new DBConnection();
        $this->_Username = $_POST['Username'];
        $this->_Password = $_POST['Password'];
    }


    public function checkUser(){
        if($this->_Username && $this->_Password) {
            $stmt=mysqli_stmt_init($this->_connection->dbConnect());
            mysqli_stmt_prepare($stmt,"SELECT Username , Password FROM user WHERE Username= ? AND Password= ?");
            mysqli_stmt_bind_param($stmt,"ss",$this->_Username,$this->_Password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$_SESSION['Username'], $_SESSION['Password']);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            $this->_checkUsername = $_SESSION['Username'];
            $this->_checkPassword = $_SESSION['Password'];
            $this->loginUser();
        }else {
            $response["success"] = 0;
            $response["message"] = "Required field(s) is missing";

            // epistrefi JSON
            echo json_encode($response);
        }

    }

    public function loginUser(){
        if ($this->_checkUsername == $this->_Username && $this->_checkPassword == $this->_Password) {

            $response["success"] = 1;
            $response["message"] = "The user found.";
            //epistrefi JSON
            echo json_encode($response);
        }else {
             // alios
            $response["success"] = 0;
            $response["message"] = "No user found";

            // epistrefi JSON
            echo json_encode($response);
            }
    }
}
$newUser = new LoginUser();
$newUser->checkUser();
?>