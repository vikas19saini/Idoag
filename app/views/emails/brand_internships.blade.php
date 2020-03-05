<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome</title>
    <style type="text/css">
        .table td,.table th{background-color:#fff!important; border:1px solid #ddd!important; font-size: 14px; line-height: 23px; text-align: left;  }

    </style>
</head>

<body>

<table  cellpadding="0" cellspacing="0" style="max-width:580px;  -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; background-color: #fff; border: 1px solid #370c42; margin: 0 auto; padding:0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #838383; font-size: 14px">

    <tr>
        <td>
            <table width="580" height="68" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td align="left" valign="middle"> <a href="{{ URL::route('home') }}">{{ HTML::image('emailers/images/idoag_logo.png','Idoag',['width'=>'100','height'=>'38'])}}</a></td>

                    <td align="right" valign="middle"><p style="color:#333;font-size:17px;"> </p></td>

                </tr>

            </table>
        </td>
    </tr>

    <tr>
        <td  style="font-family: Arial, Helvetica, sans-serif; font-size:15px; color:#333;">

            <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Hi <span style="font-weight:bold; text-transform:uppercase; ">{{$user->first_name. ' '.$user->last_name}},</span></p>

            <p >We have received following new applications for the internships posted by {{$brand->name}}.</p>
            <p>Please <a href="{{ URL::route('login')}}">logon</a> to your account to <a href="{{route('internships_applied',getBrandSlug($user->brand_id))}}">view the applications</a> and take necessary action.</p>
            <table class="table" border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="3" width="100%">
                <thead>
                <tr>
                    <th align="left">Sr. No</th>
                    <th align="left">Internship</th>
                    <th align="left">Student</th>
                    <th align="left">Institution</th>
                    <th align="left">Link</th>
                </tr>
                </thead>
                <tbody>
                @foreach($internships as $key=>$internship)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td> <a href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => getPostSlug($internship->post_id) ))}}">{{getPostName($internship->post_id)}}</a>
                        </td>
                        <td>{{getUserName($internship->user_id)}}</td>
                        <td>{{$internship->institution}}</td>
                          <td ><a href="{{ URL::route('student_internship_view', [getBrandSlug($internship->brand_id),$internship->id, getPostSlug($internship->post_id)]) }}" target="_blank">View</a></td>
                     </tr>
                @endforeach
                </tbody>
            </table>
            <p>Should you have any questions, please feel free to reach out to us.</p>
            <p style="color:#000; font-size:15px; line-height:24px;">Love,<br /> Team Idoag</p>
        </td>
    </tr>

    <tr>
        <td height="50" align="center" valign="middle" style="border-top:1px solid #ccc;"><p style="color:#555;">

                {{ HTML::image('emailers/images/call_icon.png','',['style' => 'margin-right:5px'])}} +91 97171 40443

                {{ HTML::image('emailers/images/mail_icon.png','',['style' => 'margin-right:5px'])}} <a href="mailto:info@idoag.com?Subject=Contact" style="color:#656565; text-decoration:underline; ">info@idoag.com</a></p>
        </td>
    </tr>

    <tr>

        <td height="60" align="center" valign="middle">
            <a href="https://www.facebook.com/idoag" target="_blank"> {{ HTML::image('emailers/images/fb_icon.png','',['style' => 'margin-right:5px'])}}</a>
            <a href="https://www.linkedin.com/company/idoag---the-students'-discount-card" target="_blank">{{ HTML::image('emailers/images/linked_icon.png','',['style' => 'margin-right:5px'])}}</a>
            <a href="https://twitter.com/idoagcard" target="_blank">{{ HTML::image('emailers/images/tw_icon.png','',['style' => 'margin-right:5px'])}}</a>
            <a href="https://plus.google.com/105196013798376513124" target="_blank">{{ HTML::image('emailers/images/gplus_icon.png','',['style' => 'margin-right:5px'])}}</a>
        </td>
    </tr>
</table>
</body>
</html>
