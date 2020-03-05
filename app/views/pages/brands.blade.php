@extends('layouts.default')

@section('title','Brand Partners - View and Follow Brands Connected with IDOAG |idoag.com')

@section('metatags')

    <meta name="keywords" content="Brand Partners - View and Follow Brands Connected with IDOAG |idoag.com" />

    <meta name="description" content="Brand Partners - View and Follow Brands Connected with IDOAG |idoag.com" />

@stop

@section('css')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
        @include('partials.flash')
        
        @if(isset($loggedin_user) && $loggedin_user && $user_group == 'Students')
        
        <div class="mobile_btmenu othertopmenu" >
            <ul>
                <li>
                    <a href="{{ URL::route('near_brands')}}" >
                    	<i class="fa fa-location-arrow"></i>
                        <span>Brands Near You</span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('local_brands')}}">
                   		<i class="fa fa-th"></i>
                        <span>Local  Brands</span>
                    </a>
                </li>
            </ul>
        </div>
        
        @endif
        
        <div class="search_info">
            
            <div class="container_info">
                
                <input type="text" class="form-control offersearch_icon"  id="search_input" value="" placeholder="Search for Brands">
            
            </div>
        
        </div>
        
        <div class="brandoffer_info">
            
            <div class="container_info">
               
                <div class="brandoffer_contleft">
                    
                    <div class="original_result ">
                    
                        <div class="mybrandoffer_list">
                            
                            @if(!($brands->isEmpty()))
                            
                            <ul>
                                @foreach($brands as $brand)
                                    
                                    @if(!($brand->slug == 'idoag'))
                                    
                                        @include('brands.partial.brand')
                                    
                                    @endif

                                @endforeach

                            </ul>
                            
                            @else
                                <div class="allnotfund_msg">
                                    <div class="allnotfund_msgleft brands_errorleft">{{ HTML::image('assets/images/brands_errorimg.png')}} </div>
                                    <div class="allnotfund_msgright brands_errorright">
                                        <p><span class="bold_msg"> We are in the process of adding new Brands on IDOAG.</span><br/>
                                            Kindly bear with us for sometime and we will notify you once this is active.</p>
                                    </div>
                                </div>

                            @endif
                        
                        </div>
                        
                    </div>

                    <div class="search_result"> <ul> </ul></div>

                </div>
                
                
                <div class="notice_feed_info studentdashboard ">

                    @if(isset($loggedin_user) && $loggedin_user && $user_group == 'Students')

                        <div class="brandsnearyou_info">
                            
                            <h4>BRANDS NEAR YOU</h4>

                            @if($near_brands)
                            
                            <div class="brandsnearyou_list">

                                <ul>
                                    @foreach($near_brands as $brand)

                                    <li>
                                        <div class="brandsnearyou_listimg"> <a href="{{URL::route('brand_profile',array($brand->slug))}}"> {{ HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'),'',['class'=>'brand_img'])}}</a> </div>

                                        <div class="brandsnearyou_listcont"> <a href="{{URL::route('brand_profile',array($brand->slug))}}">{{$brand->name}}</a> </div>

                                        <div class="brandsnearyou_listcont2"> {{ HTML::image('assets/images/like4_icon.png')}} <span>+{{getBrandFollowsCount($brand->id)}}</span>  </div>
                                    </li>

                                   @endforeach

                                </ul>

                            </div>

                            @else

                            <p>No Brands near {{getCity($student_details->city)}}</p>

                            @endif

                        </div>

                        <div class="brandsnearyou_info">

                            <h4>LOCAL BRANDS </h4>
                            
                            @if($local_brands)

                                <div class="brandsnearyou_list">

                                    <ul>

                                        @foreach($local_brands as $brand)

                                            <li>
                                                <div class="brandsnearyou_listimg"> <a href="{{URL::route('brand_profile',array($brand->slug))}}"> {{ HTML::image(getImage('uploads/brands/',$brand->image,'noimage.jpg'),'',['class'=>'brand_img'])}}</a> </div>

                                                <div class="brandsnearyou_listcont"> <a href="{{URL::route('brand_profile',array($brand->slug))}}">{{$brand->name}}</a> </div>

                                                <div class="brandsnearyou_listcont2"> {{ HTML::image('assets/images/like4_icon.png')}} <span>+{{getBrandFollowsCount($brand->id)}}</span>  </div>
                                            </li>

                                        @endforeach

                                    </ul>

                                </div>

                            @else

                                <p>No Local Brands</p>

                            @endif

                        </div>
	
                    @else
                         @include('partials.ad')

                    @endif
										 

                </div>

            </div>
        
        </div>

        <!-- selectall with idoag -->
        <div id="selectall_brandsfollows" class="modal fade" role="dialog">
            
            <div class="modal-dialog institutions_modal-dialog"> 
              
                <!-- Modal content-->
                <div class="modal-content institutions_modal-content">
                   
                    <div class="modal-header selectall_header">
                      
                      <button type="button" class="close" data-dismiss="modal"><img src="assets/images/popup_close.png"/></button>
                      
                      <h4 class="modal-title">Register with idoag</h4>
                    
                    </div>

                    <div class="modal-body">

                        <div class="select_info">
                            
                            <div class="checkbox selectall">
                                
                                <label><input type="checkbox" value="">Option 21</label>
                                
                            </div>

                            <div class="checkbox unselectall">
              
                                <label><input type="checkbox" value="">Option 12</label>
                                
                            </div>
           
                        </div>
           
                        <div class="popup_selectall">   
                     
                            <div class="checkbox">
                  
                                <label><input type="checkbox" value="">Option 1</label>
                            </div>

                            <div class="checkbox">

                                <label><input type="checkbox" value="">Option 2</label>
                            
                            </div>
                            
                            <div class="checkbox">
                            
                            <label><input type="checkbox" value="">Option 3</label>
                            
                            </div>
                          
                        </div>
                
                    </div>

                </div>

            </div>

        </div>
        <!-- selectall with idoag end --> 

    </div>



        <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')

<script>

    $(document).ready(function() {


        var timer;

        $("#search_input").keyup(function(){

            var keywords = $('#search_input').val();

            timer = setTimeout(function()
            {

                if(keywords.length > 0)
                {
                    $.post('<?php echo url()?>/searchBrand',{keywords: keywords},function(response){

                        if(response)
                        {
                            $('.mybrandoffer_list').hide();
                            $('.search_result').html(response);
                        }
                    });
                }
                else
                {
                     $('.mybrandoffer_list').show();
                    $('.search_result').html('');
                }
            }, 500);
        });


        $("#search_input").keydown(function(){

            clearTimeout(timer);

        });
    });

</script>

@stop