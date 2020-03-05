<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome to IDOAG</title>
</head>

<body>
<table  cellpadding="0" cellspacing="0" style="max-width:580px;  -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; background-color: #fff; border: 1px solid #370c42; margin: 0 auto; padding:0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #838383; font-size: 14px">
    <tr>
        <td><table width="580" height="68" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left" valign="middle"> <a href="{{ URL::route('home') }}">{{ HTML::image('emailers/images/idoag_logo.png','',['width'=>'100','height'=>'38'])}}</a></td>
                    <td align="right" valign="middle"><p style="color:#333;font-size:17px;">Your password for IDOAG</p></td>
                </tr>
            </table></td>
    </tr>

    <tr  valign="top">
        <td><p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Hi <span style="font-weight:bold; text-transform:uppercase; ">{{$first_name}},</span></p>
            <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Please click on the link below to reset your password.<br/>
                This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.</p>
            <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">
                <a href="{{ URL::to('reset_password', array($token)) }}" style="color:#e8674e; text-decoration:underline;"> {{ URL::to('reset_password', array($token)) }}</a></p>
        </td>

    </tr>


    <tr>
        <td>
            <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;"> Hope to see you there soon! </p>
        </td>
        
    </tr>    

    <tr>
        <td valign="top">
                         
            <p style="color:#000; font-size:15px; line-height:24px;">Love,<br /> Team Idoag</p>

        </td>
    </tr>

</table>
</body>
</html>    