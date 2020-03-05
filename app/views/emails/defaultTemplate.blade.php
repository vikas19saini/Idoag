<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome to IDOAG</title>
</head>
<body>
<table cellpadding="0" cellspacing="0" style="width: 580px; max-width:580px; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; background-color: #fff; border: 1px solid #370c42; margin: 0 auto; padding:0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #838383;">
    <tr>
        <td>
            <div style="margin: 20px 0;">
                Hi {{$name}},<br/><br/>

                We are happy to send you Idoag Student Discount Card to avail all online discount available at www.idoag.com<br/><br/>

                Please feel free to avail all offers.<br/><br/>                
            </div>
			
			<!-- Card Design -->

			<div style="background-image: url({{URL::route('home')}}/carddesign/default_idoag_card_design.png); background-repeat: no-repeat; width:500px; height:324px; color:#fff; padding-left: 25px;">
                                <?php if($roll_no !== 'NULL'){?>

               <div style="padding-top: 51px; font-size: 15px; float: right; color: #ffffff; margin-right: 40px;">{{$roll_no}}</div>
								<?php }?>
                <div style="padding-top: 190px; font-size: 20px; font-weight: bold; letter-spacing: 10px; color: #ffffff;"><?php echo wordwrap($card_number, 4, "<span style='padding: 0 10px;'>-</span>", true);?></div>
                <div style="padding-top: 18px; font-size: 17px; font-weight: bold; text-transform: uppercase; color: #ffffff;">{{$student_name}} </div>
                <div style="padding-top: 10px; font-size: 16px; font-weight: bold; color: #ffffff;">VALID UPTO: <?php echo date("m/Y", strtotime($validate));?></div>
				<div style="display: none;">{{$contact_number}}</div>
			</div>

            <div style="margin: 20px 0;">
                Thanks<br/>
                Idoag Team
            </div>
        </td>
    </tr>
</table>
</body>
</html>
