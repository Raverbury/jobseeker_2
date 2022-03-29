<div class="container">
	<h1 class="py-2">Log in to your account</h1>
	<?php
		if (isset($message)) {
			echo '<div class="alert alert-danger">' . $message . '</div>';
		}
	?>
	<p>Please provide a username and a password.</p>
	<p>Don't have an account? Register one <a href='register'>here</a>.</p>
	<form class="bg-light p-2" action="login" method="post">
    <div class="m-1 form-group">
      <label for="username">Username:</label>
      <input type="text" id="username" class="form-control" name="username">
    </div>
		<div class="m-1 form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" class="form-control" name="password">
    </div>
    <input class="btn btn-primary m-1" type="submit">
    </form><br>
	Tip: <i>probably should not leave any empty field, well, empty.</i>
</div>