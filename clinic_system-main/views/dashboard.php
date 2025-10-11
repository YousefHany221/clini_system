<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Clinic Management :: Dashboard</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="../lte-customized-doctors/plugins/fontawesome-free/css/all.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../lte-customized-doctors/css/adminlte.min.css">
		<link rel="stylesheet" href="../lte-customized-doctors/css/custom.css">
	</head>
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<ul class="navbar-nav">
					<li class="nav-item">
					  	<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>					
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
							<img src="../lte-customized-doctors/img/avatar5.png" class='img-circle elevation-2' width="40" height="40" alt="">
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
							<h4 class="h4 mb-0"><strong>Dr. John Doe</strong></h4>
							<div class="mb-3">doctor@example.com</div>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fas fa-user-md mr-2"></i> Profile
							</a>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item text-danger">
								<i class="fas fa-sign-out-alt mr-2"></i> Logout							
							</a>							
						</div>
					</li>
				</ul>
			</nav>
			<!-- Sidebar -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<a href="#" class="brand-link">
					<img src="../lte-customized-doctors/img/AdminLTELogo.png" alt="Clinic Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">Clinic Dashboard</span>
				</a>
				<div class="sidebar">
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-item">
								<a href="dashboard.html" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="appointments.html" class="nav-link">
									<i class="nav-icon fas fa-calendar-check"></i>
									<p>Appointments</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="patients.html" class="nav-link">
									<i class="nav-icon fas fa-user-injured"></i>
									<p>Patients</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="doctors.html" class="nav-link">
									<i class="nav-icon fas fa-user-md"></i>
									<p>Doctors</p>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</aside>
			<div class="content-wrapper">
				<section class="content-header">                    
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Dashboard</h1>
							</div>
						</div>
					</div>
				</section>
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-3 col-6"><div class="small-box card"><div class="inner"><h3>120</h3><p>Patients</p></div><div class="icon"><i class="fas fa-user-injured"></i></div></div></div>
							<div class="col-lg-3 col-6"><div class="small-box card"><div class="inner"><h3>15</h3><p>Doctors</p></div><div class="icon"><i class="fas fa-user-md"></i></div></div></div>
							<div class="col-lg-3 col-6"><div class="small-box card"><div class="inner"><h3>350</h3><p>Appointments</p></div><div class="icon"><i class="fas fa-calendar-check"></i></div></div></div>
							<div class="col-lg-3 col-6"><div class="small-box card"><div class="inner"><h3>$50,000</h3><p>Revenue</p></div><div class="icon"><i class="fas fa-dollar-sign"></i></div></div></div>
						</div>
					</div>
				</section>
			</div>
			<footer class="main-footer">
				<strong>Copyright &copy; 2024 Clinic Management All rights reserved.</strong>
			</footer>
		</div>
		<script src="../lte-customized-doctors/plugins/jquery/jquery.min.js"></script>
		<script src="../lte-customized-doctors/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../lte-customized-doctors/js/adminlte.min.js"></script>
	</body>
</html>
