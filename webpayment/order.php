<?php
session_start();
include "config/koneksi.php";

$response = array();

if(isset($_GET['apicall'])){
		
	switch($_GET['apicall']){


// INSERT

		case 'insert':

			if (isset($_POST['fullNameM'])) {

				$full_name_m = $_POST['fullNameM'];
				$nick_name_m = $_POST['nickNameM'];
				$father_name_m = $_POST['fatherNameM'];
				$mother_name_m = $_POST['motherNameM'];
				$parent_address_m = $_POST['parentAddressM'];
				$full_name_w = $_POST['fullNameW'];
				$nick_name_w = $_POST['nickNameW'];
				$father_name_w = $_POST['fatherNameW'];
				$mother_name_w = $_POST['motherNameW'];
				$parent_address_w = $_POST['parentAddressW'];

				$day_and_date = $_POST['dayAndDate'];
				$time = $_POST['time'];
				$place = $_POST['place'];
				$wedding_card_quantity = $_POST['weddingCardQuantity'];
				$payment_completed = $_POST['paymentCompleted'];
				$order_time = $_POST['orderTime'];
				$full_name_o = $_POST['fullNameO'];
				$nick_name_o = $_POST['nickNameO'];
				$email_o = $_POST['emailO'];
				$telephone_o = $_POST['telephoneO'];

				$item_id_fk = $_POST['itemIdFK'];
				$discount_id_fk = $_POST['discountIdFK'];
				$seller_id_fk = $_POST['sellerIdFK'];


				$input = "INSERT INTO orders(full_name_m, nick_name_m, father_name_m, mother_name_m, parent_address_m, full_name_w, nick_name_w, father_name_w, mother_name_w, parent_address_w, date_e, time_e, place, quantity, payment_completed, order_time, full_name_o, nick_name_o, email_o, telephone_o, item_id_fk, discount_id_fk, seller_id_fk) VALUES ('$full_name_m', '$nick_name_m', '$father_name_m', '$mother_name_m', '$parent_address_m', '$full_name_w', '$nick_name_w', '$father_name_w', '$mother_name_w', '$parent_address_w', '$day_and_date', '$time', '$place', '$wedding_card_quantity', '$payment_completed', '$orderTime', '$full_name_o', '$nick_name_o', '$email_o', '$telephone_o', '$item_id_fk', '$discount_id_fk', '$seller_id_fk')";

				$sql = mysqli_query($konek, $input);

				if ($sql) {
					// header("location:../../hero.php?module=item");
				}else{
					echo "Menyimpan di database gagal.";
				}

			}else{
				echo "Gagal.";
			}

		break; 



// UPDATE PAYMENT
			
        case 'update_payment':

			if (isset($_POST['paymentCompleted'])) {

				$order_id = $_GET['orderId'];
				$payment_completed =  $_POST['paymentCompleted'];

				$update = "UPDATE orders SET payment_completed = '$payment_completed' WHERE order_id = '$order_id'";

				$sql = mysqli_query($konek, $update);

				if ($update) {
					$sql = "SELECT full_name_o, payment_completed FROM orders WHERE order_id = '$order_id'";
 
 					//Getting result 
 					$result = mysqli_query($konek, $sql); 
					 
					 //Adding results to an array 
					 $res = array(); 

					 if ($sql) {

					 	$full_name_o;
					 	$payment_completed;
					 
						 while($row = mysqli_fetch_array($result)){
						 	$full_name_o = $row['full_name_o'];
						 	$payment_completed = $row['payment_completed'];


						// $item = array(
						// 			'item_id'=>$row['item_id'],
						// 			'name'=>$row['name'],
						// 			'description'=>$row['description'],
						// 			'price'=>$row['price'],
						// 			'image_url'=>$row['image_url']
						// 		);

		 			// 	$response['error'] = false; 
		 			// 	$response['message'] = 'Read successfull'; 
		 			// 	$response['item'] = $item; 



		 				$status = array(
		 							"payment_completed"=>$row['payment_completed']
		 						);



		 				$response['error'] = false; 
		 				$response['message'] = 'Update successfull'; 
		 				$response['status'] = $status;


			 				// array_push($res, array(
								// "payment_completed"=>$row['payment_completed'])
			 				// );
			 			}

			 		// 	require_once __DIR__ . '/notifications/notification.php';
						// $notification = new Notification();
	
						// $title = "Order";
						// $message = "Pesanan ".$full_name_o." membayar : ".$payment_completed;
						// $imageUrl = isset($_POST['image_url'])?$_POST['image_url']:'';
						// $action = isset($_POST['action'])?$_POST['action']:'';
						
						// $actionDestination = isset($_POST['action_destination'])?$_POST['action_destination']:'';
	
						// if($actionDestination ==''){
						// 	$action = '';
						// }
						// $notification->setTitle($title);
						// $notification->setMessage($message);
						// $notification->setImage($imageUrl);
						// $notification->setAction($action);
						// $notification->setActionDestination($actionDestination);
						
						// $firebase_token = "ec_iaeXB2cg:APA91bFShdECIiBYi3Hs5libMVhXCSyNFCPHPb90DpOf11oE36rRPBrOHg7cEQPnO4UOIFFf8GGbjXtXCm3jqBtXjt3oeMIIsIq6XofgqtIJ9WOo3PYf-wdVVY1YQR02QLgyUDWBwnd3";
						// $firebase_api = "AAAAS0FiMUk:APA91bHz68yjmPR0HCombT_0ZEKFqDCWlT-zThJU2HNJRE7o4ZcwsxP6VVwVNr9myYUfgG4ydlVcTSUY1JFxd8UYQ7q8wRroaH1VO2sUBKkMVKdTJsGgorFI2D9BhZ2RS43wrtUQCzUy";
				
						
						// $requestData = $notification->getNotificatin();
						
								
						// 	$fields = array(
						// 		'to' => $firebase_token,
						// 		'data' => $requestData,
						// 	);
			
		
						// // Set POST variables
						// $url = 'https://fcm.googleapis.com/fcm/send';
 
						// $headers = array(
						// 	'Authorization: key=' . $firebase_api,
						// 	'Content-Type: application/json'
						// );
						
						// // Open connection
						// $ch = curl_init();
 
						// // Set the url, number of POST vars, POST data
						// curl_setopt($ch, CURLOPT_URL, $url);
 
						// curl_setopt($ch, CURLOPT_POST, true);
						// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
						// // Disabling SSL Certificate support temporarily
						// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
						// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
						// // Execute post
						// $result = curl_exec($ch);
						// if($result === FALSE){
						// 	die('Curl failed: ' . curl_error($ch));
						// }
 
						// // Close connection
						// curl_close($ch);
						
						// echo '<h2>Result</h2><hr/><h3>Request </h3><p><pre>';
						// echo json_encode($fields,JSON_PRETTY_PRINT);
						// echo '</pre></p><h3>Response </h3><p><pre>';
						// echo $result;
						// echo '</pre></p>';
		 		    }
		 		   

				}else{
					// echo "Gagal Update";
					 	$response['error'] = true; 
		 				$response['message'] = 'Update unsuccessfull'; 
				}

			}else{
				echo "Gagal.";
			}

				 //Displaying the array in json format 
				 echo json_encode($response);

		break; 



// UPDATE ORDER
			
        case 'update_order':

			if (isset($_POST['orderCompleted'])) {

				$order_id = $_GET['orderId'];
				$order_completed =  $_POST['orderCompleted'];


							// $order_id;
							// $full_name_m;
							// $nick_name_m;
		 				// 	$father_full_name_m;
							// $mother_name_m;
							// $parent_address_m ;
							// $full_name_w;
							// $nick_name_w;
							// $father_full_name_w;
							// $mother_name_w;
							// $parent_address_w;

							// $day_and_date;
							// $wedding_time;
							// $place;
							// $wedding_card_quantity;
							// $payment_completed;
							// $order_time;
							// $order_price;
							// $full_name_o;
							// $nick_name_o;
							// $email_o;
							// $telephone_o;
							// $design_url;

							// $item_id_fk;
							// $discount_id_fk;
							// $seller_id_fk;


				if ($order_completed == "true") {
					

					$sql = "SELECT * FROM orders WHERE order_id = $order_id";
 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

		 			if ($result) {

					//Adding results to an array 
					$res = array(); 
					 
					while($row = mysqli_fetch_array($result)){
		 				// array_push($res, array(
							
							// "order_time" => $row['order_time'],
							// "username"=>$row['username'])

						$full_name_m = $row['full_name_m'];
						$nick_name_m = $row['nick_name_m'];
						$father_full_name_m = $row['father_full_name_m'];
						$mother_name_m = $row['mother_name_m'];
						$parent_address_m = $row['parent_address_m'];

						$full_name_w = $row['full_name_w'];
						$nick_name_w = $row['nick_name_w'];
						$father_full_name_w = $row['father_full_name_w'];
						$mother_name_w = $row['mother_name_w'];
						$parent_address_w = $row['parent_address_w'];

						$day_and_date = $row['day_and_date'];
						$wedding_time = $row['wedding_time'];
						$place = $row['place'];
						$latitude = $row['latitude'];
						$longtitude = $row['longtitude'];
						$wedding_card_quantity = $row['wedding_card_quantity'];
						$payment_completed = $row['payment_completed'];
						$order_time = $row['order_time'];
						$order_price = $row['order_price'];

						$full_name_o = $row['full_name_o'];
						$nick_name_o = $row['nick_name_o'];
						$email_o = $row['email_o'];
						$telephone_o = $row['telephone_o'];

						$design_url = $row['design_url'];

						$message = $row['message'];
						$souvenir_quantity = $row['souvenir_quantity'];

						$souvenir_id_fk = $row['souvenir_id_fk'];
						$addon_id_fk = $row['addon_id_fk'];
						$image_id_fk = $row['image_id_fk'];
						$item_id_fk = $row['item_id_fk'];
						$discount_id_fk = $row['discount_id_fk'];
						$seller_id_fk = $row['seller_id_fk'];
			 		}
						
						$input = "INSERT INTO orders_history(full_name_m, nick_name_m, father_full_name_m, mother_name_m, parent_address_m, full_name_w, nick_name_w, father_full_name_w, mother_name_w, parent_address_w, day_and_date, wedding_time, place, latitude, longtitude, wedding_card_quantity, payment_completed, order_time, order_price, full_name_o, nick_name_o, email_o, telephone_o, design_url, message, souvenir_quantity, souvenir_id_fk, addon_id_fk, image_id_fk, item_id_fk, discount_id_fk, seller_id_fk) VALUES ('$full_name_m', '$nick_name_m', '$father_full_name_m', '$mother_name_m', '$parent_address_m', '$full_name_w', '$nick_name_w', '$father_full_name_w', '$mother_name_w', '$parent_address_w', '$day_and_date', '$wedding_time', '$place', '$latitude', '$longtitude', '$wedding_card_quantity', '$payment_completed', '$order_time', '$order_price', '$full_name_o', '$nick_name_o', '$email_o', '$telephone_o', '$design_url', '$message', '$souvenir_quantity', '$souvenir_id_fk', '$addon_id_fk', '$image_id_fk', '$item_id_fk', '$discount_id_fk', '$seller_id_fk')";

						$sql = mysqli_query($konek, $input);

						if ($sql) {
							
							$hapus = "DELETE FROM orders WHERE order_id = $order_id";
							$sql = mysqli_query($konek, $hapus);
							if ($sql) {
								// header("location:/web/hero.php?module=report");
								// echo "Berhasil hapus";
								$response['error'] = false; 
		 						$response['message'] = 'Delete successfull'; 	
							}else{
								// echo "Gagal hapus";
								$response['error'] = true; 
		 						$response['message'] = 'Insert unsuccessfull'; 
							}

						}else{
							// echo "Menyimpan di database gagal.";
							$response['error'] = true; 
		 					$response['message'] = 'Insert unsuccessfull'; 
						}
					}else{
						$response['error'] = true; 
		 				$response['message'] = 'Select unsuccessfull'; 
					}

		 			}else{
		 				// echo "Gagal 2";
		 				$response['error'] = true; 
		 				$response['message'] = 'Payment not completed'; 
		 			}
		 			echo json_encode($response);
		 		}

		break; 



// SELECT
		case 'select':

			$sql = "SELECT orders.order_id, orders.full_name_o, orders.order_time, orders.payment_completed, seller.username FROM orders JOIN seller ON orders.seller_id_fk = seller.seller_id";
 
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
					"order_id" => $row['order_id'],
					"full_name_o" => $row['full_name_o'],
					"order_time" => $row['order_time'],
					"username" => $row['username'],
					"payment_completed" => $row['payment_completed'])
 				);
 			}
			 //Displaying the array in json format 
			 echo json_encode($res);

 		break;

