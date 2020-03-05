// JavaScript Document
$('.treeview-menu').each(function()
{
	var list = $(this).find('li');
	
	if($(list).attr('class') == 'active')
	{
		$(this).css('display', 'block');	
	}
	
});

// Ajax Loading
$(document).ajaxSend(function() {
    $(".loading-container").addClass("start-loading");
});

$(document).ajaxStop(function() {
    $(".loading-container").removeClass("start-loading");
});

// Autosearch
function selectDate(val, type){
	$.ajax({
    url: 'search-date',
    type: 'get',
    data: {'college_id' : val, 'type' : type},
    success: function( data ){
		$("#date_id").html(data);
    }
	});
}

function selectFile(val){
	var college_id = $("#college_institution_id").val();
	$.ajax({
    url: 'search-file',
    type: 'get',
    data: {'date' : val, 'college_id' : college_id},
    success: function( data ){
		$("#file_id").html(data);
    }
	});
}

function searchResendFile(val){
	var college_id = $("#college_institution_id").val();
	$.ajax({
    url: 'search-file-resend',
    type: 'get',
    data: {'date' : val, 'college_id' : college_id},
    success: function( data ){
		$("#file_id").html(data);
    }
	});
}