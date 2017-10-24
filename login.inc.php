<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		.wrapper{
			padding-top: 40px;
  			padding-bottom: 40px;
  			background-color: #eee;
		}
		.form-signin{
			max-width: 330px;
  			padding: 15px;
  			margin: 0 auto;
		}
		.form-signin .form-signin-heading,
		.form-signin{
			margin-bottom: 10px;
		}
		.form-signin{
			font-weight: normal;
		}
		.form-signin .form-control{
			position: relative;
			height: auto;
			-webkit-box-sizing: border-box;
					  box-sizing: border-box;
			padding: 10px;
			font-size: 16px;
		}
		.form-signin .form-control:focus{
			z-index: 2;
		}
		.form-signin input[type="email"]{
			margin-bottom: -1px;
  			border-bottom-right-radius: 0;
  			border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"]{
			margin-bottom: 10px;
  			border-bottom-right-radius: 0;
  			border-bottom-left-radius: 0;
		}
	</style>
</head>
<body>
	<div class="container wrapper">
		<form action="login.php" method="POST" class="form-signin AVAST_PAM_loginform">
			<h2 class="form-signin-heading">Please sign in</h2>
			<label for="email" class="sr-only">E-mail: </label>
			<input type="text" name="email" class="form-control" placeholder="Email address" required="" autofocus="" type="email" />
			<label for="password" class="sr-only">Password: </label>
			<input type="password" name="password"  class="form-control" placeholder="Password" required="" type="password"/>
			<input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Sign in" />
		</form>
	</div>
</body>
</html>