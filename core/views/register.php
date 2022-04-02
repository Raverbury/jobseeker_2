<div class="container">
	<h1 class="py-2">Register an account</h1>
	<?php
	if (isset($message)) {
		echo '<div class="alert alert-danger">' . $message . '</div>';
	}
	?>
	<p>Please provide a username, a password and select your role.</p>
	<p>Already have an account? Login <a href='login'>here</a>.</p>
	<form class="bg-light p-2" action="register" method="post">
		<div class="m-1 form-group">
			<label for="username">Username:</label>
			<input type="text" id="username" class="form-control" name="username">
		</div>
		<div class="m-1 form-group">
			<label for="password">Password:</label>
			<input type="password" id="password" class="form-control" name="password">
		</div>
		<div class="m-1 form-group">
			<label for="retypePassword">Retype your password:</label>
			<input type="password" id="retypePassword" class="form-control" name="retypePassword">
		</div>
		<div class="m-1 form-group">
			<label for="role">Role:</label>
			<select id="role" class="form-select" name="role">
				<option value="candidate">Candidate</option>
				<option value="employer">Employer</option>
			</select>
		</div>
		<input class="btn btn-primary m-1" type="submit">
	</form><br>
	Tip: <i>gamer tag makes for a great username, no it doesn't.</i>
</div>