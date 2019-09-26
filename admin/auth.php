
<section class="auth">
			<h2 class="auth__title">
				Вход в Admin-панель
			</h2>
			
			<div class="order-parameters__wrapper auth__wrapper">

			<form class="auth__form form" action="index.php" method="post">
				<?php if($message) { ?><p class="message"><?=$message?></p><?php } ?> 
						<p class="form__paragraph">
							<label>
								Логин:
							</label>
							<input class="form__login" type="text" name="login" placeholder="Введите логин">
						</p>
						<p class="form__paragraph">
							<label>
								Пароль:
							</label>
							<input class="form__password" type="password" name="password" placeholder="Введите пароль">
						</p>
						<button name="auth" class="form__submit button" type="submit">Войти</button>
			</form>
		</div>
		</section>