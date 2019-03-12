<?php 

	require_once 'DbConnect.php';
	include "config/koneksi.php";
	
	$response = array();
	
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			case 'signup':
				if(isTheseParametersAvailable(array('username','email','password','gender'))){
					$username = $_POST['username']; 
					$email = $_POST['email']; 
					$password = md5($_POST['password']);
					$gender = $_POST['gender']; 
					
					// $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
					// $stmt->bind_param("ss", $username, $email);
					// $stmt->execute();
					// $stmt->store_result();
					
					// if($stmt->num_rows > 0){
					// 	$response['error'] = true;
					// 	$response['message'] = 'User already registered';
					// 	$stmt->close();
					// }else{
						$stmt = $conn->prepare("INSERT INTO users (username, email, password, gender) VALUES (?, ?, ?, ?)");
						$stmt->bind_param("ssss", $username, $email, $password, $gender);

						if($stmt->execute()){
							// $stmt = $conn->prepare("SELECT id, id, username, email, gender FROM users WHERE username = ?"); 
							// $stmt->bind_param("s",$username);
							// $stmt->execute();
							// $stmt->bind_result($userid, $id, $username, $email, $gender);
							// $stmt->fetch();
							
							// $user = array(
							// 	'id'=>$id, 
							// 	'username'=>$username, 
							// 	'email'=>$email,
							// 	'gender'=>$gender
							// );
							
							// $stmt->close();
							
							$response['error'] = false; 
							$response['message'] = 'User registered successfully'; 
							$response['user'] = $user; 
						}
					// }
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}

				echo json_encode($response);
				
			break; 
			
            case 'signup2':
				if(isTheseParametersAvailable(array('fullNameM','nickNameM', 'fatherNameM', 'motherNameM', 'parentAddressM', 'fullNameW','nickNameW', 'fatherNameW', 'motherNameW', 'parentAddressW'))){
					// $username = $_POST['username']; 
					// $email = $_POST['email']; 
					// $password = md5($_POST['password']);
					// $gender = $_POST['gender']; 

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
					
					// $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
					// $stmt->bind_param("ss", $username, $email);
					// $stmt->execute();
					// $stmt->store_result();
					
					// if($stmt->num_rows > 0){
					// 	$response['error'] = true;
					// 	$response['message'] = 'User already registered';
					// 	$stmt->close();
					// }else{
						$stmt = $conn->prepare("INSERT INTO orders (full_name_m, nick_name_m, father_full_name_m, mother_full_name_m, parent_address_m, full_name_w, nick_name_w, father_full_name_w, mother_full_name_w, parent_address_w) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("ssss", $full_name_m, $nick_name_m, $father_name_m, $mother_name_m,$parent_address_m, $full_name_w, $nick_name_w, $father_name_w, $mother_name_w, $parent_address_w);

						if($stmt->execute()){
							// $stmt = $conn->prepare("SELECT full_name_m, nick_name_m, father_name_m, mother_name_m FROM orders"); 
							// $stmt->bind_param("s",$full_name_m);
							// $stmt->execute();
							// $stmt->bind_result($full_name_m, $nick_name_m, $father_name_m, $mother_name_m);
							// $stmt->fetch();
							
							// $user = array(
								// 'id'=>', 
								// 'username'=>$username, 
								// 'email'=>$email,
								// 'gender'=>$gender
							// );
							
							// $stmt->close();
							
							$response['error'] = false; 
							$response['message'] = 'User registered successfully'; 
							$response['user'] = $user; 
						// }else{
						// 	$response['error'] = true; 
						// 	$response['message'] = 'Gagal Menyimpan.'; 
						// }
					}
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break; 


            case 'register':
				if(isTheseParametersAvailable(array('fullNameM','nickNameM', 'fatherNameM', 'parentAddressM'))){

					// $username = $_POST['username']; 
					// $email = $_POST['email']; 
					// $password = md5($_POST['password']);
					// $gender = $_POST['gender']; 

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
					$time = $_POST['weddingTime'];
					$place = $_POST['place'];
					$latitude = $_POST['latitude'];
					$longtitude = $_POST['longtitude'];
					$wedding_card_quantity = $_POST['weddingCardQuantity'];
					$payment_completed = $_POST['paymentCompleted'];
					$order_time = $_POST['orderTime'];
					$order_price = $_POST['orderPrice'];

					$full_name_o = $_POST['fullNameO'];
					$nick_name_o = $_POST['nickNameO'];
					$email_o = $_POST['emailO'];
					$telephone_o = $_POST['telephoneO'];

					$design_url = "";

					$message = $_POST['message'];
					$souvenir_quantity = $_POST['souvenir_quantity'];

					$souvenir_id_fk = $_POST['souvenirIdFk'];
					$addon_id_fk = $_POST['addonIdFk'];
					$image_id_fk = $_POST['imageIdFk'];
					$item_id_fk = $_POST['itemIdFk'];
					$discount_id_fk = $_POST['discountIdFk'];
					$seller_id_fk = $_POST['sellerIdFk'];
					
					// $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
					// $stmt->bind_param("ss", $username, $email);
					// $stmt->execute();
					// $stmt->store_result();
					
					// if($stmt->num_rows > 0){
					// 	$response['error'] = true;
					// 	$response['message'] = 'User already registered';
					// 	$stmt->close();
					// }else{

 // $Sql_Query = "insert into UserInfo (first_name,last_name,email) values ('$f_name','$l_name','$email')";

					$Sql_Query = "INSERT INTO orders (full_name_m, nick_name_m, father_full_name_m,  mother_name_m, parent_address_m, full_name_w, nick_name_w, father_full_name_w,  mother_name_w, parent_address_w, day_and_date, wedding_time, place, latitude, longtitude, wedding_card_quantity, payment_completed, order_time, order_price, full_name_o, nick_name_o, email_o, telephone_o, design_url, message, souvenir_quantity, souvenir_id_fk, addon_id_fk, image_id_fk, item_id_fk, discount_id_fk, seller_id_fk) VALUES ('".$full_name_m."', '".$nick_name_m."', '".$father_name_m."', '".$mother_name_m."', '".$parent_address_m."', '".$full_name_w."', '".$nick_name_w."', '".$father_name_w."', '".$mother_name_w."', '".$parent_address_w."', '".$day_and_date."', '".$time."', '".$place."', '".$latitude."', '".$longtitude."', '".$wedding_card_quantity."', '".$payment_completed."', '".$order_time."', '".$order_price."', '".$full_name_o."', '".$nick_name_o."', '".$email_o."', '".$telephone_o."', '".$design_url."', '".$message."', '".$souvenir_quantity."', '".$souvenir_id_fk."', '".$addon_id_fk."', '".$image_id_fk."', '".$item_id_fk."', '".$discount_id_fk."', '".$seller_id_fk."')";
 
					 if(mysqli_query($con,$Sql_Query)){
						 $response['error'] = false; 
						 $response['message'] = 'sukses menyimpan'; 
					 
					 }
					 else{
						$response['error'] = true; 
						$response['message'] = 'gagal menyimpan'; 
					 }
					 mysqli_close($con);

				// 		$stmt = $conn->prepare("INSERT INTO orders (full_name_m, nick_name_m, father_full_name_m, parent, mothernamem) VALUES (?, ?, ?, ?, ?)");
				// 		$stmt->bind_param("ssss", $full_name_m, $nick_name_m, $father_name_m, $parent_address_m, $mother_name_m);

				// 		if($stmt->execute()){
							
				// 			$response['error'] = false; 
				// 			$response['message'] = 'User registered successfully'; 
				// 			$response['user'] = $user; 

				// }


					}else{
					$response['error'] = true; 
					$response['message'] = 'are not available'; 
					}
					
				// }else{
				// 	$response['error'] = true; 
				// 	$response['message'] = 'required parameters are not available'; 
				// }
				
			break; 

			case 'signup4':
				if(isTheseParametersAvailable(array('fullNameM','nickNameM', 'fatherNameM', 'motherNameM'))){
					// $username = $_POST['username']; 
					// $email = $_POST['email']; 
					// $password = md5($_POST['password']);
					// $gender = $_POST['gender']; 

					$full_name_m = $_POST['fullNameM'];
					$nick_name_m = $_POST['nickNameM'];
					$father_name_m = $_POST['fatherNameM'];
					$mother_name_m = $_POST['motherNameM'];
					// $parent_address_m = $_POST['parentAddressM'];
					// $full_name_w = $_POST['fullNameW'];
					// $nick_name_w = $_POST['nickNameW'];
					// $father_name_w = $_POST['fatherNameW'];
					// $mother_name_w = $_POST['motherNameW'];
					// $parent_address_w = $_POST['parentAddressW'];
					
					// $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
					// $stmt->bind_param("ss", $username, $email);
					// $stmt->execute();
					// $stmt->store_result();
					
					// if($stmt->num_rows > 0){
					// 	$response['error'] = true;
					// 	$response['message'] = 'User already registered';
					// 	$stmt->close();
					// }else{
						$stmt = $conn->prepare("INSERT INTO orders (full_name_m, nick_name_m, father_full_name_m, mother_full_name_m) VALUES (?, ?, ?, ?)");
						$stmt->bind_param("ssss", $full_name_m, $nick_name_m, $father_name_m, $mother_name_m);

						if($stmt->execute()){
							// $stmt = $conn->prepare("SELECT full_name_m, nick_name_m, father_name_m, mother_name_m FROM orders"); 
							// $stmt->bind_param("s",$full_name_m);
							// $stmt->execute();
							// $stmt->bind_result($full_name_m, $nick_name_m, $father_name_m, $mother_name_m);
							// $stmt->fetch();
							
							// $user = array(
								// 'id'=>', 
								// 'username'=>$username, 
								// 'email'=>$email,
								// 'gender'=>$gender
							// );
							
							// $stmt->close();
							
							$response['error'] = false; 
							$response['message'] = 'User registered successfully'; 
							$response['user'] = $user; 
						// }else{
						// 	$response['error'] = true; 
						// 	$response['message'] = 'Gagal Menyimpan.'; 
						// }
					}
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break; 



// LOGIN

			case 'login':
				
			if(isTheseParametersAvailable(array('username', 'password'))){
					
				if (isset($_POST['username'])) {

					$username = $_POST['username'];
					$password = md5($_POST['password']);

					$sql = "SELECT * FROM seller WHERE username = '$username' AND password = '$password'";

		 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

			
					 //Adding results to an array 
					 $res = array(); 

					 if ($result) {
					 
						 while($row = mysqli_fetch_array($result)){
			 			// 	array_push($res, array(

			 			// 		"seller_id" => $row['seller_id'],
							//  					"username" => $row['username'],
							//  					"email" => $row['email'],
							//  					"telephone" => $row['telephone'],
							//  					"city" => $row['city'])
			 			// );

			 				$seller = array(
										'seller_id'=>$row['seller_id'], 
										'username'=>$row['username'], 
										'email'=>$row['email'],
										'telephone'=>$row['telephone'],
										'city'=>$row['city'],
										'buyer_amount'=>$row['buyer_amount'],
										'banner_url'=>$row['banner_url']
									);

			 				$response['error'] = false; 
			 				$response['message'] = 'Login successfull'; 
			 				$response['seller'] = $seller; 
			 			}
		 			}else{
		 				$response['error'] = true; 
			 			$response['message'] = 'Login Unsuccessfull'; 
		 			}
			 // Displaying the array in json format 
 			// echo json_encode($response);
			 // echo json_encode($res);
 				}
 			}	

			break; 


// UPDATE BUYER AMOUNT

			case 'buyeramount':
				
			if(isTheseParametersAvailable(array('buyerAmount', 'sellerId'))){
					
				if (isset($_POST['buyerAmount'])) {

					$seller_id = $_POST['sellerId'];
					$buyer_amount = $_POST['buyerAmount'];

					// $sql = "SELECT * FROM seller WHERE password = '$password'";


					$edit = "UPDATE seller SET buyer_amount = '$buyer_amount'
					WHERE seller_id = '$seller_id'";

		 			//Getting result 
		 			$result = mysqli_query($konek, $edit); 

			
					 //Adding results to an array 
					 // $res = array(); 
					 
					 // while($row = mysqli_fetch_array($result)){
		 			// 	array_push($res, array(

		 			// 		"seller_id" => $row['seller_id'],
						//  					"username" => $row['username'],
						//  					"email" => $row['email'],
						//  					"telephone" => $row['telephone'],
						//  					"city" => $row['city'])
		 			// );

		 				// $seller = array(
							// 		'seller_id'=>$row['seller_id'], 
							// 		'buyer_amount'=>$row['buyer_amount']
							// 	);

		 			if ($result) {
		 				# code...

		 				$response['error'] = false; 
		 				$response['message'] = 'update successfull'; 
		 			}else{
		 				$response['error'] = true; 
		 				$response['message'] = 'update successfull'; 
		 			}

		 			// }
			 // Displaying the array in json format 
 			// echo json_encode($response);
			 // echo json_encode($res);
 				}
 			}	

			break; 



// READ SELLER

			case 'readseller':
				
			if(isTheseParametersAvailable(array('sellerId'))){
					
				if (isset($_POST['sellerId'])) {

					$seller_id = $_POST['sellerId'];

					$sql = "SELECT buyer_amount FROM seller WHERE seller_id = '$seller_id'";

		 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

			
					 //Adding results to an array 
					 $res = array(); 
					 
					 while($row = mysqli_fetch_array($result)){
		 			// 	array_push($res, array(

		 			// 		"seller_id" => $row['seller_id'],
						//  					"username" => $row['username'],
						//  					"email" => $row['email'],
						//  					"telephone" => $row['telephone'],
						//  					"city" => $row['city'])
		 			// );

		 				$seller = array(
									'buyer_amount'=>$row['buyer_amount']
								);

		 				$response['error'] = false; 
		 				$response['message'] = 'Read successfull'; 
		 				$response['seller'] = $seller; 
		 			}
			 // Displaying the array in json format 
 			// echo json_encode($response);
			 // echo json_encode($res);
 				}
 			}	

			break; 



// READ ITEM

			case 'readitem':
				
			if(isTheseParametersAvailable(array('itemId'))){
					
				if (isset($_POST['itemId'])) {

					$item_id = $_POST['itemId'];

					$sql = "SELECT * FROM item WHERE item_id = '$item_id'";

		 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

			
					 //Adding results to an array 
					 $res = array(); 
					 
					 while($row = mysqli_fetch_array($result)){
		 			// 	array_push($res, array(

		 			// 		"seller_id" => $row['seller_id'],
						//  					"username" => $row['username'],
						//  					"email" => $row['email'],
						//  					"telephone" => $row['telephone'],
						//  					"city" => $row['city'])
		 			// );

		 				$item = array(
									'item_id'=>$row['item_id'],
									'name'=>$row['name'],
									'description'=>$row['description'],
									'price'=>$row['price'],
									'image_url'=>$row['image_url']
								);

		 				$response['error'] = false; 
		 				$response['message'] = 'Read successfull'; 
		 				$response['item'] = $item; 
		 			}
			 // Displaying the array in json format 
 			// echo json_encode($response);
			 // echo json_encode($res);
 				}
 			}	

			break; 




// READ SOUVENIR

			case 'readsouvenir':
				
			if(isTheseParametersAvailable(array('souvenirId'))){
					
				if (isset($_POST['souvenirId'])) {

					$souvenir_id = $_POST['souvenirId'];

					$sql = "SELECT * FROM souvenir WHERE souvenir_id = '$souvenir_id'";

		 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

			
					 //Adding results to an array 
					 $res = array(); 

				if ($result) {
					 
					 while($row = mysqli_fetch_array($result)){
		 			// 	array_push($res, array(

		 			// 		"seller_id" => $row['seller_id'],
						//  					"username" => $row['username'],
						//  					"email" => $row['email'],
						//  					"telephone" => $row['telephone'],
						//  					"city" => $row['city'])
		 			// );

		 				$souvenir = array(
									'souvenir_id'=>$row['souvenir_id'],
									'name'=>$row['name'],
									'price'=>$row['price'],
									'image_url'=>$row['image_url']
								);

		 				$response['error'] = false; 
		 				$response['message'] = 'Read successfull'; 
		 				$response['souvenir'] = $souvenir; 
		 			}
		 		}else{
			 		$response['error'] = true; 
			 		$response['message'] = 'Read unsuccessfull'; 
			 	}
			 // Displaying the array in json format 
 			// echo json_encode($response);
			 // echo json_encode($res);
 				}
 			}	

			break; 




// READ ADDON

			case 'readaddon':
				
			if(isTheseParametersAvailable(array('addonId'))){
					
				if (isset($_POST['addonId'])) {

					$addon_id = $_POST['addonId'];

					$sql = "SELECT * FROM addon WHERE addon_id = '$addon_id'";

		 
		 			//Getting result 
		 			$result = mysqli_query($konek, $sql); 

			
					 //Adding results to an array 
					 $res = array(); 

					 if ($result) {
					
					 
						 while($row = mysqli_fetch_array($result)){
			 			// 	array_push($res, array(

			 			// 		"seller_id" => $row['seller_id'],
							//  					"username" => $row['username'],
							//  					"email" => $row['email'],
							//  					"telephone" => $row['telephone'],
							//  					"city" => $row['city'])
			 			// );

			 				$addon = array(
										'addon_id'=>$row['addon_id'],
										'name'=>$row['name'],
										'price'=>$row['price']
									);

			 				$response['error'] = false; 
			 				$response['message'] = 'Read successfull'; 
			 				$response['addon'] = $addon; 
			 			}
			 		}else{
			 			$response['error'] = true; 
			 			$response['message'] = 'Read unsuccessfull'; 
			 		}
			 // Displaying the array in json format 
 			// echo json_encode($response);
			 // echo json_encode($res);
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
	
	echo json_encode($response);
	
	function isTheseParametersAvailable($params){
		
		foreach($params as $param){
			if(!isset($_POST[$param])){
				return false; 
			}
		}
		return true; 
	}