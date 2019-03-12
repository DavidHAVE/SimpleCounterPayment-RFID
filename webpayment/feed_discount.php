<?php 
 
 //Importing the database connection 
 require_once('config/koneksi.php');
 
 //SQL query to fetch data of a range 
 $sql = "SELECT * FROM discount";
 
 //Getting result 
 $result = mysqli_query($konek, $sql); 
 
 //Adding results to an array 
 $res = array(); 
 
 while($row = mysqli_fetch_array($result)){
 array_push($res, array(
 "discount_id"=>$row['discount_id'],
 "total"=>$row['total'],
 "discount"=>$row['discount'])
 );
 }
 //Displaying the array in json format 
 echo json_encode($res);
?>