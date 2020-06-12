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
	<style>
		p.sts{ 
			padding-bottom: 0em
		}
		p.hrg{ 
			 text-align: right;
		}
		p.bth{ 
			 text-align: right;
			 color: gold;
		}
	</style>
</head>
<body>
	<?php
	$idgpls = $_POST['idgopulsa'];
	$idorder = $_POST['idorder'];
	$nohp = $_POST['nohp'];
	$jm = $_POST['jm'];
	$tgl = $_POST['tgl'];
	$sts = $_POST['sts'];
	$mtdbyr = $_POST['mtdbyr'];
	?>
	<div class="container">
	
	<center>
		<div class='card-header text-center'><h1 style="font-weight: bold;">GoPulsa</h1></div></br>
	</center>

	<table class="table">
		<thead>
			<tr>
				<th>DETAIL PESANAN<button type="button" class="btn btn-outline-success btn-lg" disabled><?php echo $sts; ?></button></th>
				<th><?php echo $tgl.', '.$jm; ?>
			</tr>
		</thead>
		<thead>
			<tr>
				<th>METODE PEMBAYARAN</th>
				<th><?php echo $mtdbyr; ?></th>
			</tr>
		</thead>
			<tr>
				<?php
					$url = "https://ssl0w2bzs3.execute-api.ap-northeast-1.amazonaws.com/getGoPulsa";
					$data = file_get_contents($url);
					$gpls = json_decode($data, TRUE);
				?>
				<?php foreach ($gpls as $gpls) : 
					if ($gpls['ID_GoPulsa'] == $idgpls) {
						echo "<th>$nohp </br>ID Order - $idorder</th>";
						echo "<th>Rp ".$gpls['Harga']."</th>";
					}
				?>
				<?php endforeach; ?>
			</tr>
		</thead>
		<thead>
			<tr>
				<?php
					$url = "https://ssl0w2bzs3.execute-api.ap-northeast-1.amazonaws.com/getGoPulsa";
					$data = file_get_contents($url);
					$gpls = json_decode($data, TRUE);
				?>
				<?php foreach ($gpls as $gpls) : 
					if ($gpls['ID_GoPulsa'] == $idgpls) {
						echo "<th>".$gpls['Jenis']." ".$gpls['Nominal']."</br><p>".$gpls['Detail']."</p></th>";
						echo "<th></th>";
					}
				?>
				<?php endforeach; ?>
			</tr>
		</thead>
		<thead>
			<tr>
				<th>DETAIL PEMBAYARAN</th>
				<th></th>
			</tr>
		</thead>
		<thead>
			<tr>
				<?php
					$url = "https://ssl0w2bzs3.execute-api.ap-northeast-1.amazonaws.com/getGoPulsa";
					$data = file_get_contents($url);
					$gpls = json_decode($data, TRUE);
				?>
				<?php foreach ($gpls as $gpls) : 
					if ($gpls['ID_GoPulsa'] == $idgpls) {
						echo "<th>".$gpls['Jenis']." ".$gpls['Nominal']."</th>";
						echo "<th>Rp ".$gpls['Harga']."</th>";
					}
				?>
				<?php endforeach; ?>
			</tr>
		</thead>
		<thead>
			<tr><?php
					$url = "https://ssl0w2bzs3.execute-api.ap-northeast-1.amazonaws.com/getGoPulsa";
					$data = file_get_contents($url);
					$gpls = json_decode($data, TRUE);
				?>
				<?php foreach ($gpls as $gpls) : 
					if ($gpls['ID_GoPulsa'] == $idgpls) {
						echo "<th><button type='button' class='btn btn-primary btn-lg btn-block disabled'>Total -Rp ".$gpls['Harga']."</button></th>";
						echo "<th></th>";
					}
				?>
				<?php endforeach; ?>
			</tr>
		</thead>
		<thead>
			<tr>
				<th><button type="button" class="btn btn-success btn-md btn-block">PESAN LAGI</button>
				<th></th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th><p class="bth">BUTUH BANTUAN?<p></th>
				<th></th>
			</tr>
		</thead>
</body>