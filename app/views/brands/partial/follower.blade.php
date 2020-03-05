 @foreach($followers as $follower)        


    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 follower_thumbinfo">
        <div class="follower_thumb">
            {{ HTML::image(getImage('uploads/profiles/',$follower->profile_image,'noimage.jpg'), $follower->first_name, ['class' => 'slider-img']) }}
            <br/>
            <h4>{{$follower->first_name}}</h4></div>
    </div>

@endforeach