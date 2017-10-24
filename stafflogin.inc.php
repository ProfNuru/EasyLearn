<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Staff Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<style>
		body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}

		.form-signin {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signin .form-signin-heading,
		.form-signin .checkbox {
		  margin-bottom: 10px;
		}
		.form-signin .checkbox {
		  font-weight: normal;
		}
		.form-signin .form-control {
		  position: relative;
		  height: auto;
		  -webkit-box-sizing: border-box;
				  box-sizing: border-box;
		  padding: 10px;
		  font-size: 16px;
		}
		.form-signin .form-control:focus {
		  z-index: 2;
		}
		.form-signin input[type="email"] {
		  margin-bottom: -1px;
		  border-bottom-right-radius: 0;
		  border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<form class="form-signin AVAST_PAM_loginform" action="stafflogin.php" method="POST">
			<h2 class="form-signin-heading">Please sign in</h2>
			<p><label for="username" class="sr-only">Username: </label>
			<input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus="" /></p>
			<p><label for="password" class="sr-only">Password: </label>
			<input type="password" name="password" class="form-control" placeholder="Password" required=""/></p>
			<input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login" />
		</form>
	</div>
</body>
</html>