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
	  <script type = 'text/javascript' src = "assets/js/ceknoHP.js"></script> 
	  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<div class="container">
  <ul class="nav justify-content-center">
  <a class="navbar-brand" href="#">
    <img src="gopulsa.png" width=100>
    </a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="#">Home</a>
   </div>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <a class="nav-item nav-link active" href="riwayat_order.php">Riwayat </a>
   </div>
  </ul>
  </nav>
  </br>
  
  <ul class="nav justify-content-center">
    <li class="nav-item">
	<img src="gopay.png" width=40>
    </li>
    <li class="nav-item">
	  <?php
			$url = "https://iugxeki85h.execute-api.ap-northeast-1.amazonaws.com/getAkunGojek";
			$data = file_get_contents($url);
			$akun = json_decode($data, TRUE);
	  ?>
	  <?php foreach ($akun as $akun) : 
		if($akun['ID_Akun'] == "002"){
		  echo "<a class='nav-link'>RP. ".$akun['Saldo_GoPay']."</a>";
		}
	  ?>
	<?php endforeach; ?>
    </li>
    
  </ul>
  </br>
  <ul class="nav justify-content-center">
    <li class="nav-item">
       <form action="detail.php" method="post">
			<div class="form-row">
			  <div class="col">
				<input type="nomor" class="form-control no_hp" id="no_hp" placeholder="Masukkan No. Handphone" name="no_hp" onkeypress="return isNumberKey(event)" required>				
			 </div>
			</div>
		</form>
    </li>
    <li class="nav-item">
	<img src="kontak.png" width=35>
    </li>
  </ul>
  </br>
  <center>
	<div id="target"></div>
		<input hidden type="text" id="test" name="abcd" readonly />
		<!-- <input type="submit" value="Cari Pulsa" > -->
  </center>
  </br>
	 <ul class="nav justify-content-center">
	   <ul class="nav nav-pills" role="tablist">
		<li class="nav-item">
		  <a class="nav-link active" data-toggle="pill" href="#pulsa">Pulsa</a>
		</li>
	   <li class="nav-item">
		  <a class="nav-link" data-toggle="pill" href="#pkt_dt">Paket Data</a>
		</li>
	  </ul>
	</ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div id="pulsa" class="container tab-pane active"><br>
     <table class="table">
		<?php
			$url = "https://ssl0w2bzs3.execute-api.ap-northeast-1.amazonaws.com/getGoPulsa";
			$url2 = "https://iugxeki85h.execute-api.ap-northeast-1.amazonaws.com/getAkunGojek";
			$data = file_get_contents($url);
			$data2 = file_get_contents($url2);
			$json = json_decode($data, TRUE);
			$akun = json_decode($data2, TRUE);
		?>
				<?php foreach ($json as $json) : 
					if ($json['Provider'] == $_GET["Provider"] && $json['Jenis'] == "Pulsa") {	
						
							echo "<div class='column'>";
								echo "<div class='card'>";
									echo "<form class='form-inline' method = 'post' action= 'detail.php'>";
									echo "<center><h2>".$json['Jenis']."</h2></center>"; 
									echo "<input hidden type='text' id='jns' name='jns' value='".$json['Jenis']."' readonly >";
									echo "<input hidden type='text' id='jns' name='jns' value='".$json['Jenis']."' readonly >";
									echo "<h4 class=card-title'>".$json['Nominal']."</h4>";
									echo "<input hidden type='text' readonly class='form-control-plaintext' id='nominal' name='nominal' value=".$json['Nominal'].">";
									echo "<p>".$json['Detail']."</p>";
									echo "<h4>Harga Rp. ".$json['Harga']."</h4>";
									echo "<input hidden type='text' id='hrg' name='hrg' value='".$json['Harga']."' readonly />";
									echo "<input hidden type='text' id='nohp' name='nohp' value=".$_GET["No_HP"]." readonly />";
									echo "<input hidden type='text' id='ID_Akun' name='ID_Akun' value='002' readonly />";
									echo "<button class='btn btn-primary ' name='ID_GoPulsa' type='submit' value='".$json['ID_GoPulsa']."'>Pilih</button>";echo "</br></br>";
								echo "</form>";
							echo "</div>";
					echo "</div>";	
					}
				?>
				<?php endforeach; ?>
			</table>
    </div>
    <div id="pkt_dt" class="container tab-pane fade"><br>
     <table class="table">
			<tbody>
			<?php
				$url = "https://ssl0w2bzs3.execute-api.ap-northeast-1.amazonaws.com/getGoPulsa";
				$url2 = "https://iugxeki85h.execute-api.ap-northeast-1.amazonaws.com/getAkunGojek";
				$data = file_get_contents($url);
				$data2 = file_get_contents($url2);
				$json = json_decode($data, TRUE);
				$akun = json_decode($data2, TRUE);
			?>
			  <tr>
				<?php foreach ($json as $json) : 
					if ($json['Provider'] == $_GET["Provider"] && $json['Jenis'] == "Paket Data") {
						echo "<div class='column'>";
								echo "<div class='card text-center'>";
									echo "<form class='form-inline' method = 'post' action= 'detail.php'>";
									echo "<center><h2>".$json['Jenis']."</h2></center>"; 
									echo "<input hidden type='text' id='jns' name='jns' value='".$json['Jenis']."' readonly >";
								
									echo "<h4 class=card-title'>".$json['Nominal']."</h4>";
									echo "<input hidden type='text' readonly class='form-control-plaintext' id='nominal' name='nominal' value=".$json['Nominal'].">";
									echo "<p>".$json['Detail']."</p>";
									echo "<h4>Harga Rp. ".$json['Harga']."</h4>";
									echo "<input hidden type='text' id='hrg' name='hrg' value='".$json['Harga']."' readonly />";
									echo "<input hidden type='text' id='nominal' name='nominal' value='".$json['Nominal']."' readonly />";
									echo "<input hidden type='text' id='nohp' name='nohp' value=".$_GET["No_HP"]." readonly />";
									echo "<input hidden type='text' id='ID_Akun' name='ID_Akun' value='002' readonly />";
									echo "<button class='btn btn-primary ' name='ID_GoPulsa' type='submit' value='".$json['ID_GoPulsa']."'>Pilih</button>";echo "</br></br>";
								echo "</form>";
							echo "</div>";
					echo "</div>";	
					}
				?>
				<?php endforeach; ?>
			</div>
  </div>
  </form>
</div>
</body>
</html>