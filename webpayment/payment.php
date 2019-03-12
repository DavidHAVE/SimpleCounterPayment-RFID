<?php

   include "config/koneksi.php";	

	$infus = $_POST["infus"];
   $count = $_POST["count"];


   $query = "SELECT * FROM rfid_profile WHERE rfid_number = '$nomorrfid'";
   $hasil = mysqli_query($konek, $query);

if ($hasil) {
   while ($row = mysqli_fetch_array($hasil)){

   $id = $row['rfid_id'];
   $nama = $row['name'];
   $saldo = $row['balance'] - 1;
   $nomorrfid = $row['rfid_number'];
}

   $edit = "UPDATE rfid_profile SET name = '$nama',
   balance = '$saldo',
   rfid_number = '$nomorrfid'
   WHERE rfid_id = '$id'";

   $sql = mysqli_query($konek, $edit);
   if ($sql) {
      // header("location:../../menu.php?module=rfid");
      echo "Sukses mengubah";
   }else{
      echo "Gagal mengubah";
   }
}else{
   echo "Gagal mengambil data";
}

?>
