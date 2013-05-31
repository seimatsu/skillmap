<?php
session_start();
require('dbconnect.php');

foreach($_SESSION['join']['skills'] as $skills) {
	$skillname = $skills.", $skillname";
}

foreach($_SESSION['join']['designskills'] as $designskills) {
	$designskillname = $designskills.", $designskillname";
}

if (!isset($_SESSION['join'])) {
	header('Location: register.php');
	}

if (!empty($_POST)) {

$sql = sprintf('INSERT INTO skillmap SET name="%s", mail="%s", password="%s", image="%s", 
skill_name="%s", design_skills="%s", message="%s", created="%s"',
	mysql_real_escape_string($_SESSION['join']['name']),
	mysql_real_escape_string($_SESSION['join']['mail']),
	sha1(mysql_real_escape_string($_SESSION['join']['password'])),
	mysql_real_escape_string($_SESSION['join']['image']),
	mysql_real_escape_string($skillname),
	mysql_real_escape_string($designskillname),
	mysql_real_escape_string($_SESSION['join']['message']),
	date('Y-m-d H:i:s')
	);
	
	mysql_query($sql) or die(mysql_error());
	unset($_SESSION['join']);
	
	header('Location: thanks.php');
	}
?>

<html>
<head></head>
<body>
This file is check.php
Test for github practice.

test branch second time

Test for github branch

<form action"" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="submit" />
<dl>
<dt>User ID</dt>
<dd><?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES, 'UTF-8'); ?></dd>
<dt>E-mail</dt>
<dd><?php echo htmlspecialchars($_SESSION['join']['mail'], ENT_QUOTES, 'UTF-8'); ?></dd>
<dt>Password</dt>
<dd>Secret</dd>
<dt>Image</dt>
<dd><img src="../member_picture/<?php echo $_SESSION['join']['image']; ?>" width="150" height="150" alt="icon" /></dd>
</dl>
<dt>Programing Skills</dt>
<dd><?php print $skillname; ?></dd>
<dt>Design Skills</dt>
<dd><?php print $designskillname; ?></dd>
<dt>Message</dt>
<dd><?php echo htmlspecialchars($_SESSION['join']['message'], ENT_QUOTES, 'UTF-8'); ?></dd>
<div><a href="register.php?action=rewrite">&laquo;&nbsp;Rewrite</a>  <input type="submit" value="Register" /></div>
</form>

</body>
<html>