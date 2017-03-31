$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({html: true}); 

	if ($(window).width() >= 1000) {
		$('header#main_header .top_header #primary_navigation > ul').css('display', 'block');
	} else {
		$('header#main_header .top_header #primary_navigation > ul').css('display', 'none');
	}
	
	$(window).resize(function () {
		var win = $(this);

		$('.c-hamburger').removeClass('is-active');
		$('header#main_header .top_header #primary_navigation').removeClass('menu-on');
		$('header#main_header .top_header #primary_navigation > ul').removeClass('menu-toggle-on');
		
		if (win.width() >= 1000){
			$('header#main_header .top_header #primary_navigation > ul').css('display', 'block');
			$("header#main_header .top_header .column-nav").height($('header#main_header .top_header .column-logo').height());
		}else{
			$('header#main_header .top_header #primary_navigation > ul').css('display', 'none');
			$("header#main_header .top_header .column-nav").height('0px');
		}
	});
	
	$('.lazy-image').lazy();
	
	$(function () {
		var resizeTimer;
		updateDivHeight();
		setTimeout(updateDivHeight, 1250);
		$(window).on('resize', function(e) {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function() {updateDivHeight();}, 250);
		});
		
		function updateDivHeight() {
			$("#main_content.frontpage .section.news_articles #news_list .news_item .news_content").css('height', 'auto');
			
			var maxHeight = 0;

			$("#main_content.frontpage .section.news_articles #news_list .news_item .news_content").each(function(){
			   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
			});

			$("#main_content.frontpage .section.news_articles #news_list .news_item .news_content").height(maxHeight);
			
			$("#main_content.news-page .inner_content .article .news_item .news_content").css('height', 'auto');

			var maxHeight2 = 0;

			$("#main_content.news-page .inner_content .article .news_item .news_content").each(function(){
			   if ($(this).height() > maxHeight2) { maxHeight2 = $(this).height(); }
			});

			$("#main_content.news-page .inner_content .article .news_item .news_content").height(maxHeight2);

			$("#main_content.single-page .inner_content .article .personnel").css('height', 'auto');

			var maxHeight3 = 0;

			$("#main_content.single-page .inner_content .article .personnel").each(function(){
			   if ($(this).height() > maxHeight3) { maxHeight3 = $(this).height(); }
			});

			$("#main_content.single-page .inner_content .article .personnel").height(maxHeight3);
			
			$("#main_content.publication-page .inner_content .article .publication_item .publication_content").css('height', 'auto');

			var maxHeight4 = 0;

			$("#main_content.publication-page .inner_content .article .publication_item .publication_content").each(function(){
			   if ($(this).height() > maxHeight4) { maxHeight4 = $(this).height(); }
			});

			$("#main_content.publication-page .inner_content .article .publication_item .publication_content").height(maxHeight4);
			
			$("#main_content.press_release-page .inner_content .article .press_release_item .press_release_content").css('height', 'auto');

			var maxHeight4 = 0;

			$("#main_content.press_release-page .inner_content .article .press_release_item .press_release_content").each(function(){
			   if ($(this).height() > maxHeight4) { maxHeight4 = $(this).height(); }
			});

			$("#main_content.press_release-page .inner_content .article .press_release_item .press_release_content").height(maxHeight4);
		}
	});

	$(window).scroll(function(){
		var offset = 800,
		//footerHeight = $('footer').height() + 80,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1000;
		//grab the "back to top" link
		$back_to_top = $('.back_to_top-button');
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('button_visible') : $back_to_top.removeClass('button_visible fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('fade-out');
		}
	});

	$('a.smooth-scroll[href^="#"]').on('click',function (e) {
		e.preventDefault();
		var target = this.hash;
		var $target = $(target);
		if(target == '#accordion') {
		// do nothing
		} else if(target.length == 0) {
			$('html,body').animate({
			scrollTop: 0
			}, 1200);
		} else {
			$('html, body').stop().animate({
			'scrollTop': $target.offset().top - 150
			}, 1200, 'swing');
		}
	});
	if ($(window).width() >= 1000) {
		$("header#main_header .top_header .column-nav").height($('header#main_header .top_header .column-logo').height());
	} else {
		$("header#main_header .top_header .column-nav").height('0px');
	}
	
	$('.owl-carousel#hero-owl-carousel').owlCarousel({loop:true,margin:0,nav:true,autoplay:true,autoplayTimeout:8000,autoplayHoverPause:true,animateOut: 'fadeOut',animateIn: 'fadeIn',responsive:{0:{items:1},600:{items:1},1000:{items:1}}});
});

function init() {
	window.addEventListener('scroll', function(e){
		var distanceY = window.pageYOffset || document.documentElement.scrollTop,
		shrinkOn = 600,
		header = document.querySelector("header#main_header");
		if ($(window).width() >= 1000) {
			if (distanceY > shrinkOn) {
				classie.add(header,"scrolled");
				$("header#main_header .top_header .column-nav").height('auto');
				$("#main_content").css('padding-top', $("header#main_header").height() + 'px');
			} else {
				if (classie.has(header,"scrolled")) {
					classie.remove(header,"scrolled");
					$("header#main_header .top_header .column-nav").height($('header#main_header .top_header .column-logo').height());
					$("#main_content").css('padding-top', '0');
				}
			}
		}
	});
}
window.onload = init();

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1);
		if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	}
	return "";
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}

(function() {
	"use strict";
	var toggles = document.querySelectorAll(".c-hamburger");
	for (var i = toggles.length - 1; i >= 0; i--) {
		var toggle = toggles[i];
		toggleHandler(toggle);
	};
	function toggleHandler(toggle) {
		toggle.addEventListener( "click", function(e) {
			e.preventDefault();
			if (this.classList.contains("is-active") === true) {
				this.classList.remove("is-active");
				$('header#main_header .top_header .column-nav').css('display', 'none');
				$('header#main_header .top_header .column-nav #primary_navigation ul.primary-menu').slideUp('fast');
				$('header#main_header .top_header .column-nav #primary_navigation ul.primary-menu').removeClass('menu-toggle-on');
				$('header#main_header .top_header .column-nav #primary_navigation').removeClass('menu-on');
			} else{
				this.classList.add("is-active");
				$('header#main_header .top_header .column-nav').css('display', 'block');
				$('header#main_header .top_header .column-nav #primary_navigation').addClass('menu-on');
				$('header#main_header .top_header .column-nav #primary_navigation ul.primary-menu').addClass('menu-toggle-on');
				$('header#main_header .top_header .column-nav #primary_navigation ul.primary-menu').slideDown('medium');
			}
			
		});
	}
})();