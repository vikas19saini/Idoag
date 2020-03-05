$(function(){	

	$(document).on("click", ".megamenu ul li.title", function(){
		if(!$(this).hasClass("open_submenu")){
			$(".megamenu ul li.title").removeClass("open_submenu");
			$(this).addClass("open_submenu");
			$(".megamenu .submenu_list").hide();
			$(this).next(".submenu_list").slideDown();
		}
		else{
			$(this).removeClass("open_submenu");
			$(this).next(".submenu_list").slideUp();
		}
	});
	$(document).on("click", ".wsmenu .wsmenu-list li .wsmenu-click", function(e){
		e.preventDefault();
		e.stopPropagation();
		if(!$(this).hasClass("open_wsmenu")){
			$(".wsmenu .wsmenu-list li .wsmenu-click").removeClass("open_wsmenu");
			$(".wsmenu .wsmenu-list li .wsmenu-click .wsmenu-arrow").removeClass("wsmenu-rotate");
			$(this).addClass("open_wsmenu");
			$(this).find(".wsmenu-arrow").addClass("wsmenu-rotate");
			$(".wsmenu-list li > .megamenu").hide();
			$(this).parents("li").find(".megamenu").show();
		}
		else{
			$(this).removeClass("open_wsmenu");
			$(this).find(".wsmenu-arrow").removeClass("wsmenu-rotate");
			$(this).parents("li").find(".megamenu").slideUp();
			}
	});
	
	

	$(document).on('click', '.more_dropdown_menu', function(e) {
   		e.stopPropagation();
	});

  $(document).on('click', '#navToggle', function() {
   $("body").toggleClass("fixedbody");
  });
  
   $(document).on('click', '.overlapblackbg', function() {
   $("body").removeClass("fixedbody");
  });


    $(document).on('click', '.statuspost', function() {

        var post_id        = $(this).attr('data_id');

        var data           = "post_id="+post_id;

        $.ajax({
            url: '/changePostStatus',
            type: 'POST',
            data: data,

            success: function(response) {

                if(response.message == 'inactive')
                {
                    $('#post_'+post_id).removeClass("activestatus");
					$('#post_'+post_id).attr('title', 'Inactive');
					$('#post_'+post_id).attr('data-original-title', 'Inactive');					
                    $('#post_'+post_id).addClass("inactivestatus");
                }
                else if(response.message == 'active')
                {
                    $('#post_'+post_id).removeClass("inactivestatus");
                    $('#post_'+post_id).addClass("activestatus");
					$('#post_'+post_id).attr('data-original-title', 'Active');
					$('#post_'+post_id).attr('title', 'Active');

                 }
            }
        });

    });


    $(document).on('click', '.likeicons', function() {

        var post_id        = $(this).attr('id');

        var data           = "post_id="+post_id;

        $.ajax({
            url: '/getLikes',
            type: 'POST',
            data: data,

            success: function(response) {

                if(response.message == 'unlike')
                {   
                    $('#'+post_id).removeClass("fa-heart"); 
                    $('#'+post_id).addClass("fa-heart-o");

                    $('b.id_'+post_id).html(response.count);
                }
                else if(response.message == 'like')
                {  
				 $('#'+post_id).removeClass("fa-heart-o"); 
                    $('#'+post_id).addClass("fa-heart");

                    $('b.id_'+post_id).html(response.count);
                }
            }
        });
    
    });

    $(".haveanaccount_txt .haveanaccount_head .haveanaccount_btn").click(function(e) {
    
        //e.preventDefault();
        e.stopPropagation();
        
        $('.haveanaccount_txt .dropdown-menu').show();
    
    });

    $(".haveanaccount_txt .dropdown-menu").click(function(e) {
        //e.preventDefault();
       e.stopPropagation();
       
    });

    $('body').append('<div id="toTop" class="top-arrow"><i class="fa fa-chevron-up"></i></div>');

    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    
    }); 
    
    $('#toTop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    
    });

    $(document).on("click", ".more_txt a", function(){
           $(this).parents(".submenu_listscroll").find(".scroll-child").stop().animate({scrollTop: '+=42'});
    });

    $('#stepbystep_regi').on('hide.bs.modal', function(e){

     e.preventDefault();
     e.stopImmediatePropagation();
     return false; 

    });

    $(document).on('click', '.brandoffer_follow2', function() {

        var brand_id        = $(this).attr('id');

        var data            = "brand_id="+brand_id;

        $.ajax({
            url: '/userBrandFollows',
            type: 'POST',
            data: data,

            success: function(response) {

                if(response)
                {
                    $('div.id_'+brand_id).html('<a href="javascript:void(0);" class="follow_btn">'+toTitleCase(response.message)+'</a>');
                    $('span.id_'+brand_id).html('+'+response.count);
                    // $('div.id_'+brand_id).parent().addClass('hide');
                }

            }
        });
    });

    
    var slider;

    $(window).load(function(){
        if ($('.suggestedbrands_list ul').length) {
            slider = $('.suggestedbrands_list ul').bxSlider({
                pager: false,
                auto:  true
            });
        }
    });

    $(document).on('click', '.random_follow_brand', function() {

        // console.log(slider.getSlideCount());

        var brand_id        = $(this).attr('id');

        var data            = "brand_id="+brand_id;

        $.ajax({
            url: '/userBrandFollows',
            type: 'POST',
            data: data,

            success: function(response) {

                if(response)
                {
                    $('.suggest_brand_'+brand_id).remove();
                    slider.reloadSlider();
                    if(slider.getSlideCount() == 0)
                    {
                        $('.suggestedbrands_list').html('<p>You are currently following all Brands.</p>');
                    }
                }
            }
        });
    });

    $(document).on('click', '.random_follow_inst', function() {

        var institution_id        = $(this).attr('id');

        var data            = "institution_id="+institution_id;

        $.ajax({
            url: '/userInstitutionFollows',
            type: 'POST',
            data: data,

            success: function(response) {

                if(response)
                {

                    $('.suggest_inst_'+institution_id).remove();
                    slider.reloadSlider();
                    if(slider.getSlideCount() == 0)
                    {
                        $('.suggestedbrands_list').html('<p>You are currently following all Institutions.</p>');
                    }                
                }
            }
        });
    });


    $(document).on('click', '.institution_follow2', function() {

        var institution_id        = $(this).attr('id');

        var data            = "institution_id="+institution_id;

        $.ajax({
            url: '/userInstitutionFollows',
            type: 'POST',
            data: data,

            success: function(response) {

                if(response)
                {
                     $('div.id_'+institution_id).html('<a href="javascript:void(0);" class="follow_btn">'+toTitleCase(response.message)+'</a>');
                    $('span.id_'+institution_id).html('+'+response.count);
                    // $('div.id_'+brand_id).parent().addClass('hide');
                }

            }
        });
    });

    $('.follow_brand').on('click',function(){
                
      var brand_id        = $(this).attr('id');

      var data            = "brand_id="+brand_id;

      $.ajax({
        url: '/userBrandFollows',
        type: 'POST',
        data: data,

        success: function(response) {

            if(response)
            {
                $('.follow_brand').html('<a href="javascript:void(0);">'+response.message+'</a>');
                $('.follow_txtlist').html('+ ' +response.count);
            }
        }
      });

    });

    $('.follow_institution').on('click',function(){

        var institution_id        = $(this).attr('id');

        var data            = "institution_id="+institution_id;

        $.ajax({
            url: '/userInstitutionFollows',
            type: 'POST',
            data: data,

            success: function(response) {

                if(response)
                {
                    $('.follow_institution').html('<a href="javascript:void(0);">'+response.message+'</a>');
                    $('.follow_txtlist').html('+ ' +response.count);
                }
            }
        });

    });

    $(document).on("click", ".error_msg .close, .success_msg .close", function(){ 

        $(this).parents(".error_msg, .success_msg").hide();
    
    });

  $(document).on("click", ".alert .close", function(){ 

        $(this).parents(".alert").hide();
    
    });


    $(document).click(function(){ 

        $(".a2a_menu.a2a_mini").hide();
        $(".addthis_sharing_toolbox").hide();
           
    });

    $(".brandoffer_info .brandoffer_list ul li .brandoffer_img .brandoffer_imgcont .share_like_txt p a.a2a_dd").click(function(e){ 
        e.stopPropagation();
       // $(".a2a_menu.a2a_mini").hide();

    });

    $(document).on('click', "a.share_social", function(e){ 
        e.stopPropagation();
        $(".addthis_sharing_toolbox").hide();
        $(this).parents(".share_like_txt").find(".addthis_sharing_toolbox").show();        
    });

    $(document).on('click', "i.share_social", function(e){ 
        e.stopPropagation();
        $(".addthis_sharing_toolbox").hide();
        $(this).parents(".uicon_latest").find(".addthis_sharing_toolbox").show();        
    });

    $(document).on('click', "a.share_social2", function(e){
        e.stopPropagation();
        $(".addthis_sharing_toolbox").hide();
        $(this).parents(".share_like_txt2").find(".addthis_sharing_toolbox").show();

    });
	
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            $(".error_msg .close, .success_msg .close").parents(".error_msg, .success_msg").hide();
            $(".a2a_menu.a2a_mini").hide();
            } 
    
    });

    $(document).click(function() {
        $('.haveanaccount_txt .dropdown-menu').hide();
    });
	
	/* Brands selection */        
    $(".popup_selectall .checkbox div span.brandactive_img input").click(function(){


		$(this).parent("span.brandactive_img").toggleClass("active");
	});


    /*$(".selectall_btn em input").click(function(){

    	if($(this).is(":checked"))
    	{
    	
    		$(this).parent(".selectall_btn em").addClass("active");
    		
    		}else {
    		
    		$(this).parent(".selectall_btn em").removeClass("active");
    	
    	}

    });*/



      
    
});


