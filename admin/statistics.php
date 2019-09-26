<?php
	require_once "../lib/start.php";
	require_once "top.php";
	if(isAdmin()) { ?>

<section class="statistics">
			<h2 class="statistics__title">
				Статистика
			</h2>
			<div class="order-parameters__wrapper statistics__wrapper">
					<form class="statistics__form form" action="statistics.php" method="post">
						<p class="form__paragraph">
							<label class="form__label">
								От:
							</label>
							<input class="form__from" type="text" name="from" value="<?php if(isset($request["from"])) { ?><?=$request["from"]?><?php } else { ?><?=date(FORMAT_DATE, time() - 36*86400)?><?php } ?>" >
						</p>
						<p class="form__paragraph">
							<label class="form__label">
								До:
							</label>
							<input class="form__to" type="text" name="to" value="<?php if(isset($request["to"])) { ?><?=$request["to"]?><?php } else { ?><?=date(FORMAT_DATE)?><?php } ?>">
						</p>
						<p class="form__paragraph">
							<label class="form__label">
								UTM-Source:
							</label>
							<input class="form__utm-source" type="text" name="utm_source" value="<?php if(isset($request["utm_source"])) { ?><?=$request["utm_source"]?><?php } ?>" >
						</p>
						<p class="form__paragraph">
							<label class="form__label">
								UTM-Campaign:
							</label>
							<input class="form__utm-campaign" type="text" name="utm_campaign" value="<?php if(isset($request["utm_campaign"])) { ?><?=$request["utm_campaign"]?><?php } ?>">
						</p>
						<p class="form__paragraph">
							<label class="form__label">
								UTM-Content:
							</label>
							<input class="form__utm-content" type="text" name="utm_content" value="<?php if(isset($request["utm_content"])) { ?><?=$request["utm_content"]?><?php } ?>">
						</p>
						<p class="form__paragraph">
							<label class="form__label">
								UTM-Term:
							</label>
							<input class="form__utm-term" type="text" name="utm_term" value="<?php if(isset($request["utm_term"])) { ?><?=$request["utm_term"]?><?php } ?>">
						</p>
						<p class="form__paragraph">
							<label class="form__label">
								Split:
							</label>
							<input class="form__split" type="text" name="split" value="<?php if(isset($request["split"])) { ?><?=$request["split"]?><?php } ?>">
						</p>
						<p class="form__paragraph form__paragraph--other">
							<label class="form__label" for="and">
								И:
							</label>
								<input id="and" class="form__and" type="radio" name="log" value="AND" <?php if(isset($request["log"]) && $request["log"] == "AND") { ?> checked="checked"<?php } ?> >
						</p>
						<p class="form__paragraph form__paragraph--other">
							<label class="form__label" for="or">
								ИЛИ:
							</label>
								<input id="or" class="form__or" type="radio" name="log" value="OR" <?php if(isset($request["log"]) && $request["log"] == "OR") { ?> checked="checked"<?php } ?>>
						</p>
						<p class="form__paragraph form__paragraph--center">
							<input class="form__submit" name="statistics" type="submit" value="Вывести">
						</p>
					</form>
				</div>
		</section> 
<?php		require_once "data.php";
 } else require_once "auth.php"; 

	require_once "footer.php";
?>