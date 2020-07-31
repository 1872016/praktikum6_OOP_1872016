<?php
	$signInPressed = filter_input(INPUT_POST, 'btnSignIn');
	if ($signInPressed) {
		$username = filter_input(INPUT_POST, 'txtUsername');
		$password = filter_input(INPUT_POST, 'txtPassword');
		$md5Password = md5($password);
		$result = login($username, $md5Password);
		if ($result != null && $result['username'] == $username) {
			$_SESSION['my_session'] = true;
			$_SESSION['session_user'] = $result['name'];
			header("location:index.php");
		} else {
			echo '<div class="bg-error">Invalid username or password</div>';
		}
	}
?>
<form method="post" class="form-sign-in">
	<h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
	<label for="txtUsername" class="sr-only">Username</label>
	<input type="text" name="txtUsername" id="txtUsername" autofocus required placeholder="Username" class="form-control">
	<label for="txtPassword" class="sr-only">Password</label>
	<input type="Password" name="txtPassword" id="txtPassword" required placeholder="Password" class="form-control">
	<input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign In" name="btnSignIn">
</form>