<?php
	require_once "../lib/start.php";
	require_once "top.php";
	if(isAdmin()) { $orders = getOrders(); 
		if(isset($request["func"]) && $request["func"] == "edit") $fd = getOrder($request["id"]);
		else $fd = $request; ?>

<section class="order-parameters">
				<h2 class="order-parameters__title">
					<?php if (isset($fd["date_order"])) { ?>Редактирование <?php } else { ?>Добавление <?php } ?> заказа
				</h2>
				<div class="order-parameters__wrapper">
					<form class="order-parameters__form form" action="orders.php<?php if (isset($fd["date_order"])) { ?>?func=edit&amp;id=<?=$fd["id"]?><?php } ?>" method="post">
						<p class="form__paragraph">
							<label class="form__label">
								Цена:
							</label>
							<input class="form__price" type="text" name="price" 
								value="<?php if(isset($fd["price_start"]) && $fd["price_start"]) { ?><?=$fd["price_start"]?><?php } elseif(isset($fd["price"]) && $fd["price"]) {?><?=$fd["price"]?><?php } ?>" placeholder="Цена">
						</p>
						<p class="form__paragraph">
							<label class="form__label">
								E-mail:
							</label>
							<input class="form__email" type="text" name="email"
								value="<?php if(isset($fd["email"]) && $fd["email"]) { ?><?=$fd["email"]?><?php } ?>" placeholder="E-mail">
						</p>
						<p class="form__paragraph">
							<label class="form__label" for="confirm">
								Подтвержден:
							</label>
								<input id="confirm" class="form__confirm" type="checkbox" name="confirm"
									<?php if(isset($fd["confirm"]) || isset($fd["data_confirm"])) { ?>checked="checked"<?php } ?> >
						</p>
						<p class="form__paragraph">
							<label class="form__label" for="pay">
								Оплачен:
							</label>
								<input id="pay" class="form__pay" type="checkbox" name="pay"
									<?php if(isset($fd["pay"]) || isset($fd["date_pay"])) { ?>checked="checked"<?php } ?> >
						</p>
						<p class="form__paragraph">
							<label class="form__label" for="cancel">
								Аннулирован:
							</label>
								<input id="cancel" class="form__cancel" type="checkbox" name="cancel"
									<?php if(isset($fd["cancel"]) || isset($fd["date_cancel"])) { ?>checked="checked"<?php } ?> >
						</p>
						<p class="form__paragraph form__paragraph--center">
						<input class="form__id" name="id" type="hidden" value="<?php if(isset($fd["id"])) { ?><?=$fd["id"]?><?php } ?>">
						<input class="form__submit" type="submit" name="<?php if (isset($fd["date_order"])) { ?>edit<?php } else { ?>add<?php } ?>" value="<?php if (isset($fd["date_order"])) { ?>Редактировать<?php } else { ?>Добавить<?php } ?>">
					</p>
					</form>
				</div>
		</section>

		<section class="orders-data">
			<h2 class="orders-data__title">
				Заказы
			</h2>
			<?php if ($message) { ?> <p class="message"><?=$message?></p><?php } ?>

			<table class="orders-data__table">
				<tr>
					<td>ID</td>
					<td>Цена, руб.</td>
					<td>Имя</td>
					<td>E-mail</td>
					<td>Тип заказа</td>
					<td>Дата заказа</td>
					<td>Дата подтверждения</td>
					<td>Дата оплаты</td>
					<td>Дата аннулирования</td>
					<td>Кампания</td>
					<td>Функции</td>
				</tr>
				<?php foreach ($orders as $order) { ?>
				<tr>
					<td><?=$order["order_id"]?></td>
					<td><?=$order["price_start"]?></td>
					<td><?=$order["name"]?></td>
					<td><?=$order["email"]?></td>
					<td><?=$order["type"]?></td>
					<td><?=$order["date_order"]?></td>
					<td><?=$order["data_confirm"]?></td>
					<td><?=$order["date_pay"]?></td>
					<td><?=$order["date_cancel"]?></td>
					<td>
						<p>UTM Source: <?=$order["utm_source"]?></p>
						<p>UTM Campaign: <?=$order["utm_campaign"]?></p>
						<p>UTM Content: <?=$order["utm_content"]?></p>
						<p>UTM Term: <?=$order["utm_term"]?></p>
						<p>Split: <?=$order["split"]?></p>
					</td>
					<td>
						<a href="/admin/orders.php?func=edit&amp;id=<?=$order["order_id"]?>">Редактировать</a>
						<br>
						<a href="/admin/orders.php?func=delete&amp;id=<?=$order["order_id"]?>">Удалить</a>
					</td>
				</tr>
				<?php } ?>
			</table>
		</section>
		<?php  } else require_once "auth.php";	?>
<?php
	require_once "footer.php";
?>