// SELECTID
		case 'selectid':

			$seller_id = $_GET['sellerId'];

			$sql = "SELECT orders.order_id, orders.full_name_o, orders.order_time, seller.username FROM orders JOIN seller ON orders.seller_id_fk = seller.seller_id WHERE seller.seller_id = $seller_id";
 
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
					"order_id" => $row['order_id'],
					"full_name_o" => $row['full_name_o'],
					"order_time" => $row['order_time'],
					"username"=>$row['username'])
 				);
 			}
			 //Displaying the array in json format 
			 echo json_encode($res);

 		break;



// SELECTALLID
		case 'selectall':

			$order_id = $_GET['orderId'];

			$sql = "SELECT * FROM orders JOIN seller ON orders.seller_id_fk = seller.seller_id WHERE orders.order_id = $order_id";
 
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
					
					// "order_time" => $row['order_time'],
					// "username"=>$row['username'])

					"order_id" => $row['order_id'],
					"full_name_m" => $row['full_name_m'],
					"nick_name_m" => $row['nick_name_m'],
 					"father_full_name_m" => $row['father_full_name_m'],
					"mother_name_m" => $row['mother_name_m'],
					"parent_address_m" => $row['parent_address_m'],
					"full_name_w" => $row['full_name_w'],
					"nick_name_w" => $row['nick_name_w'],
					"father_full_name_w" => $row['father_full_name_w'],
					"mother_name_w" => $row['mother_name_w'],
					"parent_address_w" => $row['parent_address_w'],

					"day_and_date" => $row['day_and_date'],
					"wedding_time" => $row['wedding_time'],
					"place" => $row['place'],
					"latitude" => $row['latitude'],
					"longtitude" => $row['longtitude'],
					"wedding_card_quantity" => $row['wedding_card_quantity'],
					"payment_completed" => $row['payment_completed'],
					"order_time" => $row['order_time'],
					"order_price" => $row['order_price'],
					"full_name_o" => $row['full_name_o'],
					"nick_name_o" => $row['nick_name_o'],
					"email_o" => $row['email_o'],
					"telephone_o" => $row['telephone_o'],
					"design_url" => $row['design_url'],
					"username"=>$row['username'],

					"message"=>$row['message'],

					"item_id_fk" => $row['item_id_fk'],
					"souvenir_id_fk" => $row['souvenir_id_fk'],
					"addon_id_fk" => $row['addon_id_fk'],
					"image_id_fk" => $row['image_id_fk'],
					"discount_id_fk" => $row['discount_id_fk'],
					"seller_id_fk" => $row['seller_id_fk'])
	 				);
 			}
			 //Displaying the array in json format 
			 echo json_encode($res);

 		break;




