<?php
$aktif = array("", "", "", "");
// var_dump($_SESSION['data']);
if (isset($data['aktif'])) {
	$aktif[$data['aktif']] = "btn btn-info";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $data['judul']; ?></title>

	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="120x120" href="<?= BASEURL ?>/img/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= BASEURL ?>/img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= BASEURL ?>/img/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?= BASEURL ?>/img/favicon/site.webmanifest">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/091b217840.js" crossorigin="anonymous"></script>
</head>

<body class="vh-100">
	<div class="container">
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
			<div class="container-fluid d-flex">
				<a class="navbar-brand" href="<?= BASEURL; ?>/Profile"><?= $_SESSION['user']['name'] ?></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link active <?= $aktif[0]; ?>" aria-current="page" href="<?= BASEURL; ?>/Home">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active <?= $aktif[1]; ?>" aria-current="page" href="<?= BASEURL; ?>/Produk">Produk</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active <?= $aktif[2]; ?>" aria-current="page"
								href="<?= BASEURL; ?>/Transaksi">Transaksi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active <?= $aktif[3]; ?>" aria-current="page" href="<?= BASEURL; ?>/Toko">Toko</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>