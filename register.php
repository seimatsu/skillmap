<?php
session_start();
require('dbconnect.php');

$recordSkill= mysql_query('SELECT * FROM skill');
$recordDesign = mysql_query('SELECT * FROM design_skill');

if(!empty($_POST)){
if($_POST['name'] == '') {
$error['name'] = 'blank';
}
if($_POST['mail'] == '') {
$error['mail'] = 'blank';
}
if(strlen($_POST['password']) < 4 ) {
$error['password'] = 'length';
}
if($_POST['password'] == '') {
$error['password'] = 'blank';
}

$fileName = $_FILES['image']['name'];
if (!empty($fileName)) {
	$ext = substr($fileName, -3);
	if ($ext != 'jpg' && $ext != 'gif') {
	$error['image'] = 'type';
	}
}


if (empty($error)) {
$image = date('YmdHis') . $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);

$_SESSION['join'] = $_POST;
$_SESSION['join']['image'] = $image;
header('Location: check.php');
}
}



?>

<html>
<head></head>
<body>
<p>Fullfil the form</p>
<?php print_r($error); ?>

<form action"" method="post" enctype="multipart/form-data">
<dl>
<dt>User ID</dt>
<dd><input type="text" name="name" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'); ?>" />
<?php if ($error['name'] == 'blank'): ?>
<p>Input your user ID</p>
<?php endif; ?>
</dd>
<dt>E-mail</dt>
<dd><input type="text" name="mail" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8'); ?>" />
<?php if ($error['mail'] == 'blank'): ?>
<p>Input your e-mail address</p><?php endif; ?></dd>

<dt>Password</dt>
<dd><input type="password" name="password" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); ?>"/>

<?php if ($error['password'] == 'blank'): ?>
<p>Input your password more than 4 characters</p><?php endif; ?></dd>

<?php if ($error['password'] == 'length'): ?>
<p>Password requires more than 4 characters</p>
<?php endif; ?></dd>


<dt>Image</dt>
<dd><input type="file" name="image" size="35" />
<?php if ($erro['image'] == 'type'): ?>
<p>Uploade only ".gif" or ".jpg" files</p>
<?php endif; ?>
<?php if (!empty($error)): ?>
<p>Uploade image file</p>
<?php endif; ?>
</dd>

<dt>
Programing Skills
</dt>
<dd>
<?php

while($data = mysql_fetch_assoc($recordSkill)) {
	$skills[$data['skill_id']] = $data['skill_name'];
}

foreach ($skills as $key => $val) {
	echo ('<input name="skills[' . $key . ']" type="checkbox" id="' . $key . '" value="' . $val . '" />
	<label for="' . $key . '">' . $val . '</label> ');
}


?>


<dt>
Design Skills
</dt>
<dd>
<?php

while($data = mysql_fetch_assoc($recordDesign)) {
	$designskills[$data['id']] = $data['design_skillname'];
}

foreach ($designskills as $key => $val) {
	echo ('<input name="designskills[' . $key . ']" type="checkbox" id="' . $key . '" value="' . $val . '" />
	<label for="' . $key . '">' . $val . '</label> ');
}


?>
</dd>

<dt>Message</dt>
<dt><input type="text" name="message" size="120" maxlength="1260" value="<?php echo htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'); ?>" />
</dd>

</dl>
<div><input type="submit" value="submit" /></div>
</form>


<?php print_r($_SESSION['join']); ?>

</body>
<html>