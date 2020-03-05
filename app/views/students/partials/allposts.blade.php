@foreach($posts as $post)
    
    @if((isset($loggedin_user) && $loggedin_user->brand_id != $post->brand_id &&  $post->status==0)||(isset($loggedin_user) && $loggedin_user->institution_id != $post->institution_id &&  $post->status==0)|| (!isset($loggedin_user) &&  $post->status==0))

    @else

    @include('students.partials.dashboard_post') 

 	<!-- <br>{{$post->type}} - {{$post->id}} - {{$post->end_date}}<br> -->
    @endif

@endforeach