<?php include('functions.php');
$db = getConnection();
 ?>
 
<!DOCTYPE html>
<html lang="en">
		<head>
				<meta charset="utf-8">
				<title>Manager Portal</title>
				<link rel="stylesheet" href="CSS/login.css">
		</head>
		<body>	
				<!-- Form displaying input for email and password. On form submit direct to authenticate.php -->
				<form action="authenticate.php" method="post" class="container">
						<h1>Welcome to the Booklist System!</h1>
						<h2>Please log in with your Email and Password</h2>
						
						<label for="email"><b>Email</b></label>
						<input type="text" placeholder="Enter Email" id ="email" name="email" required>
						
						<label for="password"><b>Password</b></label>
						<input type="password" placeholder="Enter Password" id = "password" name="password" required>

						<button type="submit" class="btn" name="login">Login</button>
				</form>
		
		
		<footer>
				<!-- generic sitewide footer -->
				<div class="footer">
						<h3>Ben Rowell - 19032995</h3>
						<h4> KV6034 - Web Assignment</h4>
				</div>
				
		</footer>
		</body>
</html>
