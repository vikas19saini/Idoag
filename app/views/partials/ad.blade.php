<div class="advertisement_img">
	@if($ad_image)
		@if($ad_image->src!='')
	        <a href="{{$ad_image->src}}" target="_blank">
	    {{ HTML::image(getImage('uploads/ads/',$ad_image->image,'advertisement_img.jpg'),'',['class'=>'ad_img'])}}
	    </a>
	    @else
	        {{ HTML::image(getImage('uploads/ads/',$ad_image->image,'advertisement_img.jpg'),'',['class'=>'ad_img'])}}
	    @endif
	@endif
</div>