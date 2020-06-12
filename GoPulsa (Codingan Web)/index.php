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
    </br>
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

  </ul>
  </br>
  <ul class="nav justify-content-center">
    <li class="nav-item">
       <form action="detail.php" method="post">
       </br>
			<div class="form-row">
			  <div class="col">
				<input type="nomor" class="form-control no_hp" id="no_hp" placeholder="Masukkan No. Handphone" name="no_hp" onkeypress="return isNumberKey(event)" required>				
			 </div>
			</div>
		</form>
    </li>
    </br>
    <li class="nav-item">
    </br>
    <img src="kontak.png" width=35>
    </li>
  </ul>
  </br>
  <center>
	<div id="target"></div>
		<input hidden type="text" id="test" name="abcd" readonly />
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
		<p>
    <div class="card-footer text-muted">
			<table class="table">
			<tbody>
			<h2>Silakan masukkan nomor handphone dahulu pada form di atas</h2>
			<div id='abcd'></div>
			  <tr>
        </div>
		</p>                                                                     
    </div>
    <div id="pkt_dt" class="container tab-pane fade"><br>
     <table class="table">
			<tbody>
    </div>
  </div>
  </form>
</div>
</div>
</body>
</html>