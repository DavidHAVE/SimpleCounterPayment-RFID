<?php 
 
 //Importing the database connection 
 require_once('config/koneksi.php');
 
 //SQL query to fetch data of a range 
 $sql = "SELECT * FROM addon";
 
 //Getting result 
 $result = mysqli_query($konek, $sql); 
 
 //Adding results to an array 
 $res = array(); 
 
 while($row = mysqli_fetch_array($result)){
 array_push($res, array(
 "addon_id"=>$row['addon_id'],
 "name"=>$row['name'],
 "price"=>$row['price'])
 );
 }
 //Displaying the array in json format 
 echo json_encode($res);
?>