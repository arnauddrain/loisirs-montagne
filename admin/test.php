<?php 
	include("../cnx.php");
	include("../functions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		$d = new DateTime(date("Y-m-d"));
		echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
		echo draw_calendar($d->format('m'),$d->format('Y'));

		$d->modify( 'first day of next month' );
		echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
		echo draw_calendar($d->format('m'),$d->format('Y'));
	 ?>
</body>
</html>