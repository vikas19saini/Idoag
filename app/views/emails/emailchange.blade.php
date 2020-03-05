<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to IDOAG</title>
</head>

<body>
<table  cellpadding="0" cellspacing="0" style="max-width:580px;  -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; background-color: #fff; border: 1px solid #370c42; margin: 0 auto; padding:0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #838383;">
  <tr>
    <td><table width="580" height="68" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td align="left" valign="middle"> <a href="{{ URL::route('home') }}">{{ HTML::image('emailers/images/idoag_logo.png','',['width'=>'100','height'=>'38'])}}</a></td>
        <td align="right" valign="middle"><p style="color:#333;
    font-size:17px;">Your password for IDOAG</p></td>
      </tr>
    </table></td>
  </tr>
  <tr height="300" valign="top">
    <td>

    <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Hi <span style="font-weight:bold; text-transform:uppercase; ">{{$first_name}},</span></p>
    
    <p style="font-family: Arial, Helvetica, sans-serif; font-size:15px; color:#333;">As per your request, your email has been updated in our records. Please click on following button to confirm the same.</p>
    
    <a href="{{ URL::to('email-change', array($token)) }}" style="background-color:#00BCD4;border:1px solid #00BCD4; margin:10px 0px;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;">Confirm My Email Address</a>
    <!-- <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">
    <a href="{{ URL::to('email-change', array($token)) }}" style="color:#e8674e; text-decoration:underline;">http://idoag.com/email-change</a></p> -->
    
    <p style="font-family: Arial, Helvetica, sans-serif; font-size:15px; color:#333; font-style:italic;">In case the link is not displayed correctly, please copy the URL below and paste it into your browser.</p>

    <p style="color:#000; font-size:15px; line-height:24px;"> {{ URL::to('email-change', array($token)) }} </p>
    
    </td>
  </tr>
   <tr>
        <td>
            <p style="font-family: Arial, Helvetica, sans-serif; font-size:15px; color:#333;"> Hope to see you there soon! </p>
        </td>
        
    </tr>   
  <tr valign="top">
    <td>            
      <p style="color:#000; font-size:15px; line-height:24px;">Love,<br /> Team Idoag</p>
    </td>
    </tr>


 
</table>
</body>
</html>

