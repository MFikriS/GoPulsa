<!DOCTYPE html>
<html lang="en">
<head>
	  <title>GoPulsa</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	  <!-- Bootstrap CSS -->
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">
  <ul class="nav justify-content-center">
  <a class="navbar-brand" href="#">
    <img src="gopulsa.png" width=100>
    </a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="index.php">Home</a>
   </div>


  </ul>
  </nav>
	  <style>
		* {
		  box-sizing: border-box;
		}

		body {
		  font-family: Arial, Helvetica, sans-serif;
		}

		/* Float four columns side by side */
		.column {
		  float: left;
		  width: 25%;
		  padding: 0 10px;
		}

		/* Remove extra left and right margins, due to padding */
		.row {margin: 0 -5px;}

		/* Clear floats after the columns */
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}

		/* Responsive columns */
		@media screen and (max-width: 600px) {
		  .column {
			width: 100%;
			display: block;
			margin-bottom: 20px;
		  }
		}

		/* Style the counter cards */
		.card {
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		  padding: 16px;
		  text-align: center;
		  background-color: #f1f1f1;
		}
	  </style>
</head>
<body>
	<table class="table">
			<tbody>
			  <tr>
				<div class='card-header text-center'><h1 style="font-weight: bold;">Riwayat Pemesanan</h1></div></br>
				<?php
					$url = "https://8myt8y6xch.execute-api.ap-northeast-1.amazonaws.com/getOrder";
					$url2 = "https://ssl0w2bzs3.execute-api.ap-northeast-1.amazonaws.com/getGoPulsa";
					$data = file_get_contents($url);
					$data2 = file_get_contents($url2);
					$order = json_decode($data, TRUE);
					$gopulsa = json_decode($data2, TRUE);
				?>
				<?php foreach ($order as $order) : 
					if ($order['ID_Akun'] == "002") {
						echo "<div class='column'>";
								echo "<div class='card text-center'>";
								echo "<form class='form-inline' method = 'post' action= 'detail_order.php'>";
								echo "<h4 style='font-weight: bold;'>Nomor Handphone</h4>";
								echo "<input hidden type='text' id='nohp' name='nohp' value='".$order['No_HP']."' readonly >";
								echo "<input hidden type='text' id='idgopulsa' name='idgopulsa' value='".$order['ID_GoPulsa']."' readonly >";
								echo "<h4>".$order['No_HP']."</h4>";
								echo "<h4 style='font-weight: bold;'>Tanggal Order</h4>";
								echo "<h4>".$order['Tanggal_Order']." ".$order['Jam_Order']."</h4>";
								echo "<input hidden type='text' id='tgl' name='tgl' value='".$order['Tanggal_Order']."' readonly >";
								echo "<input hidden type='text' id='jm' name='jm' value='".$order['Jam_Order']."' readonly >";
								echo "<input hidden type='text' id='sts' name='sts' value='".$order['Status']."' readonly >";
								echo "<input hidden type='text' id='mtdbyr' name='mtdbyr' value='".$order['Metode_Bayar']."' readonly >";
								echo "<button class='btn btn-primary ' name='idorder' type='submit' value='".$order['ID_Order']."'>Lihat detail</button>";
								echo "</form>";
						echo "</br>";
						echo "</div>";
					echo "</div>";	
					}
				?>
				<?php endforeach; ?>
			  </tr>
			</tbody>
	</table>
</body>
</html>