// SELECTIDHISTORY
		case 'selectidhistory':

			$seller_id = $_GET['sellerId'];

			$history = array(); 

			$sql = "SELECT orders_history.order_history_id, orders_history.full_name_o, orders_history.order_time, seller.username FROM orders_history JOIN seller ON orders_history.seller_id_fk = seller.seller_id WHERE seller.seller_id = $seller_id";
 
 			//Getting result 
 			$result = mysqli_query($konek, $sql); 

 			if ($result) {
			 // if ($result) {
			 // 	echo "Berhasil";
			 // }else{
			 // 	echo "Gagal";
			 // }
			 
			 //Adding results to an array 
				
				 
				 while($row = mysqli_fetch_array($result)){

	 				array_push($history, array(
						"order_history_id" => $row['order_history_id'],
						"full_name_o" => $row['full_name_o'],
						"order_time" => $row['order_time'],
						"username"=>$row['username'])
	 				);

	 					// $history = array(
							// 		"order_id" => $row['order_id'],
							// 		"full_name_o" => $row['full_name_o'],
							// 		"order_time" => $row['order_time'],
							// 		"username"=>$row['username']
							// );


	 				// $response['error'] = false; 
				 	// $response['message'] = 'Select successfull';
				 	// $response['history'] = $history; 
	 			}
	 		}else{
	 				array_push($history, array(
						"error" => "true",
						"message"=> "unsuccessfull")
	 				);
	 			// $response['error'] = true; 
				// $response['message'] = 'Select unsuccessfull'; 			
	 		}
			 //Displaying the array in json format 
			echo json_encode($history);

 		break;



