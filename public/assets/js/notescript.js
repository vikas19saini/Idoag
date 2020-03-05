$(document).ready(function() {

    $('.brand_reply').hide();

    $('#notesform').submit(function (e) {

      e.preventDefault();
       
      var message = $('#notes').val();

      var user_id = $('#userid').val();

      var brand_id =$('#brandid').val();

      var data = "&user_id="+user_id+"&message="+message+"&brand_id="+brand_id;

      $.ajax(
      {
          url : '/postNotes',
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
              $('.note_message span').html('Your note has been sent to the Brand!');
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
      
      var replymessage = $('#notes'+id).val();

      var note_id      = event.target.id;//$('#note_id').val();

      var brand_id     = $('#brandid').val();

      var data         = "&replymessage="+replymessage+"&brand_id="+brand_id+"&note_id="+note_id;
      //console.log(data);

      $.ajax(
      {
        url : '/postNotes',
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