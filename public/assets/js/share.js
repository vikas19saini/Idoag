 window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '1664606373750912',                            
      status     : true,                                 
      xfbml      : true                                  
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/all.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  $(document).on('click','.share_fb_new',function(){
    var fbimage = $(this).parents('.brandoffer_img').find('a img').attr('src'); 
    var fbdesc = $(this).parents('li').find('.brandoffer_cont .brandoffer_continner p').html(); 
     var fbtitle = $(this).parents('li').find('h5 a').html(); 
      var fburl= $(this).parents('li').find('b').html();
     FBShareOp(fbimage, fbdesc, fbtitle, fburl);
    // console.log(fbimage,fbdesc);
  });

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();


function FBShareOp(fbimage, fbdesc, fbtitle, fburl){
    url = 'http://idoag.com/uploads/photos/M_';

    var product_name   =    'IDOAG - '+ fbtitle;
    var description    =    fbdesc;
    var share_image    =    fbimage;
    var share_url      =    fburl;
    var share_capt     =    'IDOAG';
    console.log(share_image);
    console.log(description);
    FB.ui({
        method: 'feed',
        name: product_name,
        link: share_url,
        picture: share_image,
        caption: share_capt,
        description: description

    }, function(response) {
        if(response && response.post_id){
            console.log('if');
            console.log(response);
        }
        else{
            console.log('else');
        }
    });

}


function FBShareOpDB(fbimage, fbdesc, fbtitle, fburl){
    url = 'http://idoag.com/uploads/photos/M_';
    var product_name   =    'IDOAG - '+ fbtitle;
    var description    =    fbdesc;
    var share_image    =    url+fbimage;  
    var share_url      =    fburl;
    var share_capt     =    'IDOAG';
    console.log(share_image);
    console.log(description);
    FB.ui({
        method: 'feed',
        name: product_name,
        link: share_url,
        picture: share_image,
        caption: share_capt,
        description: description

    }, function(response) {
        if(response && response.post_id){
            console.log('if');
            console.log(response);
        }
        else{
            console.log('else');
        }
    });

}