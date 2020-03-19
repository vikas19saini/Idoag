<footer class="footer-bg">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-ftr">
                        <h2>IDOAG</h2>    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="inner-ftr"> 
                        <p>Idoag helps this generation of millennial who sit in college to get access to unique offers.</p>
                        <h4>We’re social, check us out !</h4>
                        <ul>
                            <li class="image-zm"><a href="http://instagram.com/social.idoag" target="_blank">{{ HTML::image('assets/imagesv2/instagram.svg') }}</a>
                                <p><span>Instagram</span></p> 
                            </li>
                            <li class="image-zm"><a href="https://www.facebook.com/idoag" target="_blank">{{ HTML::image('assets/imagesv2/facebook.svg') }}</a>
                                <p><span>Facebook</span></p>    
                            </li>
                            <li class="image-zm"><a href="#">{{ HTML::image('assets/imagesv2/twiter.svg') }}</a>
                                <p><span>Twitter</span></p>    
                            </li>
                            <li class="image-zm"><a href="#">{{ HTML::image('assets/imagesv2/whatsapp.svg') }}</a>
                                <p><span>Whatsapp</span></p>    
                            </li>
                        </ul>
                    </div>
                </div>
            <!--
                <div class="col-md-2 col-6">
                <div class="ft-head">
                <h3>Company</h3>
                <p>Blog</p>
                <p>Team & career</p>
                    <p>Faq</p>
                </div>
            </div>
            -->
                <div class="col-md-2 col-6">
                    <div class="ft-head">
                        <h3>Support</h3>   
                        <p><a href="#">Call us</a></p>
                        <p><a href="#">Custmer care</a></p>
                        <p><a href="{{ URL::route('contactus') }}">Contact us</a></p>
                        
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="ft-head">
                        <h3>Policies</h3> 
                        <p><a href="{{ URL::route('tos') }}">Terms & Condition</a></p>
                        <p><a href="{{ URL::route('privacy-policy') }}">Privacy Policies</a></p>
                        <p><a href="{{ URL::route('faq') }}">Faq</a></p>

                    </div>
                </div>

                <div class="inner-ftr show_social"> 
                    <h4>We’re social, check us out !</h4>
                    <ul>
                        <li><a href="http://instagram.com/social.idoag">{{ HTML::image('assets/imagesv2/instagram.svg') }}</a>
                            <p><span>Instagram</span></p> 
                        </li>
                        <li><a href="https://www.facebook.com/idoag">{{ HTML::image('assets/imagesv2/facebook.svg') }}</a>
                            <p><span>Facebook</span></p>    
                        </li>
                        <li><a href="#">{{ HTML::image('assets/imagesv2/twiter.svg') }}</a>
                            <p><span>Twitter</span></p>    
                        </li>
                        <li><a href="#">{{ HTML::image('assets/imagesv2/whatsapp.svg') }}</a>
                            <p><span>Whatsapp</span></p>    
                        </li>
                    </ul>
                </div>    
            </div>
        </div>    
    </div>    
</footer>
    