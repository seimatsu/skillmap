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
	header('Location: update.php');
	}

if (!empty($_POST)) {


$userID = $_SESSION['id'];
$sql = sprintf('UPDATE skillmap SET name="%s", image="%s", skill_name="%s", design_skills="%s", message="%s", created="%s" WHERE id='.$userID.'',
	mysql_real_escape_string($_SESSION['join']['name']),
	mysql_real_escape_string($_SESSION['join']['image']),
	mysql_real_escape_string($skillname),
	mysql_real_escape_string($designskillname),
	mysql_real_escape_string($_SESSION['join']['message']),
	date('Y-m-d H:i:s')
	);

	mysql_query($sql) or die(mysql_error());
	unset($_SESSION['join']);
	header('Location: update_thanks.php');
	}
?>

<html>
<head></head>
<body>
<?php print_r($_SESSION['join']); ?>

<form action"" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="submit" />
<dl>
<dt>User ID</dt>
<dd><?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES, 'UTF-8'); ?></dd>
<dt>Image</dt>
<dd><img src="../member_picture/<?php echo $_SESSION['join']['image']; ?>" width="150" height="150" alt="icon" /></dd>
</dl>
<dt>Available Skills</dt>
<dd><?php print $skillname; ?></dd>

<div><a href="update.php?action=rewrite">&laquo;&nbsp;Rewrite</a>  <input type="submit" value="Register" /></div>
</form>

</body>
<html>