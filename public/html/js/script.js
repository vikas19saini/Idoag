$(function(){

	
	$('.banner_contslider, .worldofidoagslider').bxSlider({
		adaptiveHeight: true,
		controls: false
	});
	
	$(".haveanaccount_txt .haveanaccount_head .haveanaccount_btn").click(function(){
		$(".haveanaccount_txt .dropdown-menu").slideToggle();	
	});
	
	
	/*$('.modulesslider').bxSlider({
		adaptiveHeight: true,
		auto: false,
		infiniteLoop: false,
		hideControlOnEnd: true,
		pager: false
	});*/
	
	$(window).scroll(function(){
		if($(window).scrollTop()>=100){
		$("header").addClass("fixed");	
		}
		else { 
		$("header").removeClass("fixed");
		}
	});
	

$(document).on("click", ".more_txt a", function(){
       $(this).parents(".submenu_listscroll").find(".scroll-child").stop().animate({scrollTop: '+=30'});
   });
});