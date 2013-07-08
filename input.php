<?php
require('dbconnect.php');
$recordSkill= mysql_query('SELECT * FROM skill');

?>

<html>
<head></head>
<body>

<p>Input your name, gender(m or f) and skills.</p>
<form id="frmInput" name="frmInput" method="post" action="input_do.php">
<dl><dt>
<label for="name">Name</label>
</dt><dd>
<input name="name" type="text" id="name" size="20" maxlength="20" />
</dd>
<dt>
<label for="gender">Gender</label>
</dt>
<dd>
<input name="gender" type="text" id="gender" size="10" maxlength="1" />
</dd>

<dt>
Available Skills
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

</dl>
<input type="submit" value="Submit" />
</form>


</body>
</html>