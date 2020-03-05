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
                    <td align="right" valign="middle"><p style="color:#333;font-size:17px;"> </p></td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td style="border-top:5px solid #e8674e;"> </td>
    </tr>
    <tr  valign="top">
        <td style="font-family: Arial, Helvetica, sans-serif; font-size:15px; color:#333333;"><p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Hi <span style="font-weight:bold; text-transform:uppercase; ">{{$name}},</span></p>
            <p>Thank you so much for your application for Internship  <strong>{{$postname}}</strong> at <strong>{{$brand}}</strong>. After careful consideration, we regret to inform you that although your resume and cover letter were very competitive, Brand team reviewed your application and did not select it for further consideration. This will not have any bearing on your other applications in any way.</p>
            <p>We wish you all the best and hope we will have the chance to consider you for another opportunity in the future.</p>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr valign="top">
        <td>
            <p style="color:#000; font-size:15px; line-height:24px;">Love,<br /> Team Idoag</p>
        </td>
    </tr>
    <tr>
        <td height="50" align="center" valign="middle" style="border-top:1px solid #ccc;"><p style="color:#555;">
                {{ HTML::image('emailers/images/call_icon.png','',['style' => 'margin-right:5px'])}} +91 97171 40443
                {{ HTML::image('emailers/images/mail_icon.png','',['style' => 'margin-right:5px'])}} <a href="mailto:info@idoag.com?Subject=Contact" style="color:#656565; text-decoration:underline; ">info@idoag.com</a></p></td>
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