<?php
$aktif = array("", "", "", "");
// var_dump($_SESSION['data']);
if (isset($data['aktif'])) {
	$aktif[$data['aktif']] = "btn btn-info";
}

// Contoh nama lengkap
$namaLengkap = $_SESSION['pengguna']['name'];
// var_dump($namaLengkap);

// Mengambil inisial dari nama
$namaArray = explode(" ", $namaLengkap);

// Kondisi jika hanya satu kata
if (count($namaArray) == 1) {
    $inisial = strtoupper($namaArray[0][0]);
}
// Kondisi jika ada dua kata
elseif (count($namaArray) == 2) {
    $inisial = strtoupper($namaArray[0][0] . $namaArray[1][0]);
}
// Kondisi jika lebih dari dua kata
else {
    $inisial = strtoupper($namaArray[0][0] . $namaArray[1][0]);
}

// echo $inisial;// Inisial dari nama depan dan belakang
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

	<!-- Custom Feminine CSS -->
	<style>
		/* Navbar styling */
		.navbar {
			background-color: #f8d7da;
			/* Soft pink background */
			border-bottom: 2px solid #e2b2b2;
			/* Soft pink border at the bottom */
		}

		.navbar-brand {
			font-size: 1.7rem;
			/* Slightly larger font for the brand */
			font-weight: bold;
			color: #6f42c1;
			/* Soft purple for the brand text */
		}

		.navbar-brand:hover {
			color: #c36bff;
			/* Purple hover effect */
		}

		.navbar-nav .nav-item .nav-link {
			font-size: 1.1rem;
			/* Adjusted font size */
			color: #6f42c1 !important;
			/* Soft purple color */
			padding: 0.75rem 1.25rem;
			/* Larger padding for a softer look */
		}

		.navbar-nav .nav-item .nav-link:hover {
			background-color: #f1e6f9;
			/* Light purple background on hover */
			color: #6f42c1 !important;
			/* Keeping purple color on hover */
			border-radius: 15px;
			/* Soft rounded corners */
		}

		/* Active link styling */
		.navbar-nav .nav-item .nav-link.active {
			background-color: #f1e6f9 !important;
			/* Light purple background for active link */
			border-radius: 15px;
			/* Rounded corners */
			color: #6f42c1 !important;
			/* Soft purple color for active link */
		}

		/* Navbar toggler styling for mobile */
		.navbar-toggler {
			border-color: #6f42c1;
			/* Soft purple border for toggler */
		}

		.navbar-toggler-icon {
			background-color: #6f42c1;
			/* Soft purple toggler icon */
		}

		/* Custom padding for the navbar */
		.navbar {
			padding: 1rem 2rem;
		}
	</style>

</head>

<body class="vh-100">
	<div class="container">
		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid d-flex">
				<a class="navbar-brand" href="<?= BASEURL; ?>/Profile">
					<div class="avatar rounded-circle d-inline-flex align-items-center justify-content-center"
						style="width: 40px; height: 40px; background-color: #6f42c1; color: white; font-weight: bold;">
						<?= $inisial; ?>
					</div>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link <?= $aktif[0]; ?>" href="<?= BASEURL; ?>/Home">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $aktif[1]; ?>" href="<?= BASEURL; ?>/Produk">Produk</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $aktif[2]; ?>" href="<?= BASEURL; ?>/Transaksi">Transaksi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $aktif[3]; ?>" href="<?= BASEURL; ?>/Toko">Toko</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>