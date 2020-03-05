$(function(){
	
	var wh=$(document).innerHeight();
$(".helpboxpopup").height(wh);

$(".nextmsg1").click(function(){
		$(this).hide()
		$(".nextmsg2").toggle();
	});
	
$(".nextmsg2").click(function(){ 
	$(this).hide()
	$(".nextmsg3").toggle();
});

$(".nextmsg3").click(function(){ 
	$(this).hide()
	$(".nextmsg4").toggle();
});

$(".nextmsg4").click(function(){ 
	$(this).hide()
	$(".nextmsg5").toggle();
});

$(".nextmsg5").click(function(){ 
	$(this).hide()
	$("span.more_cnt").toggle();
});
	
	
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
		$(".helpboxpopup .nextmsg").addClass("nextmsgfixed");	
		}
		else { 
		$("header").removeClass("fixed");
		$(".helpboxpopup .nextmsg").removeClass("nextmsgfixed");
		}
	});
	

});