<div class="inner_div_useonly wor_new less_pad" id="display_offers" style="background:inherit"> 
                                        @if(count($offers) > 0)
                                        
                                            @foreach($offers as $offer)
                                                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                                                    <div class="item_offer" style="position:relative">
                                                        <div class='inner_div_useonly'>
                                                            @if(Sentry::check())
                                                                <a  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">
                                                            @else
                                                                <a  href="#" data-toggle="modal" data-target="#login_required" data-id="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" class="login_btnpop">                                                            
                                                            @endif
                                                                <div class='moreinner'>
                                                                    {{ HTML::image(getImage('uploads/photos/M_',$offer->image,'noimage.jpg'),'',['class'=>'brand_img'])}}
                                                                    <h1>{{ HTML::image(getImage('uploads/brands/',getBrandLogo($offer->brand_id),'noimage.jpg'),'')}}</h1>
                                                                </div>
                                                            </a>                                                            
                                                            @if(Sentry::check())
                                                                <a  href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}">
                                                            @else
                                                                <a  href="#" data-toggle="modal" data-target="#login_required" data-id="{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}" class="login_btnpop">                                                            
                                                            @endif
                                                                <div class="offers_min">
                                                                    <p>{{ShortenText($offer->short_description,70)}}</p>
                                                                    <!--<p class="text-center"><span>Click here to get your coupon code</span></p>-->
                                                                </div>
                                                            </a>
                                                            <div class='clearfix'></div>
                                                            <div class="uicon_latest">
                                                                <i class="fa likeicons @if(checkLikes($offer->id)) fa-heart @else fa-heart-o  @endif " @if(Sentry::check()) id="{{$offer->id}}" @endif> {{getPostInfoCount($offer->id, 'likes')}}</i>
                                                                <i class="fa fa-share-alt share_social"></i>
                                                                <div style="top:76%;right:2em" class="addthis_sharing_toolbox">
                                                                    <span style="display:inline" class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$offer->image}}','{{$offer->short_description}}','{{$offer->name}}','{{ URL::route('offer_details',array('slug1' => getBrandSlug($offer->brand_id), 'slug2' => $offer->slug ))}}')"><i class="fa fa-facebook"></i></a></span>
                                                                    <span style="display:inline" class="share_tw"><a href="https://twitter.com/home?status={{$offer->name}} - {{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}} via idoagcard" target="_blank"><i class="fa fa-twitter"></i></a></span>
                                                                    <span style="display:inline" class="share_pin"><a href="https://pinterest.com/pin/create/button/?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}}&media=http://idoag.com/uploads/photos/M_{{$offer->image}}&description={{ $offer->name }}" target="_blank"><i class="fa fa-pinterest"></i></a></span>
                                                                    <span style="display:inline" class="share_gplus"><a href="https://plus.google.com/share?url={{ URL::route('get_offers',array('slug1' => getBrandSlug($offer->brand_id)))}}" target="_blank"><i class="fa fa-google-plus"></i></a></span>
                                                                </div>
                                                            </div>
                                                        </div>         
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                        
                                            <p><span class="bold_msg"> OOps..! No offer found for this keyword..</span></p>
                                            
                                       @endif
</div>