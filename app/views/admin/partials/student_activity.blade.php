@if(count($internships)==0)
<p>No Internships applied applied in this date range.</p>
@else
    <h4>Internship Applications</h4>
    <table class="table table-striped table-bordered table-hover" id="internships_list">
    <thead>
    <tr>
        <th>SNo</th>
        <th>Post Name</th>
        <th>Category</th>
        <th>Location</th>
        <th>Status</th>
        <th>Applied on</th>
        <th>View</th>
    </tr>
    </thead>
    <tbody>
    @foreach($internships as $key => $internship)
        @if($internship->deleted_at=='')
            <tr {{ ($internship->deleted_at!='') ? " class='deleted'" : "" }}>

                <td>{{ $key+1 }}</td>

                <td>{{ $internship->post->name }}</td>

                <td>{{ $internship->post->category }}</td>

                <td>{{ $internship->post->location }}</td>

                <td>{{$internship_status[$internship->status]}}</td>

                <td>{{ date('Y-M-d H:i:s', strtotime($internship->created_at)) }}</td>
                <td><a href="#"> View</a></td>
            </tr>@endif
    @endforeach

    </tbody>
</table>
@endif

<p><strong>Posts Visits in the date range:</strong> {{ $statistics['posts_visits_count'] }}</p>

<p><strong>Posts Likes  in the date range :</strong> {{ $statistics['posts_likes_count'] }}</p>

