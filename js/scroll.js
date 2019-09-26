{
	$(document).ready(function() {
		const COEFFICIENT = 425;
		const NAVIGATION_LIST_BACKGROUNDS = ["transparent", "rgba(1, 1, 1, 0.3)"];
		const ACTIVE_ITEM_CLASS = "site-list__item--active";
		const NAVIGATION_LIST_CLASS = "site-list__extra";
		const NAVIGATION_SCROLL_CLASS = "site-list__extra-scroll";
		const pageHeader = $(".page-header"); 
		const portfolioOpenLink = $(".portfolio__bg-link");
		const navigationMenu = $(".main-nav");
		const navigationMenuItem = $(".site-list__item");
		const navigationMenuLink = $(".site-list__link");
		const navigationList = $(".site-list");

		portfolioOpenLink.fancybox({
			minWidth: 900
		});

		navigationMenuLink.on("click", function() {
			$("html, body").stop().animate({
					scrollTop: $($(this).attr("href")).offset().top - navigationMenu.innerHeight()
			}, 100);
			navigationMenuItem.removeClass(ACTIVE_ITEM_CLASS);
			$(this).parent().addClass(ACTIVE_ITEM_CLASS);
		});

		function onScroll(){
			const scroll_top = $(document).scrollTop();
			if(scroll_top > pageHeader.innerHeight()) {
				navigationList.css("background-color", NAVIGATION_LIST_BACKGROUNDS[1]);
				navigationMenuLink.removeClass(NAVIGATION_LIST_CLASS);
				navigationMenuLink.addClass(NAVIGATION_SCROLL_CLASS);
			} else {
				navigationList.css("background-color", NAVIGATION_LIST_BACKGROUNDS[0]);
				navigationMenuLink.removeClass(NAVIGATION_SCROLL_CLASS);
				navigationMenuLink.addClass(NAVIGATION_LIST_CLASS);
			}
			$(navigationMenuLink).each(function(){
				if(scroll_top >= $($(this).attr("href")).offset().top - navigationMenu.innerHeight() - COEFFICIENT) {
					navigationMenuItem.removeClass(ACTIVE_ITEM_CLASS);
					$(this).parent().addClass(ACTIVE_ITEM_CLASS);
				}
			});
		}

		$(document).on("scroll", onScroll);
	});
}