<table id="internshiplist" class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>S No</th>
        <th>Brand</th>
        <th>Internship</th>
        <th>Total Applications</th>
        <th>Approved</th>
        <th>Rejected</th>
        <th>OnHold</th>
        <th>InProcess</th>
    </tr>
    </thead>
    <tbody>
    @foreach($internships as $key => $internship)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ getBrandName($internship->brand_id)}}</td>
            <td>{{ $internship->name}}</td>
            <td>{{ count($internship->internships)}}</td>
            <td>{{ getInternshipCountByStatus($internship->id,1)}}</td>
            <td>{{ getInternshipCountByStatus($internship->id,2)}}</td>
            <td>{{ getInternshipCountByStatus($internship->id,3)}}</td>
            <td>{{ getInternshipCountByStatus($internship->id,0)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>