jQuery(document).ready(function ($) {

  
  $(document).on("click", ".c5-install-button", function (e) {
  		data = '<h3><span class="fa fa-spin fa-circle-o-notch"></span> Installting...</h3><p>Please wait, you will be notified when your request is processed.</p>';
  			$.magnificPopup.open({
  			  items: {
  			    src: data
  			  },
  			  mainClass: 'mfp-install-demo-post',
  			  type: 'inline'
  			}, 0);
  		
      });
 });