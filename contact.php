<?php
// OPTIONS - PLEASE CONFIGURE THESE BEFORE USE!
$yourEmail = "askdonno@gmail.com"; // the email address you wish to receive these mails through
$yourWebsite = "www.dlp3.me"; // the name of your website
$thanksPage = 'thanks.html'; // URL to 'thanks for sending mail' page; leave empty to keep message on the same page
$maxPoints = 4; // max points a person can hit before it refuses to submit - recommend 4
$requiredFields = "name,email,comments"; // names of the fields you'd like to be required as a minimum, separate each field with a comma
// DO NOT EDIT BELOW HERE
$error_msg = array();
$result = null;
$requiredFields = explode(",", $requiredFields);
function clean($data) {
$data = trim(stripslashes(strip_tags($data)));
return $data;
}
function isBot() {
$bots = array("Indy", "Blaiz", "Java", "libwww-perl", "Python", "OutfoxBot", "User-Agent", "PycURL", "AlphaServer", "T8Abot", "Syntryx", "WinHttp", "WebBandit", "nicebot", "Teoma", "alexa", "froogle", "inktomi", "looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory", "Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot", "crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz");
foreach ($bots as $bot)
if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false)
return true;
if (empty($_SERVER['HTTP_USER_AGENT']) || $_SERVER['HTTP_USER_AGENT'] == " ")
return true;
return false;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
if (isBot() !== false)
$error_msg[] = "No bots please! UA reported as: ".$_SERVER['HTTP_USER_AGENT'];
// lets check a few things - not enough to trigger an error on their own, but worth assigning a spam score..
// score quickly adds up therefore allowing genuine users with 'accidental' score through but cutting out real spam :)
$points = (int)0;
$badwords = array("link=", "content-type", "bcc:", "cc:", "document.cookie", "onclick", "onload",);
foreach ($badwords as $word)
if (
strpos(strtolower($_POST['comments']), $word) !== false ||
strpos(strtolower($_POST['name']), $word) !== false
)
$points += 2;
if (strpos($_POST['comments'], "http://") !== false || strpos($_POST['comments'], "www.") !== false)
$points += 2;
if (isset($_POST['nojs']))
$points += 1;
if (preg_match("/(<.*>)/i", $_POST['comments']))
$points += 2;
if (strlen($_POST['name']) < 3)
$points += 1;
if (strlen($_POST['comments']) < 15 || strlen($_POST['comments'] > 1500))
$points += 2;
if (preg_match("/[bcdfghjklmnpqrstvwxyz]{7,}/i", $_POST['comments']))
$points += 1;
// end score assignments
foreach($requiredFields as $field) {
trim($_POST[$field]);
if (!isset($_POST[$field]) || empty($_POST[$field]) && array_pop($error_msg) != "Please fill in all the required fields and submit again.\r\n")
$error_msg[] = "Please fill in all the required fields and submit again.";
}
if (!empty($_POST['name']) && !preg_match("/^[a-zA-Z-'\s]*$/", stripslashes($_POST['name'])))
$error_msg[] = "The name field must not contain special characters.\r\n";
if (!empty($_POST['email']) && !preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i', strtolower($_POST['email'])))
$error_msg[] = "That is not a valid e-mail address.\r\n";
// if (!empty($_POST['url']) && !preg_match('/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i', $_POST['url']))
// $error_msg[] = "Invalid website url.\r\n";
if ($error_msg == NULL && $points <= $maxPoints) {
$subject = "Automatic Form Email";
$message = "You received this e-mail message through your website: \n\n";
foreach ($_POST as $key => $val) {
if (is_array($val)) {
foreach ($val as $subval) {
$message .= ucwords($key) . ": " . clean($subval) . "\r\n";
}
} else {
$message .= ucwords($key) . ": " . clean($val) . "\r\n";
}
}
$message .= "\r\n";
$message .= 'IP: '.$_SERVER['REMOTE_ADDR']."\r\n";
$message .= 'Browser: '.$_SERVER['HTTP_USER_AGENT']."\r\n";
$message .= 'Points: '.$points;
if (strstr($_SERVER['SERVER_SOFTWARE'], "Win")) {
$headers = "From: $yourEmail\r\n";
} else {
$headers = "From: $yourWebsite <$yourEmail>\r\n";
}
$headers .= "Reply-To: {$_POST['email']}\r\n";
if (mail($yourEmail,$subject,$message,$headers)) {
if (!empty($thanksPage)) {
header("Location: $thanksPage");
exit;
} else {
$result = 'Your mail was successfully sent.';
$disable = true;
}
} else {
$error_msg[] = 'Your mail could not be sent this time. ['.$points.']';
}
} else {
if (empty($error_msg))
$error_msg[] = 'Your mail looks too much like spam, and could not be sent this time. ['.$points.']';
}
}
function get_data($var) {
if (isset($_POST[$var]))
echo htmlspecialchars($_POST[$var]);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contact | Here | Now</title>
		<link href='http://fonts.googleapis.com/css?family=Baumans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/app.css" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script>
  	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  	ga('create', 'UA-61043394-2', 'auto');
  	ga('send', 'pageview');
	</script>
	</head>
	<body>
		<div class="row logo">
		<div id="visible">

        <div class="flatten circle-logo">
          <center><p>dp</p></center>
        </div>

      <div id="hidden" class="small-6 small-centered medium-9 medium-centered large-12 large-centered columns">
        <ul class="button-group even-3 sans">
          <li><a href="projects.html" class="small button secondary">Projects</a></li>
          <li><a href="resume.html" class="small button secondary">Resume</a></li>
          <li><a href="contact.html" class="small button secondary">Contact</a></li>
        </ul>
      </div>

      </div>
			<div class="small-6 small-centered columns">

				<div class="panel">
					<form action="" method="post">
					<div class="row">
					<div class="large-6 columns">
						<label for="name">Name
							<input type="text" name="name" id="name" value="<?php get_data("name"); ?>" maxlength="30" placeholder="Jane Doe" />
						</label>
					</div>
					<div class="large-6 columns">
						<label for="email">Email
							<input type="text" name="email" id="email" value="<?php get_data("email"); ?>" placeholder="you@somethin.com" />
						</label>
					</div>
					</div>
					<div class="row">
					<div class="large-12 columns">
						<label for="comments">Say hi!
							<textarea name="comments" id="comments" maxlength="2000" placeholder="Hello!"><?php get_data("comments"); ?></textarea>
						</label>
					</div>
					</div>
					<input type="submit" name="submit" id="submit" value="Send" <?php if (isset($disable) && $disable === true) echo ' disabled="disabled"'; ?> />
					</form>
				</div>

			</div>
		</div>
	</body>
</html>