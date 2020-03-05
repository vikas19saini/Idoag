<table id="enquirieslist" class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>S No</th>
        <th>College</th>
        <th>College Id</th>
        <th>Total Users</th>
        <th>Total Users Active</th>
        <th>Active but email not confirmed</th>
    </tr>

    </thead>

    <tbody>

    @foreach($institutions as $key => $institute)

        @if($institute->deleted_at=='')
            <tr {{ ($institute->deleted_at!='') ? " class='deleted'" : "" }}>

                <td>{{ $key+1 }}</td>
                <td>{{ $institute->name}}</td>
                <td>{{ $institute->id}}</td>
                <td>{{ $institute->getStudentsCount()}}</td>
                <td>{{ $institute->getStudentsActiveCount()}}</td>
                <td>{{ $institute->studentsNotConfirmedCount()}}</td>
            </tr>@endif
    @endforeach
    </tbody>

</table>