<?php
require('dbconnect.php');
session_start();

//if ($_COOKIE['mail'] != '') {
//	$_POST['mail'] = $_COOKIE['mail'];
//	$_POST['password'] = $_COOKIE['password'];
//	$_POST['save'] = 'on';
//}
	
	if (!empty($_POST)) {

	if($_POST['mail'] != '' && $_POST['password'] != '') {
		$sql = sprintf('SELECT * FROM skillmap WHERE mail="%s" AND password="%s"',
		mysql_real_escape_string($_POST['mail']),
		sha1(mysql_real_escape_string($_POST['password']))
		);
		$record = mysql_query($sql) or die(mysql_error());
		
		if ($table = mysql_fetch_assoc($record)) {
		$_SESSION['id'] = $table['id'];
		$_SESSION['time'] = time();
		
		if ($_POST['save'] = 'on') {
		setcookie('mail', $_POST['mail'], time()+60*60*24*14);
		setcookie('password', $_POST['password'], time()+60*60*24*14);
		}
		header('Location: index.php');
		} else { 
			$error['login'] = 'failed';
			}
	} else {
		$error['login'] = 'blank';
		}
}
?>
		
<html>
<head></head>
<body>
<p>Fullfil the form</p>


<form action="" method="post">
<dl>
<dt>E-mail</dt>
<dd><input type="text" name="mail" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8'); ?>" />


<dt>Password</dt>
<dd><input type="password" name="password" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); ?>"/>



<dt>Save login info</dt>
<dd>
<input type="checkbox" id="save" name="save" value="on"><label for="save">Use automatic login</label>
</dd>

</dl>
<div><input type="submit" value="submit" /></div>
</form>




</body>
<html>