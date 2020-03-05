  <div class="megamenu clearfix">
 
                  <ul class="col-lg-2 col-md-2 col-sm-2 col-xs-12 link-list">
                      <li class="title">Top Brands <i></i></li>
<div id="content-2" class="submenu_list content mCustomScrollbar light" data-mcs-theme="minimal-dark">  
                    @foreach($brands_nav as $brand)
                        <li><i class="lshape_arrow"></i><a href="{{URL::route('brand_profile',array($brand->slug))}}">{{$brand->name}}</a></li>
                    @endforeach
</div>
                 </ul>

                     
                  <ul class="col-lg-2 col-md-2 col-sm-2 col-xs-12 link-list">
                    <li class="title">Categories <i></i></li>

<div id="content-2" class="submenu_list content mCustomScrollbar light" data-mcs-theme="minimal-dark">            
                        @foreach($categories_nav as $category)
                            <li><i class="lshape_arrow"></i><a href="{{URL::route('brand_category',array($category->slug))}}">{{$category->name}}</a></li>
                        @endforeach
   </div>                  
  </ul>

  
  
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 menuslider">
                  <h3 class="title">My Brands</h3>
                    <div class="mybrandslider_info">

                @foreach($mybrands_nav as $mybrand)
                          <div class="mybrandslider_list">
            
                            <div class="mybrandslider_listimg"> <a href="{{URL::route('brand_profile',array($mybrand->slug))}}">
                                    {{   HTML::image(getImage('uploads/brands/',$mybrand->image,'noimage.jpg'))}}

                                </a> </div>
            
                             <div class="mybrandslider_listcont clearfix">
                            
                                <div class="brandname"><a href="{{URL::route('brand_profile',array($mybrand->slug))}}">{{$mybrand->name}}</a></div>
              
                                <div class="brandlike">{{ HTML::image('assets/images/like2_icon.png') }} +{{getBrandFollowsCount($mybrand->id)}}</div>
            
                            </div>
          
                        </div>

                    @endforeach
                    
    			</div>
  
  			</div>

		</div>
 