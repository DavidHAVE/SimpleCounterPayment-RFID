<?php 
 
 //Importing the database connection 
 require_once('config/koneksi.php');
 
 //SQL query to fetch data of a range 
 $sql = "SELECT orders.order_id, orders.full_name_o, orders.order_time, seller.username FROM orders JOIN seller ON orders.seller_id_fk = seller.seller_id";
 
 //Getting result 
 $result = mysqli_query($konek, $sql); 

 // if ($result) {
 // 	echo "Berhasil";
 // }else{
 // 	echo "Gagal";
 // }
 
 //Adding results to an array 
 $res = array(); 
 
 while($row = mysqli_fetch_array($result)){
 array_push($res, array(
 // "total"=>$row['total'],
 // "discount"=>$row['discount'])
"order_id" => $row['order_id'],
"full_name_o" => $row['full_name_o'],
"order_time" => $row['order_time'],
// "father_name_m" => $row['father_full_name_m'],
// "mother_name_m" => $row['mother_name_m'],
// "parent_address_m" => $row['parent_address_m'],
// "full_name_w" => $row['full_name_w'],
// "nick_name_w" => $row['nick_name_w'],
// "father_name_w" => $row['father_full_name_w'],
// "mother_name_w" => $row['mother_name_w'],
// "parent_address_w" => $row['parent_address_w'],

// "day_and_date" => $row['day_and_date'],
// "wedding_time" => $row['wedding_time'],
// "place" => $row['place'],
// "wedding_card_quantity" => $row['wedding_card_quantity'],
// "payment_completed" => $row['payment_completed'],
// "order_time" => $row['order_time'],

// "full_name_o" => $row['full_name_o'],
// "nick_name_o" => $row['nick_name_o'],
// "email_o" => $row['email_o'],
// "telephone_o" => $row['telephone_o'],
// "item_id_fk" => $row['item_id_fk'],
// "discount_id_fk" => $row['discount_id_fk'],
// "seller_id_fk" => $row['seller_id_fk'])
"username"=>$row['username'])

 );
 }
 //Displaying the array in json format 
 echo json_encode($res);
?>