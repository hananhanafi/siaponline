<!doctype html>
<html lang="en">

<head>
	<title>Masuk</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
	<link href="<?= base_url(); ?>/assets/login/style.css" rel="stylesheet">
  	<link href="<?= base_url(); ?>/assets/landingpage/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">MASUK</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex mb-4">
								<div class="w-100 d-flex">
									<a href="<?php echo base_url('app'); ?>" class="form-control btn btn-primary rounded px-3 mr-3" style="width: auto;"><i class="bi bi-arrow-left"></i></a>
									<div>
										<h5 class="mb-0">SIAP</h5>
										<p style="text-align: center;font-size:12px" class="mb-0">Sistem Informasi Aktif Pemilu Tahun 2024</p>
									</div>
								</div>
							</div>
							<form action="<?php echo base_url('Auth/login'); ?>" method="post" class="signin-form">
								<div class="form-group mb-3">
									<label class="label" for="name">Username</label>
									<input type="text" class="form-control" placeholder="Username" name="username" required>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Password</label>
									<input type="password" class="form-control" placeholder="Password" name="password" required>
								</div>
								<div class="form-group">
									<button type="submit" class="form-control btn btn-primary rounded submit px-3">Masuk</button>
								</div>
							</form>
							<!-- <p style="text-align: center;" class="mb-0">Sistem Informasi Aktif Pemilu Tahun 2024</p> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

</html>