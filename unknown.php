<?php
require('dbconnect.php');
session_start();

	
$page = $_REQUEST['page'];
if ($page == '') {
	$page = 1;
}
$page = max($page, 1);

$sql = 'SELECT COUNT(*) AS cnt FROM skillmap';
$recordSet = mysql_query($sql);
$table = mysql_fetch_assoc($recordSet);
$maxPage = ceil($table['cnt'] / 5);
$page = min($page, $maxPage);

$start = ($page - 1) * 5;
$recordSet = mysql_query('SELECT * FROM skillmap ORDER BY name LIMIT ' . $start . ',5');

?>

<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<title>Pathcreate Members Skill Map</title>
<body>

<div id="container">
<h1>Pathcreate Members Skill Map</h1>

<div id="usermenu">
<p>
<a href="login.php">Login</a></p>
<p>
<a href="register.php">Registration</a></p>
</div>

<div id="contents">
<table border="1">
<tr>
<th>Name</th>
<th>Image</th>
<th>Engineer Skills</th>
<th>Design Skills</th>
<th>Message</th>

</tr>

<?php
while($table = mysql_fetch_assoc($recordSet)) {
?>

	<tr>
	<td><?php echo(htmlspecialchars($table['name'])); ?></td>
	<td><img src="../member_picture/<?php echo(htmlspecialchars($table['image'])); ?>" width="150" height="150" /></td>
	<td><?php echo(htmlspecialchars($table['skill_name'])); ?></td>
	<td><?php echo(htmlspecialchars($table['design_skills'])); ?></td>
	<td><?php echo(htmlspecialchars($table['message'])); ?></td>
	

	</tr>
	
<?php
}
?>

</table>
<div id="pager">
<?php
if ($page > 1) {
?>
<a href="index.php?page=<?php echo($page - 1); ?>">Previous Page</a><br /><br />
<?php
} else {
?>
<p>Previous Page</p>
<?php
}
if ($page < $maxPage) {
?>
<a href="index.php?page=<?php print($page + 1); ?>">Next Page</a><br /><br />
<?php
} else {
?>
<p>Next Page</p>
<?php
}
?>
</div>
</div>
</div>
</body>
</html>