// SELECTHISTORYALLID
		case 'selecthistoryall':

			$order_id = $_GET['orderId'];

			$sql = "SELECT * FROM orders_history JOIN seller ON orders_history.seller_id_fk = seller.seller_id WHERE orders_history.order_history_id = $order_id";
 
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
					
					// "order_time" => $row['order_time'],
					// "username"=>$row['username'])

					"order_history_id" => $row['order_history_id'],
					"full_name_m" => $row['full_name_m'],
					"nick_name_m" => $row['nick_name_m'],
 					"father_full_name_m" => $row['father_full_name_m'],
					"mother_name_m" => $row['mother_name_m'],
					"parent_address_m" => $row['parent_address_m'],
					"full_name_w" => $row['full_name_w'],
					"nick_name_w" => $row['nick_name_w'],
					"father_full_name_w" => $row['father_full_name_w'],
					"mother_name_w" => $row['mother_name_w'],
					"parent_address_w" => $row['parent_address_w'],

					"day_and_date" => $row['day_and_date'],
					"wedding_time" => $row['wedding_time'],
					"place" => $row['place'],
					"latitude" => $row['latitude'],
					"longtitude" => $row['longtitude'],
					"wedding_card_quantity" => $row['wedding_card_quantity'],
					"payment_completed" => $row['payment_completed'],
					"order_time" => $row['order_time'],
					"order_price" => $row['order_price'],
					"full_name_o" => $row['full_name_o'],
					"nick_name_o" => $row['nick_name_o'],
					"email_o" => $row['email_o'],
					"telephone_o" => $row['telephone_o'],
					"design_url" => $row['design_url'],
					"username"=>$row['username'],

					"message"=>$row['message'],

					"item_id_fk" => $row['item_id_fk'],
					"souvenir_id_fk" => $row['souvenir_id_fk'],
					"addon_id_fk" => $row['addon_id_fk'],
					"image_id_fk" => $row['image_id_fk'],
					"discount_id_fk" => $row['discount_id_fk'],
					"seller_id_fk" => $row['seller_id_fk'])
	 				);
 			}
			 //Displaying the array in json format 
			 echo json_encode($res);

 		break;



