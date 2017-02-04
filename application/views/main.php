<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>

	<h3>Register</h3>
	<form action="/main/register" method="post">
		<!-- <input type="hidden" name="action" value="register"> -->
		<label>Name:</label><br>
		<input type='text' name='name'><br>
		<label>Alias:</label><br>
		<input type='text' name='alias'><br>
		<label>Email:</label><br>
		<input type='text' name='email'><br>
		<label>Password:</label><br>
		<input type='password' name='password'><br>
		<p>*Password should be at least 8 characters</p>
		<label>Confirm PW:</label><br>
		<input type='password' name='password_confirm'><br>
		<label>Date of Birth</label><br>
		<input type='string' name='dob' placeholder="yyyy-mm-dd"><br>
		<input type='submit' value="Register"><br>
	</form>
	<?php 
	  if($this->session->flashdata("register_message")) 
	  {
	    echo $this->session->flashdata("register_message");
	  }
	?>

	<h3>Login</h3>
	<form action="/main/login" method="post">
		<label>Email</label><br>
		<input type='text' name="email"><br>
		<label>Password</label><br>
		<input type="password" name="password"><br>
		<input type="submit" value="Login"><br>
	</form>

	<?php 
	  if($this->session->flashdata("login_message")) 
	  {
	    echo $this->session->flashdata("login_message");
	  }
	?>
</body>
</html>