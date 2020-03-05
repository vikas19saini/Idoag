<ul>
   <li>
      <a href='{{URL::to('/')}}/student/{{$user->id}}'><i class="fa fa-user"></i> Personal Details</a>
   </li>
   <li>
      <a href='{{URL::to('/')}}/student/education_details/{{$user->id}}'><i class="fa fa-graduation-cap"></i> Education Details</a>
   </li>
   <li>
      <a href='{{URL::to('/')}}/student/professional_details/{{$user->id}}'><i class="fa fa-briefcase" aria-hidden="true"></i> Professnal Details</a>
   </li>
   <li>
      <a href='{{URL::to('/')}}/student/work_samples/{{$user->id}}'> <i class="fa fa-cogs"></i> Work Samples</a>
   </li>
   <li>
      <a href='{{URL::to('/')}}/student/additional_details/{{$user->id}}'><i class="fa fa-plus" aria-hidden="true"></i> Additional Details</a>
   </li>
   <li>
      <a href='{{URL::to('/')}}/student/changepassword/{{$user->id}}'><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
   </li>
</ul>