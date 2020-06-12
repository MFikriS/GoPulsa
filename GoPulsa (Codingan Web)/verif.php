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
</head>
<?php
	$idgpls = $_GET['idgpls'];
	$idakun = $_GET['idakun'];
	$nominal = $_GET['nominal'];
	$nohp = $_GET['nohp'];
	$harga = $_GET['harga'];
	$mtdbyr = $_GET['mtdbyr'];
	$nominal = $_GET['nominal'];
	$jns = $_GET['jns'];
	$id = "GPL-";
	$num = str_pad(mt_rand(1,99999999),4,'0',STR_PAD_LEFT);
	$id_order = $id ."".$idakun."_".$num;
	ini_set('date.timezone', 'Asia/Jakarta');
	$tgl = date('d-m-Y');
	$jam = date('H:i:s');
	 
	
	echo "<center>";
	echo "<div class='card text-center bg-light mb-3 'style='width: 28rem';'>";
	echo "<div class='card-header'><h2 text-center>Konfirmasi Pembelian</h2></div>";
	echo "<form>";
		
		// Tampil saldo pulsa terakhir
	
		$url = "https://r79r1vy1oh.execute-api.ap-northeast-1.amazonaws.com/getPulsaPktDt";
		$data = file_get_contents($url);
		$nomorHP = json_decode($data, TRUE);
	
		 foreach ($nomorHP as $nomorHP) : 
			if($nomorHP['No_HP'] == $nohp){
			  echo "<input hidden type='text' id='Pulsa' name='Pulsa' value='".$nomorHP['Pulsa']."' readonly />";
			  echo "<input hidden type='text' id='Paket_Data' name='Paket_Data' value='".$nomorHP['Paket_Data']."' readonly />";
			}
		endforeach;
		
		echo "<input hidden type='text' id='ID_GoPulsa' name='ID_GoPulsa' value=".$idgpls." readonly />";
		echo "<input hidden type='text' id='Tanggal_Order' name='tgl' value=".$tgl." readonly />";
		echo "<input hidden type='text' id='Jam_Order' name='jam' value=".$jam." readonly />";
		echo "<input hidden type='text' id='ID_Order' name='id_order' value=".$id_order." readonly />";
		echo "<input hidden type='text' id='ID_Akun' name='idakun' value=".$idakun." readonly />";
		echo "<input hidden type='text' id='jns' name='jns' value='".$jns."' readonly />";
		echo "</br></br>";
		echo "<h4>$jns $nominal</h4>";
		echo "<input hidden type='text' class='form-control form-control-sm' id='nominal' name='nominal' value='".$nominal."' readonly />";
		echo "</br>";
		echo "<h4>Nomor Handphone : $nohp</h4>";
		echo "<input hidden type='text' id='No_HP' class='form-control form-control-sm'  name='nohp' value=".$nohp." readonly />";
		echo "</br>";
		echo "<h4>Metode Bayar : $mtdbyr</h4>";
		echo "<input hidden type='text' id='Metode_Bayar' class='form-control form-control-sm'  name='mtdbyr' value=".$mtdbyr." readonly />";
		echo "</br>";
		echo "<h4>Harga : Rp. $harga</h4>";
		echo "</br></br>";echo "<input hidden type='text' id='hrg' name='hrg' value=".$harga." readonly />";
		if($mtdbyr == "GoPay"){
		$sldgopay = $_GET['sldgpy'];
		echo "<input hidden type='text' id='sldgopay' name='sldgopay' value=".$sldgopay." readonly />";
		}else if($mtdbyr == "PayLater"){
		$sldpayltr = $_GET['sldpyltr'];
		echo "<input hidden type='text' id='sldpayltr' name='sldpayltr' value=".$sldpayltr." readonly />";
		}
		echo "<button id='submit' class='btn btn-primary btn-lg'>Beli</button>";
	echo "</form>";
	echo "<h3 id='abcd'></h3>"
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
	var API_URL = 'https://nj0qwfikg6.execute-api.ap-northeast-1.amazonaws.com/postOrder/';
	var api_pulsa = 'https://luiluja1y9.execute-api.ap-northeast-1.amazonaws.com/updatePulsa/';
	var api_pktdt = 'https://kxt3udfz7a.execute-api.ap-northeast-1.amazonaws.com/updatePaketData';
	var api_gopay = 'https://4k6k7d9z5i.execute-api.ap-northeast-1.amazonaws.com/updateGoPay';
	var api_paylater = 'https://7q37qjr10m.execute-api.ap-northeast-1.amazonaws.com/updatePayLater';
	
	$(document).ready(function() {
		$('#submit').on('click', function(event){
			event.preventDefault();
			
			var ID_Order = $("#ID_Order").val(),
			ID_GoPulsa = $("#ID_GoPulsa").val(),
			ID_Akun = $("#ID_Akun").val(),
			Tanggal_Order = $("#Tanggal_Order").val(),
			Jam_Order = $("#Jam_Order").val(),
			Metode_Bayar = $("#Metode_Bayar").val(),
			Jenis = $("#jns").val(),
			No_HP = $("#No_HP").val(),
			nominal3 = $("#nominal").val(),
			pulsa = $("#Pulsa").val(),
			paketdata = $("#Paket_Data").val(),
			pulsa2 = Number(pulsa),
			harga = $("#hrg").val(),
			harga2 = Number(harga),
			nominal2 = Number(nominal3),
			saldo_pulsa = pulsa2 + nominal2,
			Status = "Berhasil";
			
			
			if(Metode_Bayar == "GoPay"){
				var Saldo_GoPay = $("#sldgopay").val(),
				sldgpy = Number(Saldo_GoPay),
				sisa_saldogpy = sldgpy - harga2; 
			}else{
				var Saldo_PayLater = $("#sldpayltr").val(),
				sldpyltr = Number(Saldo_PayLater),
				sisa_saldopyltr = sldpyltr - harga2; 
			}
			
			$.ajax({
				type: "POST",
				url: API_URL,
				crossDomain: true,
				contentType: 'application/json',
				data: JSON.stringify({
					'ID_Order': ID_Order,
					'ID_GoPulsa': ID_GoPulsa,
					'ID_Akun': ID_Akun,
					'Tanggal_Order': Tanggal_Order,
					'Jam_Order': Jam_Order,
					'Metode_Bayar': Metode_Bayar,
					'No_HP': No_HP,
					'Status': Status
				}),
				success: function(res) {
					if(Jenis == "Pulsa"){
						$.ajax({
							type: "PUT",
							url: api_pulsa,
							crossDomain: true,
							contentType: 'application/json',
							data: JSON.stringify({
								'No_HP': No_HP,
								'Pulsa': saldo_pulsa
							}),
							success: function(res) {
								if(Metode_Bayar == "GoPay"){
									$.ajax({
										type: "PUT",
										url: api_gopay,
										crossDomain: true,
										contentType: 'application/json',
										data: JSON.stringify({
											'ID_Akun': ID_Akun,
											'Saldo_GoPay': sisa_saldogpy
										}),
										success: function(res) {
											$('#abcd').text('Sukses');
											window.alert("Pembelian Sukses");
											window.location.href = "index.php";
										},
										error: function(){
											 $('#abcd').text('Gagal');
										}
									});
								}else{
									$.ajax({
										type: "PUT",
										url: api_paylater,
										crossDomain: true,
										contentType: 'application/json',
										data: JSON.stringify({
											'ID_Akun': ID_Akun,
											'Saldo_PayLater': sisa_saldopyltr
										}),
										success: function(res) {
											$('#abcd').text('Sukses');
											window.alert("Pembelian Sukses");
											window.location.href = "index.php";
										},
										error: function(){
											$('#abcd').text('Gagal');
										}
									});
								}
								$('#abcd').text('Sukses');
								window.alert("Pembelian Sukses");
								window.location.href = "index.php";
							},
							error: function(){
								 $('#abcd').text('Gagal');
							}
						});
					}else{
						$.ajax({
							type: "PUT",
							url: api_pktdt,
							crossDomain: true,
							contentType: 'application/json',
							data: JSON.stringify({
								'No_HP': No_HP,
								'Paket_Data': nominal
							}),
							success: function(res) {
								if(Metode_Bayar == "GoPay"){
									$.ajax({
										type: "PUT",
										url: api_gopay,
										crossDomain: true,
										contentType: 'application/json',
										data: JSON.stringify({
											'ID_Akun': ID_Akun,
											'Saldo_GoPay': sisa_saldogpy
										}),
										success: function(res) {
											$('#abcd').text('Sukses');
											window.alert("Pembelian Sukses");
											window.location.href = "index.php";
										},
										error: function(){
											 $('#abcd').text('Gagal');
										}
									});
								}else{
									$.ajax({
										type: "PUT",
										url: api_paylater,
										crossDomain: true,
										contentType: 'application/json',
										data: JSON.stringify({
											'ID_Akun': ID_Akun,
											'Saldo_PayLater': sisa_saldopyltr
										}),
										success: function(res) {
											$('#abcd').text('Sukses');
											window.alert("Pembelian Sukses");
											window.location.href = "index.php";
										},
										error: function(){
											$('#abcd').text('Gagal');
										}
									});
								}
							},
							error: function(){
								$('#abcd').text('Gagal');
							}
						});
					}
				},
				error: function(){
					 $('#abcd').text('Gagal');
				}
			});
		})
	});
</script>
