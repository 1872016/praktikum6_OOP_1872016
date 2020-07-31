<?php
	session_start();
	include_once 'dao/FacultyDaoImpl.php';
	include_once 'dao/ActivityDaoImpl.php';
	include_once 'entity/Faculty.php';
	include_once 'entity/Activity.php';
	include_once 'util/PDOUtil.php';
	include_once 'util/db_util.php';
	include_once 'db_function/faculty_function.php';
	include_once 'db_function/user_function.php';
	include_once 'db_function/activity_function.php';
	if (!isset($_SESSION['my_session'])) {
		$_SESSION['my_session'] = false;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Praktikum PWL2</title>

	<!-- Data Tables -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
		<script type="text/javascript">
			$(document).ready( function () {
	    		$('#myTable').DataTable();
			} );
		</script>

	<!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

	<!--Javascript-->
	<script src="scripts/command_script.js"></script>

</head>
<body>
	<div class="container">
		<?php
			if ($_SESSION['my_session']) {
		?>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">PW2 FIT</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="?menu=fac">Faculty</a></li>
					<li><a href="?menu=act">Activity Management</a></li>
					<li><a href="?menu=logout">Logout</a></li>
				</ul>
			</div>
		</nav>
		<div>
			<?php
				$menu = filter_input(INPUT_GET, "menu");
				switch ($menu) {
					case 'fac':
						include_once 'pages/faculty_page.php';
						break;
					
					case 'act':
						include_once 'pages/activity_page.php';
						break;

					case 'facu':
						include_once 'pages/faculty_update_page.php';
						break;

					case 'actu':
						include_once 'pages/activity_update_page.php';
						break;

					case 'logout':
						session_unset();
						session_destroy();
						header('location:index.php');
						break;

					default:
						include_once 'pages/home.php';
						break;
				}
			?>
		</div>
		<?php
			} else {
				include_once 'pages/login_page.php';
			}
		?>
	</div>
</body>
</html>