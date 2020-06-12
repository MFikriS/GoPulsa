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
	$jns = $_GET['jns'];
	$hrg = $_GET['harga'];
	$mtdbyr = $_GET['mtdbyr'];
	echo "<center>";
	echo "<div class='card text-center bg-light mb-3' style='width: 28rem;'>";
	
	echo "<div class='card-header'><h2 text-center>Silakan Input PIN pada form di bawah ini</h2></div>";
	echo "</br></br>";
		echo "<form method = 'post' id='form-1' action='cek_saldo.php' name='form_1'>";
		echo "<input hidden type='text' id='ID_GoPulsa' name='ID_GoPulsa' value=".$idgpls." readonly />";
		echo "<input hidden type='text' id='idakun' name='idakun' value=".$idakun." readonly />";
		echo "<input hidden type='text' id='jns' name='jns' value='".$jns."' readonly />";
		echo "<h4>$jns $nominal</h4>";
		echo "<input hidden type='text' id='nominal' class='form-control form-control-sm' name='nominal' value='".$nominal."' readonly />";
		echo "<h4>Nomor Handphone : $nohp</h4>";
		echo "<input hidden type='text' id='nohp' class='form-control form-control-sm' name='nohp' value=".$nohp." readonly />";
		echo "<h4>Harga : Rp. $hrg</h4>";
		echo "<input hidden type='text' id='hrg' name='hrg' value=".$hrg." readonly />";
		if($mtdbyr == "GoPay"){
		$sldgopay = $_GET['sldgpy'];
		echo "<h4>Saldo GoPay Anda : Rp. $sldgopay</h4>";
		echo "<input hidden type='text' id='sldgopay' name='sldgopay' value=".$sldgopay." readonly />";
		}else if($mtdbyr == "PayLater"){
		$sldpayltr = $_GET['sldpyltr'];
		echo "<h4>Saldo PayLater Anda : Rp. $sldpayltr</h4>";
		echo "<input hidden type='text' id='sldpayltr' name='sldpayltr' value=".$sldpayltr." readonly />";
		}
		echo "<h4>Metode Bayar : $mtdbyr</h4>";
		echo "<input hidden type='text' class='form-control form-control-sm' id='mtdbyr' name='mtdbyr' value=".$mtdbyr." readonly />";
		$url = "https://iugxeki85h.execute-api.ap-northeast-1.amazonaws.com/getAkunGojek";
		$data3 = file_get_contents($url);
		$akun2 = json_decode($data3, TRUE);
		echo "<h4>Input Pin<input type='text' class='form-control form-control-sm' placeholder = 'Masukkan pin Anda disini'  id='pin' name='pin' onkeyup='cekpin();' /></h4>";
		echo "</br></br>";
				foreach ($akun2 as $akun) : 
				if($akun['ID_Akun'] == "002"){
					echo "<input hidden type='text' class='form-control form-control-sm' id='pin2' name='pin2' value=".$akun['Pin']." readonly />";
							echo "</td>"; 
						echo "</form>";
				}
				endforeach;
		echo "<h2 id='hsl2'></h2>";
		echo "<h2 id='pin3'></h2>";
		echo "</br></br>";
		echo "</td>";
echo "</div>";		
echo "</center>";
?>
<script type="text/javascript">

	$(document).on('keyup', '.pin', cekpin);
	
    function cekpin(){
        
		var pin = document.getElementById("pin").value;
		var pin2 = document.getElementById("pin2").value;
		var harga = document.getElementById("hrg").value;
		var idgpls = document.getElementById("ID_GoPulsa").value;
		var idakun = document.getElementById("idakun").value;
		var nohp = document.getElementById("nohp").value;
		var nominal = document.getElementById("nominal").value;
		var mtdbyr = document.getElementById("mtdbyr").value;
		var jns = document.getElementById("jns").value;
		
		if((pin == pin2) && (mtdbyr == "GoPay")) {
			var saldogopay = document.getElementById("sldgopay").value;
			window.location.href = "verif.php?harga=" + harga + "&sldgpy=" + saldogopay + "&idgpls=" + idgpls + "&idakun=" + idakun + "&nohp=" + nohp + "&mtdbyr=" + mtdbyr + "&nominal=" + nominal + "&jns=" + jns;
		}else if((pin == pin2) && (mtdbyr == "PayLater")){
			var saldopaylater = document.getElementById("sldpayltr").value;
			window.location.href = "verif.php?harga=" + harga + "&sldpyltr=" + saldopaylater + "&idgpls=" + idgpls + "&idakun=" + idakun + "&nohp=" + nohp + "&mtdbyr=" + mtdbyr + "&nominal=" + nominal + "&jns=" + jns;
		}else{
			document.getElementById('pin3').innerText = "PIN Salah";
		}
	}
</script>

