<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>DBS-Login</title>
	<!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- local files -->
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1 class="Pgtitle">Digital Banking System</h1>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form method="POST" action="users.php">
				<h1>Create Account</h1>
				<div class="social-container">
					<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
					<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<span>or use other accounts</span>
				<select id="usertype" name="usertype" class="custom-select form-control border-0" required="">
					<option selected>User Type</option>
					<option value="Employee">Employee</option>
					<option value="Client">Client</option>
				</select>
				<input id="un" name="name" type="text" placeholder="Name" maxlength="9"  onkeyup="nospaces(this)" required="" />
				<input id="em" name="mail" type="email" placeholder="Email" required="" />
				<input id="pwd" name="pass" type="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" onkeyup="nospaces(this)" required="" />
				<button id="btn1" name="reg">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form method="POST" action="login.php">
				<h1>Log in</h1>
				<div class="social-container">
					<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
					<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<span>or login with</span>
				<input id="mail" name="umail" type="email" placeholder="Email" required="" />
				<input id="pswd" name="upass" type="password" placeholder="Password" required="" />
				<a href="#" class="forgot">Forgot password?</a>
				<button id="btn2" name="login">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal details</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Enter your personal details and start journey with us</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
	<footer>
		All Rights Reserved. Copyright &copy; 2020
	</footer>
	<script type="text/javascript">
		const Signup = document.getElementById('signUp');
		const Signin = document.getElementById('signIn');
		const container = document.getElementById('container');

		Signup.addEventListener('click', () => container.classList.add('right-panel-active') );
		Signin.addEventListener('click', () => container.classList.remove('right-panel-active') );

		//no space in input
		function nospaces(t){
			if(t.value.match(/\s/g)){
				t.value=t.value.replace(/\s/g,'');
			}
		}
	</script>
</body>
</html>