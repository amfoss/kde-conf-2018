<?php
error_reporting(0);
# Database Connection
class database extends SQLite3
{
	function __construct()
	{
		$this->open( 'minidebconf.db' );
	}
}
$db = new database();
if ( !$db )
{
	echo $db->lastErrorMsg();
}
else
{
	$sql = <<<EOF
    CREATE TABLE IF NOT EXISTS registration
    (NAME          TEXT    NOT NULL,
    EMAIL         TEXT    NOT NULL,
    ORG           TEXT,
    CITY          TEXT,
    LAP           INT,
    ACCOM         INT,
    TSHIRT        TEXT,
    ARRIVAL       TEXT,
    DEPARTURE     TEXT,
    REGTIME       TEXT);
EOF;
	$ret = $db->exec( $sql );
}

$name = $email = $org = $city = $prearrival = $predeparture = $arrival = $departure = "";
$lap = $accom = 0;
$nameerror = $emailerror = $arrivalerror = $departureerror = $orgerror = $cityerror = "";
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
	require_once( 'recaptchalib.php' );
	$privatekey = "6LfgcfsSAAAAAAzCIC7awzgPpYm1Q2riXKRPvnlo";
	$resp = recaptcha_check_answer ( $privatekey,
	$_SERVER["REMOTE_ADDR"],
	$_POST["recaptcha_challenge_field"],
	$_POST["recaptcha_response_field"] );

	if ( !$resp->is_valid ) {
		// What happens when the CAPTCHA was entered incorrectly
		die ( "The reCAPTCHA wasn't entered correctly. Go back and try it again." .
		"(reCAPTCHA said: " . $resp->error . ")" );
	} else {
		// Your code here to handle a successful verification
		$myDateTime = new DateTime( Date( '' ), new DateTimeZone( 'GMT' ) );
		$myDateTime->setTimezone( new DateTimeZone( 'Asia/Kolkata' ) );
		$date = $myDateTime->format( 'Y-m-d H:i:s' );
		$name = SQLite3::escapeString($_POST['del-name']);
		if ( empty( $_POST['del-email'] ) )
		{
			$emailerror = "Required Field";
		}
		else
		{
			$email = SQLite3::escapeString($_POST['del-email']);
			if ( !preg_match( "/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email ) )
			{
				$emailerror = "Invalid Format";
			}
		}
		$org = SQLite3::escapeString($_POST['del-org']);
		$city = SQLite3::escapeString($_POST['del-city']);
		if ( !preg_match( '/$^|^[a-zA-Z]+[0-9]*[\. ,]*[a-zA-Z0-9]*$/', $city ) )
		{
			$cityerror = "City name must start with a letter and can contain only alphanumerics, spaces, periods and commas";
		}

		if ( empty( $_POST['del-arrival'] ) ) {

			$arrivalerror = "No arriving date given";
		} else {

			$arrival = SQLite3::escapeString($_POST['del-arrival']);
		}
		if ( empty( $_POST['del-depart'] ) ) {
			$departureerror = "No departure date given";
		} else {
			$departure = SQLite3::escapeString($_POST['del-depart']);
		}
		$lap = 1;
		if ( empty( $_POST['del-accom'] ) ) {
			$accom = "0";
		} else {
			$accom = SQLite3::escapeString($_POST['del-accom']);
		}
		if ( empty( $_POST['del-tshirt'] ) ) {
			$tshirt = "0";
		} else {
			$tshirt = SQLite3::escapeString($_POST['del-tshirt']);
		}

		if ( $nameerror == "" && $emailerror == "" && $arrivalerror == "" && $departureerror == "" && $orgerror == "" && $cityerror == "" )
		{

			$sql = "INSERT INTO `registration` VALUES ('$name','$email','$org','$city','$lap','$accom','$tshirt','$arrival','$departure','$date')";

			$ret = $db->exec( $sql );
			if ( $ret )
			{
				$db->close();
				header( 'location:../../registration_success.html' );
			} else {
				header( 'location:../../registration_fail.html' );
			}
		} else {
			header( 'location:../../registration_fail.html' );
		}
	}
}
?>
