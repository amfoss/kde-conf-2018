<?php
if ((isset($_POST['name'])) && (strlen(trim($_POST['name'])) > 0)) {
    $name = stripslashes(strip_tags($_POST['name']));
} else {
    $name = 'No name entered';
}
if ((isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0)) {
    $email = stripslashes(strip_tags($_POST['email']));
} else {
    $email = 'No email entered';
}
if ((isset($_POST['phone'])) && (strlen(trim($_POST['phone'])) > 0)) {
    $phone = stripslashes(strip_tags($_POST['phone']));
} else {
    $phone = 'No phone entered';
}
if ((isset($_POST['price'])) && (strlen(trim($_POST['price'])) > 0)) {
    $price = stripslashes(strip_tags($_POST['price']));
} else {
    $price = 'Price not selected';
}
if ((isset($_POST['org'])) && (strlen(trim($_POST['org'])) > 0)) {
	$org = stripslashes(strip_tags($_POST['org']));
} else {
	$org = 'Organization not selected';
}
if ((isset($_POST['tshirt'])) && (strlen(trim($_POST['tshirt'])) > 0)) {
	$tshirt = stripslashes(strip_tags($_POST['tshirt']));
} else {
	$tshirt = 'T Shirt not selected';
}
if ((isset($_POST['arrival'])) && (strlen(trim($_POST['arrival'])) > 0)) {
	$arrival = stripslashes(strip_tags($_POST['arrival']));
} else {
	$arrival = 'Arrival not selected';
}
if ((isset($_POST['depart'])) && (strlen(trim($_POST['depart'])) > 0)) {
	$depart = stripslashes(strip_tags($_POST['depart']));
} else {
	$depart = 'Departure not selected';
}
if ((isset($_POST['accommodation'])) && (strlen(trim($_POST['accommodation'])) > 0)) {
	$accommodation = stripslashes(strip_tags($_POST['accommodation']));
} else {
	$accommodation = 'Departure not selected';
}

ob_start();
?>
<html>
<head>
    <style type="text/css">
    </style>
</head>
<body>
<table width="550" border="0" cellspacing="0" cellpadding="15">
    <tr bgcolor="#eeffee">
        <td>Name</td>
        <td><?php echo $name; ?></td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>Email</td>
        <td><?php echo $email; ?></td>
    </tr>
    <tr bgcolor="#eeffee">
        <td>Phone</td>
        <td><?php echo $phone; ?></td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>Organization</td>
        <td><?php echo $org; ?></td>
    </tr>
	<tr bgcolor="#eeeeff">
		<td>T Shirt</td>
		<td><?php echo $tshirt; ?></td>
	</tr>
	<tr bgcolor="#eeeeff">
		<td>Arrival Date</td>
		<td><?php echo $arrival; ?></td>
	</tr>
	<tr bgcolor="#eeeeff">
		<td>Departure Date</td>
		<td><?php echo $depart; ?></td>
	</tr>
	<tr bgcolor="#eeeeff">
		<td>Accommodation Required?</td>
		<td><?php echo $accommodation; ?></td>
	</tr>
</table>
</body>
</html>
<?php
$body = ob_get_contents();

$to = 'fossatamrita@gmail.com';
$toname = 'FOSSAtamrita';
//$anotheraddress = 'email@example.com';
//$anothername = 'Another Name';

require("phpmailer.php");

$mail = new PHPMailer();

$mail->From = $email;
$mail->FromName = $name;
$mail->AddAddress($to, $toname); // Put your email
//$mail->AddAddress($anotheraddress,$anothername); // addresses here

$mail->WordWrap = 50;
$mail->IsHTML(true);

$mail->Subject = "Demo Form:  Registration form submitted";
$mail->Body = $body;
$mail->AltBody = $message;

if (!$mail->Send()) {
    $recipient = $to;
    $subject = 'Registration form failed';
    $content = $body;
    mail($recipient, $subject, $content, "From: $name\r\nReply-To: $email\r\nX-Mailer: DT_formmail");
    exit;
}
?>
