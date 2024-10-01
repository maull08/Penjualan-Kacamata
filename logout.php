<?php 
	session_start();


	// menghancurkan $_SESSION['pelanggan']
	session_destroy();

	echo "<script>alert('anda telah logout')</script>";
	echo "<script>location='index.php';</script>";

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
</head>
<body>
	<!--Navbar-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php"><img class="logo" src="logo.png" style="height: 40px; width: 80px"></a>
		 	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
			</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
			    <li class="nav-item dropdown">
			    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
			    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			        <a class="dropdown-item" href="#">PC</a>
			        <a class="dropdown-item" href="#">LAPTOP</a>
			        <div class="dropdown-divider"></div>
			        <a class="dropdown-item" href="#">CPU</a>
			    </div>
			    </li>
				    <form class="form-inline my-2 my-lg-0">
				    	<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				    	<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				    </form>
				    <li class="nav-item active">
				    	<a class="nav-link" href="keranjang.php">Keranjang</a>
				    </li>
				    <li class="nav-item active">
				    	<a class="nav-link" href="#">Riwayat Belanja</a>
				    </li>
				    <li class="nav-item active">
			      		<a class="nav-link" href="checkout.php">Checkout</a>
				    </li>
				<!-- Jika sudah login ada session pelanggan-->
				<?php if (isset($_SESSION['pelanggan'])): ?>
				    <li class="nav-item">
				        <a class="nav-link" href="logout.php" tabindex="-1" aria-disabled="true">Logout</a>
				    </li>
				<!-- Selain itu (belom login || belom ada session pelanggan) -->
				<?php else: ?>
				    <li class="nav-item">
				        <a class="nav-link" href="login.php" tabindex="-1" aria-disabled="true">Login</a>
				    </li>				    	
				<?php endif ?>				    
				    
			</ul>
		</div>
	</nav>

</body>
</html>