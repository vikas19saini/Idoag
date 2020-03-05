$(document).ready(function() {
   $('.institution_reply').hide();
    $('#notesform').submit(function () {

        event.preventDefault();

        var message = $('#notes').val();

        var user_id = $('#userid').val();

        var institution_id     =$('#institutionid').val();

var data = "&user_id="+user_id+"&message="+message+"&institution_id="+institution_id;

 $.ajax(
    {
        url : '/postInstNotes',
        type: 'POST',
        data : data,
        success: function(response)
        {
            if(response)
            {
              if($('#notes').val()) 
              {
                    $('#notes').val('');
                }
                $('.note_message').show();
              $('.note_message span').html('');
              $('.note_message span').html('Your note has been sent to the Institution!');
        
            }
        }
    });

    });

    $(".note_message .close").click(function(){
      $(this).parent(".note_message").hide();
});

$('.reply_message').on('click',function() {

    var id = $(this).attr('id');
      $("#notes").focus();      
    $('#'+id).hide();
    $('.form_'+id).show();

})

$('.cancel_message').on('click',function() {

    var id = $(this).attr('id');

    $('#'+id).show();
    $('.form_'+id).hide();

})

    $('.submit_reply_button').on('click',function(event) {
    //$('#notesreplyform').submit(function(e) {

    event.preventDefault();

 var id = $(this).attr('id');
      
      var replymessage = $('#notes').val();

      var note_id      = event.target.id;//$('#note_id').val();

    var institution_id     =$('#institutionid').val();

var data         = "&replymessage="+replymessage+"&institution_id="+institution_id+"&note_id="+note_id;

$.ajax(
    {
        url : '/postInstNotes',
        type: 'POST',
        data : data,
        success: function(response)
        {
            if(response)
            {
                $('.note_'+response).hide();
  $('.note_message').show();
            $('.note_message span').html('');
            $('.note_message span').html('Your note has been sent to the User!');    
    }
        }
    });
});



});