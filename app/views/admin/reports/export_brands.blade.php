<table id="brandslist" class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>S No</th>
        <th>Brand</th>
        <th>Offers</th>
        <th>Active Offers</th>
        <th>Internships</th>
        <th>Active Internships</th>
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
    @foreach($brands as $key => $brand)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $brand->name}}</td>
            <td>{{ $brand->getCountByType('offer')}}</td>
            <td>{{ $brand->getCountByTypeAndActiveStatus('offer')}}</td>
            <td>{{ $brand->getCountByType('internship')}}</td>
            <td>{{ $brand->getCountByTypeAndActiveStatus('internship')}}</td>
            <td>{{ $brand->getCountByType('event')}}</td>
            <td>{{ $brand->getCountByTypeAndActiveStatus('event')}}</td>
            <td>{{ $brand->getCountByType('photos')}}</td>
            <td>{{ $brand->getCountByType('text')}}</td>
            <td>{{ $brand->LikesCount()}}</td>
            <td>{{ $brand->FeedbackCount()}}</td>
            <td>{{ $brand->FollowerCount()}}</td>

        </tr>
    @endforeach
    </tbody>

</table>