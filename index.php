<?php
require('dbconnect.php');
session_start();

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
	$SESSION['time'] = time();
	$userID = $_SESSION['id'];
	$sqlname = 'SELECT name FROM skillmap WHERE id='.$userID.'';
	$recordName = mysql_query($sqlname);
	$userName = mysql_fetch_assoc($recordName);
	} else {
	header('Location: unknown.php');
	}
	
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
<?php print_r($_REQUEST); ?>
<div id="usermenu">
<p>
Hello, <?php print($userName['name']); ?>!</p>
<p>
<a href="update.php?id=<?php print($userID); ?>">Edit your data</a></p>
<p>
<a href="delete.php?id=<?php print($userID); ?>">Delete your data</a></p>
<p>
<a href="logout.php">Logout</a>
</p>

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