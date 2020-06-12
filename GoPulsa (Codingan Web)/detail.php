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
	  <!-- Bootstrap CSS -->
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
	
<body>	


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

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
  <div class="card text-center">
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
	<div class="card text-center">
	<?php
	$idgpls = $_POST['ID_GoPulsa'];
	$idakun = $_POST['ID_Akun'];
	$jns = $_POST['jns'];
	$nohp = $_POST['nohp'];
	$hrg = $_POST['hrg'];
	$nominal = $_POST['nominal'];
	$sldgopay = $akun['Saldo_GoPay'];
	$sldpayltr = $akun['Saldo_PayLater'];
	echo "<div class='card bg-light mb-3'>";
	
	echo "<div class='card-header'><h1>Silakan Pilih Metode Pembayaran pada form di bawah ini</h1></div>";
	echo "</br></br>";
	echo "<form method = 'post' id='form-1' action='cek_saldo.php' name='form_1'>";
			$url = "https://ssl0w2bzs3.execute-api.ap-northeast-1.amazonaws.com/getGoPulsa";
			$data = file_get_contents($url);
			$json = json_decode($data, TRUE);
		foreach ($json as $json) :
		if($json['ID_GoPulsa'] == $idgpls){
		echo "<input hidden type='text' id='ID_GoPulsa' name='ID_GoPulsa' value=".$idgpls." readonly />";
		echo "<input hidden type='text' id='idakun' name='idakun' value=".$idakun." readonly />";
		echo "<h4>$jns $nominal</h4>";
		echo "<input hidden type='text' id='jns' name='jns' value='".$jns."' readonly />";
		echo "<input hidden type='text' class='form-control form-control-sm' id='nominal' name='nominal' value='".$json['Nominal']."' readonly />";
		echo "<h4>Nomor Handphone : $nohp</h4>";
		echo "<input hidden type='text' id='nohp' class='form-control form-control-sm'  name='nohp' value=".$nohp." readonly />";
		echo "<h4>Harga : Rp. $hrg</h4>";
		echo "<input hidden type='text' id='hrg' name='hrg' value=".$json['Harga']." readonly />";
		echo "</br>";
		echo "<h4>Saldo GoPay Anda : Rp. $sldgopay</h4>";
		echo "</br>";
		echo "<h4>Saldo PayLater Anda : Rp. $sldpayltr</h4>";
		echo "<input hidden type='text' id='sldgopay' name='sldgopay' value=".$sldgopay." readonly />";
		echo "<input hidden type='text' id='sldpayltr' name='sldpayltr' value=".$sldpayltr." readonly />";
		echo "<h4>Pilih Metode Pembayaran </h4><select id='mtdbyr' name='mtdbyr' class='custom-select mr-sm-2' onchange='pilih_mtdbyr()'>
				  <option selected>Pilih Metode Bayar yang Anda inginkan</option>
				  <option value='GoPay'>GoPay</option>
				  <option value='PayLater'>PayLater</option>
				</select>";
		echo "</br></br>";
		echo "<h2><input hidden type='text' readonly class='form-control-plaintext' id='hsl' name='hsl' value=''></h2>";
		echo "<h2 id='hsl2'></h2>";
		echo "</br></br>";
		echo "</td>"; 
		}
		endforeach;
		echo "</div>";
	?>
	
  </center>
  </br>
</body>
<script type="text/javascript">
    function pilih_mtdbyr(){
        var harga = $("#hrg").val();
		var idgpls = $("#ID_GoPulsa").val();
		var idakun = $("#idakun").val();
		var nohp = $("#nohp").val();
		var jns = $("#jns").val();
		var saldogopay = $("#sldgopay").val();
		var saldopaylater = $("#sldpayltr").val();
		var nominal = $("#nominal").val();
		var hrg = Number(harga);
		var sldgpy = Number(saldogopay);
		var sldpyltr = Number(saldopaylater);
		var mtdbyr = $("#mtdbyr").val();
		if(document.getElementById('mtdbyr').value == 'GoPay') {
			if(sldgpy >= hrg){
				document.getElementById("hsl").value = 'Saldo mencukupi';
				window.location.href = "cek_saldo.php?harga=" + harga + "&sldgpy=" + saldogopay + "&idgpls=" + idgpls + "&idakun=" + idakun + "&nohp=" + nohp + "&mtdbyr=" + mtdbyr + "&nominal=" + nominal + "&jns=" + jns;
			}else{
				document.getElementById("hsl").value = 'Saldo tidak mencukupi, silakan isi saldo terlebih dahulu';
				window.alert("Saldo tidak mencukupi, silakan isi saldo terlebih dahulu");
			}
		}else if(document.getElementById('mtdbyr').value == 'PayLater'){
			if(sldpyltr < hrg){
				document.getElementById("hsl").value = 'Saldo tidak mencukupi, silakan isi saldo terlebih dahulu';
				window.alert("Saldo tidak mencukupi, silakan isi saldo terlebih dahulu");
			}else{
				document.getElementById("hsl").value = 'Saldo mencukupi';
				window.location.href = "cek_saldo.php?harga=" + harga + "&sldpyltr=" + sldpyltr + "&idgpls=" + idgpls + "&idakun=" + idakun + "&nohp=" + nohp + "&mtdbyr=" + mtdbyr + "&nominal=" + nominal + "&jns=" + jns;
			}
		}else{
			window.alert("Anda Belum Memilih Metode Pembayaran");
			document.getElementById("hsl").value = 'Silakan pilih metode pembayaran';
		}
	}

</script>
</html>