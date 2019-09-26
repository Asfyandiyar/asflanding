<?php 
	$request = xss($_REQUEST);

	if(isset($request["message"])) $message = $request["message"];

	if(isset($_POST["order"])) { 
		$data = array();
		$data["email"] = $request["email"];
		$data["name"] = $request["firstname"];
		$data["type"] = "Landing";
		if($request["order"] == "start") {
			if(isset($_SESSION["split2"]) && ($_SESSION["split2"] == "low" || $_SESSION["split2"] == "default"))
			$data["price_start"] = 9990;
			else
			$data["price_start"] = 14990;
		}
		if($request["order"] == "stand") {
			if(isset($_SESSION["split2"]) && ($_SESSION["split2"] == "low" || $_SESSION["split2"] == "default"))
			$data["price_start"] = 14990;
			else
			$data["price_start"] = 29990;
		}
		if($request["order"] == "busin") {
			if(isset($_SESSION["split2"]) && $_SESSION["split2"] == "low")
			$data["price_start"] = 19990;
			elseif(isset($_SESSION["split2"]) && $_SESSION["split2"] == "high") {
				$data["price_start"] = 39990;
			}
			else 
			$data["price_start"] = 24990;
		}
		if($request["order"] == "vip") {
			if(isset($_SESSION["split2"]) && $_SESSION["split2"] == "low")
			$data["price_start"] = 29990;
			elseif(isset($_SESSION["split2"]) && $_SESSION["split2"] == "high") {
				$data["price_start"] = 49990;
			}
			else 
			$data["price_start"] = 37990;
		}
		if($request["order"] == "noprice") {
			$data["price_start"] = 0;
		}
		$data["camp_id"] = (isset($_SESSION["camp_id"]) && $_SESSION["camp_id"]) ? $_SESSION["camp_id"] : null;
		//$data["split"] = (isset($_SESSION["split"]) && $_SESSION["split"]) ? $_SESSION["split"] : null;
		if(isset($_SESSION["split"]) && $_SESSION["split"] && isset($_SESSION["split2"]) && $_SESSION["split2"]) {
			$data["split"] = " ".$_SESSION["split"]." ".$_SESSION["split2"];
		} 
		$data["date_order"] = time();
		if(addOrder($data)) {
			sendOrder($request["email"], $request["firstname"]);
			return true;
		}
		else $message = "Произошла ошибка при отправке формы. Повторите попытку или обратитесь к администрации."; 
	}

	if(isset($_POST["order_two"])) {
		$data = array();
		$data["email"] = $request["email"];
		$data["type"] = "Landing";
		$data["camp_id"] = (isset($_SESSION["camp_id"]) && $_SESSION["camp_id"]) ? $_SESSION["camp_id"] : null;
		//$data["split"] = (isset($_SESSION["split"]) && $_SESSION["split"]) ? $_SESSION["split"] : null;
		if(isset($_SESSION["split"]) && $_SESSION["split"] && isset($_SESSION["split2"]) && $_SESSION["split2"]) {
			$data["split"] = " ".$_SESSION["split"]." ".$_SESSION["split2"];
		} 
		$data["date_order"] = time();
		if(addOrder($data)) {
			sendOrder($request["email"]);
			return true;
		}
		else $message = "Произошла ошибка при отправке формы. Повторите попытку или обратитесь к администрации.";
	}

	if(isset($_POST["advice"])) {
		$data = array();
		$data["email"] = $request["email"];
		$data["name"] = $request["firstname"];
		$data["type"] = "Advice";
		$data["date_order"] = time();
		if(addOrder($data)) {
			sendOrder($request["email"], $request["firstname"]);
			return true;
		}
		else $message = "Произошла ошибка при отправке формы. Повторите попытку или обратитесь к администрации.";
	}

	if(isset($_POST["auth"])) {
		if(login($request["login"], $request["password"])) redirect("/admin");
		else $message = "Неверные имя пользователя и/или пароль!";
	}

	if(isAdmin()) {
		$data_st = array();
		if(isset($request["logout"])) {
			logout();
			redirect("/admin");
		}
		elseif (isset($request["add"])) {
			$data = array();
			$data["price_start"] = ($request["price"]) ? $request["price"] : null;
			$data["email"] = $request["email"];
			$data["date_order"] = time();
			if (isset($request["confirm"])) $data["data_confirm"] = time();
			if (isset($request["pay"])) $data["date_pay"] = time();
			if (isset($request["cancel"])) $data["date_cancel"] = time();
			if ($data["email"]) { 
				if(addOrder($data)) { 
					$message = "Заказ успешно добавлен!";
					redirect("/admin/orders.php?message=".urlencode($message));
				}
				else $message = "Ошибка при добавлении заказа!";
			}
			else $message = "Вы не указали E-mail!";
		}
		elseif (isset($request["edit"])) {
			$order = getOrder($request["id"]);
			$data = array();
			$data["price_start"] = ($request["price"]) ? $request["price"] : null;
			$data["email"] = $request["email"];
			if (isset($request["confirm"]) xor $order["data_confirm"]) $data["data_confirm"] = isset($request["confirm"]) ? time() : null;
			if (isset($request["pay"]) xor $order["date_pay"]) $data["date_pay"] = isset($request["pay"]) ? time() : null;
			if (isset($request["cancel"]) xor $order["date_cancel"]) $data["date_cancel"] = isset($request["cancel"]) ? time() : null;
			if ($data["email"]) { 
				if(setOrder($request["id"], $data)) { 
					$message = "Заказ успешно отредактирован!";
					redirect("/admin/orders.php?message=".urlencode($message));
				}
				else $message = "Ошибка при редактировании заказа!";
			}
			else $message = "Вы не указали E-mail!";
		}
		elseif (isset($request["func"]) && $request["func"] == "delete") { 
				if(deleteOrder($request["id"])) { 
					$message = "Заказ успешно удалён!";
					redirect("/admin/orders.php?message=".urlencode($message));
				}
				else $message = "Ошибка при удалении заказа!";
		}
		elseif (isset($request["statistics"])) {
			$data_st["from"] = getTimeStamp($request["from"]);
			$data_st["to"] = getTimeStamp($request["to"]);
			$data_st["utm_source"] = $request["utm_source"];
			$data_st["utm_campaign"] = $request["utm_campaign"];
			$data_st["utm_content"] = $request["utm_content"];
			$data_st["utm_term"] = $request["utm_term"];
			$data_st["split"] = $request["split"];
			$data_st["log"] = $request["log"];
		}
	}
 ?>		