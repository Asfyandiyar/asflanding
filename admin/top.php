<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Admin-панель.">
		<meta name="keywords" content="admin-панель, управление сайтом, управление лендингом.">
		<title>Admin-панель</title>
		<link rel="stylesheet" href="styles/admin.css">
	</head>
	<!--top.php-->
	<body>
		<h1 class="visually-hidden">Admin-панель</h1>
		<?php if(isAdmin()) { ?>
		<header class="admin-header">
			<nav class="admin-header__nav">
				<ul class="admin-header__list logout-list">
					<li class="logout-list__item">
						<a class="logout-list__link" href="/admin?logout=1">Выход</a>
					</li>
				</ul>
				<ul class="admin-header__list admin-list">
					<li class="admin-list__item">
						<a class="admin-list__link" href="/admin">Главная</a>
					</li>
					<li class="admin-list__item">
						<a class="admin-list__link" href="/admin/orders.php">Заказы</a>
					</li>
					<li class="admin-list__item">
						<a class="admin-list__link" href="/admin/statistics.php">Статистика</a>
					</li>
				</ul>
			</nav>
		</header>
		<?php } ?>
