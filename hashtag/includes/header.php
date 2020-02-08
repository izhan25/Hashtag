<?php
getCategories();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Hashtag</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="<?php url('assets/img/favicon.ico') ?>" rel="shortcut icon" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php url('assets/css/bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?php url('assets/css/font-awesome.min.css') ?>" />
	<link rel="stylesheet" href="<?php url('assets/css/flaticon.css') ?>" />
	<link rel="stylesheet" href="<?php url('assets/css/slicknav.min.css') ?>" />
	<link rel="stylesheet" href="<?php url('assets/css/jquery-ui.min.css') ?>" />
	<link rel="stylesheet" href="<?php url('assets/css/owl.carousel.min.css') ?>" />
	<link rel="stylesheet" href="<?php url('assets/css/animate.css') ?>" />
	<link rel="stylesheet" href="<?php url('assets/css/style.css') ?>" />


</head>

<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="<?php url('index.php') ?>" class="site-logo">
							<h2 style="font-family: 'Satisfy', cursive;">
								Hash<span style="color: #f51167;">Tag</span>
							</h2>
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form method="post" action="<?php url('products.php') ?>" class="header-search-form">
							<input name="query" type="text" placeholder="Search on HashTag ....">
							<button>
								<input type="submit" name="searchBtn" value="Search" style="cursor: pointer">
							</button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">
								<i class="flaticon-profile"></i>

								<?php if (userLoggedIn()) : ?>
									<span class="main-menu">
										<li style="width: 150px;">
											<a href="#">
												<?php echo $_SESSION['user']['email']; ?>
											</a>
											<ul class="sub-menu">
												<li><a href="<?php url('logout.php'); ?>">Logout</a></li>
											</ul>
										</li>
									</span>
								<?php else : ?>
									<a href="<?php url('login.php') ?>">Sign</a> In or <a href="<?php url('signup.php') ?>">Create Account</a>
								<?php endif ?>

							</div>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span>
										<?php

										echo isset($_SESSION['cart']) ? sizeof($_SESSION['cart']) : 0;

										?>

									</span>
								</div>
								<a href="<?php url('cart.php') ?>">Shopping Cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="<?php url('index.php') ?>">Home</a></li>

					<?php foreach ($categories as $category) : ?>
						<li>
							<a href="<?php url('products.php') ?>" class="text-capitalize">
								<?php echo $category['parent']['name']; ?>
							</a>
							<ul class="sub-menu">
								<?php foreach ($category['sub_cats'] as $sub_cat) : ?>
									<li>
										<a href="<?php url('products.php?cat=' . $category['parent']['id']) ?>" class="text-capitalize">
											<?php echo $sub_cat['name'] ?>
										</a>
									</li>
								<?php endforeach ?>
							</ul>
						</li>
					<?php endforeach ?>

					<li><a href="<?php url('about.php') ?>">About</a></li>
					<li><a href="<?php url('contact.php') ?>">Contact</a></li>


				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->