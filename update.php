<?php
session_start();
require('dbconnect.php');

$id = $_REQUEST['id'];
$sqlload = sprintf("SELECT * FROM skillmap WHERE id=%d",
	mysql_real_escape_string($id)
);
$recordSet = mysql_query($sqlload);
$data = mysql_fetch_assoc($recordSet);

$recordSkill= mysql_query('SELECT * FROM skill');
$recordDesign = mysql_query('SELECT * FROM design_skill');


if(empty($_POST)){
	$image = htmlspecialchars($data['image']);
	} else {
	if($_POST['name'] == '') {
	$error['name'] = 'blank';
	}
	
	$fileName = $_FILES['image']['name'];
if (empty($fileName)) {
	$image = htmlspecialchars($data['image']); 
	} 
	else {
	$image = $_FILES['image']['name'];
	move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);
	$ext = substr($fileName, -3);
	if ($ext != 'jpg' && $ext != 'gif') {
	$error['image'] = 'type';
	}
	}


if (empty($error)) {


$_SESSION['join'] = $_POST;
$_SESSION['join']['image'] = $image;
header('Location: update_check.php');
} 
}

?>

<html>
<head></head>
<body>
<?php print($image); 
print_r($_POST);
?>


<p>Edit your name, and skills.</p>
<form id="frmInput" name="frmInput" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php print(htmlspecialchars($data['id'], ENT_QUOTES)) ?>" />
<dl><dt>
<label for="name">Name</label>
</dt><dd>
<input name="name" type="text" id="name" size="20" maxlength="20" value="<?php print(htmlspecialchars($data['name'], ENT_QUOTES)); ?>" />
</dd>

<dt>Image</dt>
<img src="../member_picture/<?php echo(htmlspecialchars($data['image'])); ?>" width="150" height="150" />

<dd><input type="file" name="image" size="35" />
<?php if ($erro['image'] == 'type'): ?>
<p>Uploade only ".gif" or ".jpg" files</p>
<?php endif; ?>
<?php if (!empty($error)): ?>
<p>Uploade image file</p>
<?php endif; ?>
</dd>

<p>
Your Skills<br />
<?php echo(htmlspecialchars($data['skill_name'])); ?>
<br />
<?php echo(htmlspecialchars($data['design_skill'])); ?>
</p>

<dt>
New Programing Skills
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


</dd>

<dt>
New Design Skills
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

<dl><dt>
<label for="name">Message</label>
</dt><dd>
<input name="message" type="text" id="message" size="120" maxlength="20" value="<?php print(htmlspecialchars($data['message'], ENT_QUOTES)); ?>" />
</dd>

</dl>
<input type="submit" value="Update" />

</form>


</body>
</html>