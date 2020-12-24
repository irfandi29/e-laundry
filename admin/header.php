<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin - <?= $title; ?> | E-Laundry</title>
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/toast/css/jquery.toast.css" rel="stylesheet">
	<link href="../assets/css/styles.css" rel="stylesheet">
	<link href="../assets/datatables/datatables.min.css" rel="stylesheet">
	
	<!--Custom Font-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <script src="https://kit.fontawesome.com/ac90a6a951.js" crossorigin="anonymous"></script>

</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>E-Laundry</span> Sistem</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="https://placehold.co/400/30a5ff/white?text=Admin&font=lora" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Admin</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span><?= $_SESSION['username']; ?></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li class="<?php if($title=='Dashboard'){ echo 'active'; } ?>"><a href="index.php"><i class="fa fa-dashboard">&nbsp;</i> Dashboard</a></li>
			<li class="<?php if($title=='Outlet'){ echo 'active'; } ?>"><a href="outlet.php"><i class="fa fa-store">&nbsp;</i> Outlet</a></li>
			<li class="<?php if($title=='Paket'){ echo 'active'; } ?>"><a href="paket.php"><i class="fa fa-boxes">&nbsp;</i> Paket</a></li>
			<li class="<?php if($title=='Pengguna'){ echo 'active'; } ?>"><a href="pengguna.php"><i class="fa fa-user-cog">&nbsp;</i> Pengguna</a></li>
			<li class="<?php if($title=='Pelanggan'){ echo 'active'; } ?>"><a href="pelanggan.php"><i class="fa fa-users">&nbsp;</i> Pelanggan</a></li>
			<li class="<?php if($title=='Transaksi'){ echo 'active'; } ?>"><a href="transaksi.php"><i class="fa fa-shopping-cart">&nbsp;</i> Transaksi</a></li>
			<li class="<?php if($title=='Laporan'){ echo 'active';} ?>"><a href="laporan.php"><i class="fa fa-file-alt">&nbsp;</i> Laporan</a></li>
			<li><a href="logout.php"><i class="fa fa-power-off">&nbsp;</i> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->