<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Welcome to IDOAG</title>

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
            <table width="580" border="0" cellspacing="0" cellpadding="0" style="border-top:5px solid #e8674e;">
                
                <tr bgcolor="#ebebeb">

                    <td width="150" height="60" align="left" valign="middle"><p style="font-size:13px; color:#000; margin-bottom:4px; padding-left:20px">Card number: </p>
                        <p style="font-size:13px; color:#000; font-weight:bold; padding-left:20px; margin-top:0px;">{{$card_number}}</p></td>
                    <td width="20" height="45" align="center" valign="middle" bordercolordark="white" border="1"> {{ HTML::image('emailers/images/border_img.png','',['width'=>'1','height'=>'45'])}}</td>

                    <td width="130" height="60"><p style="font-size:13px; color:#000; margin-bottom:4px;">Expiry Date: </p>
                        <p style="font-size:13px; color:#000; margin-top:0px;">{{$expiry}}</p></td>
                    <td width="20" height="45" align="center" valign="middle" bordercolordark="white" border="1"> {{ HTML::image('emailers/images/border_img.png','',['width'=>'1','height'=>'45'])}}</td>

                    <td width="193" height="60"><p style="font-size:13px; color:#000; margin-bottom:4px;">Institute:</p>
                        <p style="font-size:13px; color:#000; margin-top:0px;">{{$institution}}</p></td>
                </tr>

            </table>
        </td>
    </tr>

    <tr>
        <td>
            
            <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Hi <span style="font-weight:bold; text-transform:uppercase; ">{{$first_name}},</span></p>
            
            <p style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#333;">Welcome to IDOAG and thanks for activating your card</p>
        
        </td>

    </tr>

    <tr>
        <td valign="top">
            
            <p style="color:#000; font-size:15px; line-height:24px;"> Please <a href="www.idoag.com" target="_blank"> click here</a> to logon  to your account where you would be able to access all the offers and opportunities from our Brand partners. Please note that some of these offers are dynamic so please visit <a href="www.idoag.com" style="color:#e8674e; text-decoration:underline;" target="_blank">www.idoag.com</a> in order to know the current status of any offer.</p>
           
            <p style="color:#000; font-size:15px; line-height:24px;">We have made all attempts to make this website as simple as possible for you. Incase you have any concerns/feedback and our team is always there to serve you should you require any help.</p>
            
            <p style="color:#000; font-size:15px; line-height:24px;">Thanks for placing your trust on us and we shall leave no stone unturned to provide you with the best of service.</p>
            
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
