<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Welcome</title>

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
        <td>

            <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Hi <span style="font-weight:bold; text-transform:uppercase; ">{{$first_name}},</span></p>

            <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Welcome to IDOAG and thanks for activating your account.</p>

        </td>

    </tr>

    <tr>
        <td valign="top">

            <p style="color:#000; font-size:15px; line-height:24px;">As a first step, we recommend that you <a href="www.idoag.com" style="color:#e8674e; text-decoration:underline;" target="_blank">click here</a> to logon to your account and build your page. </p>

            <p style="color:#000; font-size:15px; line-height:24px;">You could do all of the following on IDOAG through your Brand Page</p>

            <ul>

                <li><p style="color:#000; font-size:15px; line-height:24px;"> Maintain Your Institute Page </p></li>

                <li><p style="color:#000; font-size:15px; line-height:24px;"> Post Your  Events and Photos</p></li>

                <li><p style="color:#000; font-size:15px; line-height:24px;"> View Followers and Feedback</p></li>

                <li><p style="color:#000; font-size:15px; line-height:24px;"> Check Overall Performance of Your Posted Content</p></li>

                <li><p style="color:#000; font-size:15px; line-height:24px;"> View Statistics For Each Category of posts</p></li>

            </ul>

            <p style="color:#000; font-size:15px; line-height:24px;">Once again, Thanks for placing your trust on us and we shall leave no stone unturned to provide you with the best of service</p>

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
