<table id="collegelist" class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>S No</th>
        <th>College</th>
        <th>Events</th>
        <th>Upcoming Events</th>
        <th>Photos</th>
        <th>Text Posts</th>
        <th>Total Likes</th>
        <th>Feedback</th>
        <th>Followers</th>
    </tr>
    </thead>
    <tbody>
    @foreach($institutions as $key => $institution)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $institution->name}}</td>
            <td>{{ $institution->getCountByType('insevent')}}</td>
            <td>{{ $institution->getCountByTypeAndActiveStatus('insevent')}}</td>
            <td>{{ $institution->getCountByType('insphoto')}}</td>
            <td>{{ $institution->getCountByType('instext')}}</td>
            <td>{{ $institution->LikesCount()}}</td>
            <td>{{ $institution->FeedbackCount()}}</td>
            <td>{{ $institution->FollowerCount()}}</td>

        </tr>
    @endforeach
    </tbody>

</table>