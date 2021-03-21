<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<body style="margin: 0; padding: 0; background-repeat: repeat-y no-repeat;background-position: 50% 50%;background-image: url('http://bmusewebsites.s3.amazonaws.com/test/background.jpg');>
<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

    <tr>
        <td>

            <table align="center" border="1" cellpadding="50" cellspacing="0" width="600" style="border-collapse: collapse;background-color:#f8f5ec">
                <tr style="vertical-align: middle">
                    <td>
                        <img src="http://bmusewebsites.s3.amazonaws.com/test/logo.gif" />
                    </td>
                </tr>
                <tr>
                    <td >

                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="500" style="border-collapse: collapse;font-family:Georgia, Times, serif;  font-size:14px; color:#333333">
                           <tr background-color:"#BDBAB5"> 
                           <td  height="2px">&nbsp;</td>
                            </tr>
                            <tr>
                                <td  height="60px">
                                    <p style="margin: 0;">Hello {{$name}}!</p>
                                     {!!$notes!!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>

</head>
</html>