function getCity(id)
{
    $(".cities option:gt(0)").remove();
    
    if(id) {

        $.ajax({

            headers: {
                'csrftoken' : '{{ csrf_token() }}'
            },

            type: 'POST',

            url: '/ajax/getCityByStateId',

            data: { 'id':id },

            success: function(data) {

                //console.log(data);

                $('#cityId').html(data);

            }

        });
    }
}

function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt)
                {
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                });
}

function checksize(str)
{
    if(str=="FSW")
    data="1200 x 677";
    else if(str=="M")
    data="1200 x 677";
    else if(str=="S")
    data="1200 x 677";

    $('.displaysize').html("Please Upload a Image of Size :"+data);
}

function getUpload(str)
{
    if(str == 'HomePageMainBanner' || str == 'StudentDashboardSlider')
    {
        $('.mobile_image').removeClass('hide');
    }
    else
    {
        $('.mobile_image').addClass('hide');
    }
}

var el, title, msg, dataForm, dataurl ;

$('.formConfirm_yes_bkup').on('click', function(e) {
    e.preventDefault();
    $('#formConfirm #frm_cancel').trigger("click");
    $('#formConfirm2')
        .find('#frm_body').html('Need Confirm. '+msg)
        .end().find('#frm_title').html(title);

    $('#formConfirm2').find('#frm_submit').attr('data-form', dataForm);


    setTimeout(function(){ $("body").attr("class", "modal-open"); }, 500);


});