// INSERT REPORT

		case 'insert_report':

			if (isset($_POST['sellerId'])) {

				$seller_id_fk = $_POST['sellerId'];


				$input = "INSERT INTO report(income_total, month, month_buyer_amount, month_income, month_salary, seller_id_fk) VALUES ('$income_total', '$month', '$month_buyer_amount', '$month_income', '$month_salary', '$seller_id_fk')";

				$sql = mysqli_query($konek, $input);

				if ($sql) {
					// header("location:../../hero.php?module=item");
				}else{
					echo "Menyimpan di database gagal.";
				}

			}else{
				echo "Gagal.";
			}

		break; 




// UPDATE REPORT
			
        case 'update_report':

			if (isset($_POST['reportId']) && isset($_POST['orderCompleted'])) {

				$report_id =  $_POST['reportId'];
				$income_total = $_POST['incomeTotal'];
				$month = $_POST['month'];
				$month_buyer_amount = $_POST['monthBuyerAmount'];
				$month_income = $_POST['monthIncome'];
				$month_salary = $_POST['monthSalary'];

				$order_completed = $_POST['orderCompleted'];

				if ($order_completed == "true") {

				// $today = date("d.m.y");                           // 10.03.01

				// $query = "SELECT month FROM report WHERE report_id = '$report_id'";
				// $hasil = mysqli_query($konek, $query);

				// if ($hasil) {
				// $r = mysqli_fetch_array($hasil);
				// $month = $r['month'];

				// if ($month == $today) {

				$update = "UPDATE report SET income_total = '$income_total',
				month = '$month',
				month_buyer_amount = '$month_buyer_amount',
				month_income = '$month_income',
				month_salary = '$month_salary'
				WHERE report_id = '$report_id'";

				$sql = mysqli_query($konek, $update);

				if ($update) {
					// $sql = "SELECT payment_completed FROM orders WHERE order_id = '$order_id'";
 
 					$response['error'] = false; 
				 	$response['message'] = 'Update successfull';
				 	// $response['status'] = 0;

 				// 	$result = mysqli_query($konek, $sql); 
					 
					//  //Adding results to an array 
					//  $res = array(); 
					 
					//  while($row = mysqli_fetch_array($result)){
		 		// 		array_push($res, array(
					// 		"payment_completed"=>$row['payment_completed'])
		 		// 		);
		 		// 	}
					 //Displaying the array in json format 
					 // echo json_encode($res);
				}else{
					// echo "Gagal Update";

 					$response['error'] = true; 
				 	$response['message'] = 'Update unsuccessfull';
				}

				echo json_encode($response);
			// }else{

			// 	$input = "INSERT INTO report(income_total, month, month_buyer_amount, month_income, month_salary, seller_id_fk) VALUES ('$income_total', '$month', '$month_buyer_amount', '$month_income', '$month_salary', '$seller_id_fk')";

			// 	$sql = mysqli_query($konek, $input);

			// 	if ($sql) {
			// 		// header("location:../../hero.php?module=item");
			// 	}else{
			// 		echo "Menyimpan di database gagal.";
			// 	}
			// }
			// }

			// }else{
			// 	echo "Gagal.";
				}
			}

		break; 




