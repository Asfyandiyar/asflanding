{
	const orderLinks = document.querySelectorAll(`.order__link`);
	const tariffList = document.querySelector(`.tariff__list`);
	const tariffButtons = document.querySelectorAll(".tariff__button");

	const modalWrapper = document.querySelector(".modal-bg");
	const modals = document.querySelectorAll(".modal");
	const popup = document.querySelector(".order-modal");
	const thanksPopup = document.querySelector(".thanks-modal");
	const closeButtons = document.querySelectorAll(".modal__close");

	const forms = document.querySelectorAll(".form");

	orderLinks.forEach((item) => {
		item.addEventListener("click", function(evt) {
			evt.preventDefault();
			popup.classList.add("modal__show");
			modalWrapper.classList.add("modal__show");
		});
	});

	closeButtons.forEach((item, index, array) => {
		item.addEventListener("click", function(evt) {
			evt.preventDefault();
			modals[index].classList.remove("modal__show");
			modalWrapper.classList.remove("modal__show");
			modals[index].classList.remove("modal__error");
		});
	});

	forms.forEach((item, index, array) => {
		item.addEventListener("submit", function(evt) {
			if(!login.value || !email.value) {
				evt.preventDefault();
				modals[0].classList.remove("modal__error");
				modals[0].offsetWidth = popup.offsetWidth;
				modals[0].classList.add("modal__error");
			} else {
				evt.preventDefault();
				localStorage.setItem("name", login.value);
				modals[0].classList.remove("modal__show");
				modalWrapper.classList.remove("modal__show");
				modals[0].classList.remove("modal__error");
						
				modals[1].classList.add("modal__show");
			}
		});
	});

	window.addEventListener("keydown", function(evt) {
		if(evt.keyCode === 27) {
			if(modals[0].classList.contains("modal__show")) {
				modals[0].classList.remove("modal__show");
				modalWrapper.classList.remove("modal__show");
				modals[0].classList.remove("modal__error");
			} else if(modals[1].classList.contains("modal__show")) {
						modals[1].classList.remove("modal__show");
			}
		}
	});

}