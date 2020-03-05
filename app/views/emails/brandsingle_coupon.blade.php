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

    <tr  valign="top">
        <td><p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Hi <span style="font-weight:bold; text-transform:uppercase; ">{{$name}},</span></p>

            <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Here is your coupon code as requested</p>
        </td>
    </tr>
    <tr>
        <td><table width="580" border="0" cellspacing="0" cellpadding="0">
                <tr align="left" valign="middle">
                    <td width="193" style="border:1px solid #aaa; border-right:0px;">{{ HTML::image('uploads/brands/'.$image,'',['width'=>'124','height'=>'48','style'=>'padding-left:10px'])}}</td>
                    <td width="193" align="center"  style="border-top:1px solid #aaa; border-bottom:1px solid #aaa; font-size:15px; color:#000;"><strong>{{$postname}}</strong></td>
                    <td width="193" align="center" style="border:1px solid #aaa; border-left:0px;"><p style="font-size:15px; color:#333;">Coupon</p>
                        <p style="font-size:15px; color:#333;"><strong>{{$code}}</strong></p></td>
                </tr>
            </table></td>
    </tr>

    <tr valign="top">
        <td> {{$message}}
            <br/>
            <p style="color:#000; font-size:15px; line-height:24px;">Thanks for your co-operation and in case of any concerns,<br />
                kindly feel free to get in touch with us at <a href="mailto:info@idoag.com?Subject=Contact" style="color:#e8674e; text-decoration:underline; ">info@idoag.com</a></p>

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