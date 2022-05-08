<div class="container">
	<h1 class="py-2">Log in to your account</h1>
	<p>Please provide a username and a password.</p>
	<p>Don't have an account? Register one <a href='register'>here</a>.</p>
	<form name="loginForm" class="bg-light p-2" onsubmit="return validateForm()" action="login" method="post">
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

<script>
	function validateForm() {
		let usn = document.forms["loginForm"]["username"].value;
		let psw = document.forms["loginForm"]["password"].value;
    if (usn.length <= 0) {
			alert("Username cannot be empty.");
			return false;
		}
		if (psw.length <= 0) {
			alert("Password cannot be empty.");
			return false;
		}
		return true;
	}
</script>