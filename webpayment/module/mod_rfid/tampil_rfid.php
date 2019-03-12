<h2>Add On</h2>
<form method="POST" action="hero.php?module=form_addon">
	<input type="submit" value="Tambah Item">
</form>
<table>
	<tr><th>No</th>><th>Nama</th><th>Saldo</th><th>Nomor RFID</th><th>Aksi</th></tr>
	<?php
	include "config/koneksi.php";

	$query = "SELECT * FROM rfid_profile ORDER BY rfid_id ASC";
	$tampil = mysqli_query($konek, $query);
	$no = 1;
	while ($r=mysqli_fetch_array($tampil)){
		echo "<tr><td>".$no."</td>";
		echo "<td>".$r['name']."</td>";
		echo "<td>".$r['balance']."</td>";
		echo "<td>".$r['rfid_number']."</td>";
		echo "<td><a href='menu.php?module=edit_rfid&id=".$r['rfid_id']."'>Edit</a>"; 
		echo " | ";
		echo "<a href='menu.php?module=hapus_rfid&id=".$r['rfid_id']."'>Hapus</a></td>";
		echo "</tr>";
		$no++;
	}

	 // echo "<td><img src='images/".$data['foto']."' width='100' height='100'></td>";
	?>
</table>