// READ REPORT
			
        case 'read_report':

			if (isset($_POST['sellerIdFk']) && isset($_POST['orderCompleted'])) {

				$seller_id_fk = $_POST['sellerIdFk'];
				$month = $_POST['month'];
				$order_completed = $_POST['orderCompleted'];
				// $income_total = $_POST['income_total'];
				// $month_buyer_amount = $_POST['month_buyer_amount'];
				// $month_income = $_POST['month_income'];
				// $month_salary = $_POST['month_salary'];

				$today = date("d/m/Y");   
                        // 10.03.01
				// $order_id = $_GET['orderId'];

				if ($order_completed == "true") {

				$query = "SELECT * FROM report WHERE seller_id_fk = '$seller_id_fk'";
				$hasil = mysqli_query($konek, $query);

				$row_count = mysqli_num_rows($hasil);

				$row = mysqli_fetch_array($hasil);

				$month = $row['month'];


				if ($hasil) {
				
					if ($row_count > 0 && $month == $today) {
						// while($row){


							$report = array(
									'report_id' => $row['report_id'],
									'income_total' => $row['income_total'],
									'month' => $row['month'],
									'month_buyer_amount' => $row['month_buyer_amount'],
									'month_income' => $row['month_income'],
									'month_salary' => $row['month_salary']
							);


				 			$response['error'] = false; 
				 			$response['message'] = 'Select successfull';
				 			$response['status'] = 0;
				 			$response['report'] = $report; 
				 		// }

					}else{


						$today = date("d/m/Y");     

						$income_total = 0;
						$month = $today;
						$month_buyer_amount = 0;
						$month_income = 0;
						$month_salary = 0;

						// $report_id = $row['report_id'];


						$insert_report = "INSERT INTO report(income_total, month, month_buyer_amount, month_income, month_salary, seller_id_fk) VALUES ('$income_total', '$month', '$month_buyer_amount', '$month_income', '$month_salary', '$seller_id_fk')";

						$sql_report = mysqli_query($konek, $insert_report);

						if ($sql_report) {

							$query = "SELECT * FROM report WHERE seller_id_fk = '$seller_id_fk'";
							$hasil = mysqli_query($konek, $query);

							$row = mysqli_fetch_array($hasil);

							$response['error'] = false; 
					 		$response['message'] = 'Insert successfull'; 
					 		$response['report_id'] = $row['report_id'];
					 		$response['status'] = 1;
						}else{
							$response['error'] = true; 
					 		$response['message'] = 'Insert unsuccessfull'; 
						}
					}
				}else{
					$response['error'] = true; 
				 	$response['message'] = 'Select unsuccessfull'; 
				}

				echo json_encode($response);
				}
			}

		break; 

		default: 
			$response['error'] = true; 
			$response['message'] = 'Invalid Operation Called';
			break;
		}
		
}else{
	$response['error'] = true; 
	$response['message'] = 'Invalid API Call';
}

?>