$('.formConfirmSingle').on('click', function(e) {
    e.preventDefault();
    el = $(this).parent();
    title = el.attr('data-title');
    msg = el.attr('data-message');
    dataurl = el.attr('data-url');

    $('#formConfirmSingle')
        .find('#frm_body').html(msg)
        .end().find('#frm_title').html(title)
        .end().find('#frm_submit1').attr("href", dataurl)
        .end().modal('show');
});

$('.formConfirm').on('click', function(e) {
    e.preventDefault();
     el = $(this).parent();
     title = el.attr('data-title');
     msg = el.attr('data-message');
     dataForm = el.attr('data-form');

    $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);

    $('#formConfirm')
        .find('#frm_body').html(msg)
        .end().find('#frm_title').html(title)
        .end().modal('show');

});
$('#formConfirm').on('click', '#frm_submit', function(e) {
    var id = $(this).attr('data-form');
    $(id).submit();
});


$('.adminformConfirm').on('click', function(e) {
    e.preventDefault();
    el = $(this).parent();
    title = el.attr('data-title');
    msg = el.attr('data-message');
    dataForm = el.attr('data-form');
    dataurl = el.attr('data-url');

    $('#adminformConfirm')
        .find('#frm_body').html(msg)
        .end().find('#frm_title').html(title)
        .end().find('.adminformConfirm_yes').attr("data-url", dataurl)
        .end().modal('show');

});
$(document).on('click', '.adminformConfirm_yes', function(e) {
    e.preventDefault();
    el = $(this);
    dataurl = el.attr('data-url');

    $('#adminformConfirm2')
        .find('#frm_body').html(msg)
        .end().find('#frm_title').html(title)
        .end().find('#adminfrm_submit').attr("href", dataurl)
        .end().modal('show');

    $("#frm_cancel").trigger("click");
});



$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
    input.parents(".input-group-btn").next("input").val(label);


});



 
/*$(window).load(function(){
	
	$('.photowidget_list .photowidget_slider').bxSlider({
		auto: true,
		infiniteLoop: true,
		controls: false,
		pager:false
	});

});*/
