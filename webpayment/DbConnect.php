<?php
//these are the server details
//the username is root by default in case of xampp
//password is nothing by default
//and lastly we have the database named android. if your database name is different you have to change it 
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "upload";
 
//Define your host here.
$HostName = "localhost";

// //Define your database username here.
$HostUser = "root";

// //Define your database password here.
$HostPass = "";

// //Define your database name here.
$DatabaseName = "wedding card";

$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

// if ($con) {
// 	echo "Berhasil tersambung";
//  }else{
//  	echo "Gagal menyambung";
//  }

// //creating a new connection object using mysqli 
// $conn = new mysqli($servername, $username, $password, $database);
 
// //if there is some error connecting to the database
// //with die we will stop the further execution by displaying a message causing the error 
// if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
// }

?>