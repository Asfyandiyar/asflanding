<?php
	require_once "../lib/start.php";
	require_once "top.php";
	if (isAdmin()) { ?>
	<h2 class="orders-data__title">
		Общая статистика
	</h2>
	<?php require_once "data.php"; ?>
<?php
	} else require_once "auth.php";
	require_once "footer.php";
?>