

            @foreach($students as $key => $student)

                  @if($student->deleted_at=='')
                                                 <tr {{ ($student->deleted_at!='') ? " class='deleted'" : "" }}>
                    
                    <td>{{ $key+1 }}</td>
                    
                    <td>{{ $student->card_number }} </td>

                    <td>{{ $student->rollno }} </td>

                    <td>{{ $student->status }} </td>

                    <td>{{ $student->contact_number }} </td>

                    <td>{{ $student->first_name }} </td>

                    <td>{{ $student->last_name }} </td>

                    <td>{{ $student->dob }} </td>

                    <td>{{ $student->college_id }} </td>

                    <td>{{ $student->streamorcourse }} </td>

                    <td>{{ $student->validity_for_how_many_years }} </td>

                    <td>{{ $student->cluborgrouporsociety }} </td>

                    <td>{{ $student->residentordayscholar }} </td>

                    <td>{{ $student->date_of_issue }} </td>

                    <td>{{ $student->expiry_date }} </td>

                    <td>{{ $student->section }} </td>

                    <td>{{ $student->father_name }} </td>

                    <td>{{ $student->batch_year }} </td>

                    <td>{{ $student->program_duration }} </td>

                    <td>{{ $student->email_id }} </td>

                    <td>{{ $student->gender }} </td>

                    <td>{{ date('Y-M-d H:i:s', strtotime($student->created_at)) }}</td>

                    <td><a href="{{ URL::route('admin.students.edit', [$student->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>
                    
                    <td><input name="checkall[]" type="checkbox" class="checkall" value="{{ $student->id }}"></td>
                                                                               
                </tr>
                    
            @endforeach



