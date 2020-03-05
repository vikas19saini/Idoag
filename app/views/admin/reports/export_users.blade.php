<table   class="table table-bordered table-hover">

    <thead>
    <tr>
		<th>S No</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Card Number</th>
		<th>College</th>
		<th>Inserted</th>
		<th>Confirm</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $user)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $user->first_name}}</td>
                                                <td>{{ $user->last_name}}</td>
                                                <td>{{ $user->email_id}}</td>
                                                <td>{{ $user->card_number}}</td>
                                                <td>{{ getInstitutionName($user->college_id)}}</td>
                                                 <td>{{ $user->created_at}}</td>
                                                <td>@if($user->activated==0 && $user->created_at!='')Not Confirmed @else Confirmed @endif</td>

                                            </tr>
                                    @endforeach
    </tbody>

</table>