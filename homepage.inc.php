<?php
/*	Program	: homepage.inc.php
**	Desc	: Displays the home page of the website. Shows freely available courses. Allows users to sign up and sign in to teach or to learn. 
*/
?>
<!DOCTYPE html>
<html lang="en"><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Online WASSCE Video Remedials and Professional Video Course Library">
    <meta name="author" content="Nurudeen Abdul-Karim, Tamale, Ghana">
    <link rel="icon" href="https://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Study Now at Your Own Pace</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
		body{
			  padding-top: 50px;
			}
		footer{
			  padding: 30px 0;
			}

		.free-vids{
			width: 90%;
			margin: 50px auto;
		}	
	</style>
		
  </head>

  <body>

   	<!-- Begin Navigation Bar -->
    <nav class="navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">EasyLearn</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Sign Up</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Teacher</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="stafflogin.php">Teacher Page</a>
              <a class="dropdown-item" href="staffregister.php">Become a Teacher</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" placeholder="Search" type="text">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <!-- End Navigation Bar -->
    
    <!-- Begin Jumbotron -->
    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">Classes Taught By Experienced Teachers</h1>
        <p class="lead text-muted">For your exams. For your career. For your passions.</p>
        <p>
          <a href="#" class="btn btn-primary">Sign Up For Free</a>
        </p>
      </div>
    </section>
    <!-- End Jumbotron -->
    
    <!-- Begin Container -->
    <div class="container text-center">
    	<h2>Unlimited Access to Free Featured Courses</h2>
    	<div class="row free-vids">
			<div class="col-6 col-md-3">
				<h3>Video Title</h3>
				<h6>Video sub-title</h6>
			</div>
			<div class="col-6 col-md-3">
				<h3>Video Title</h3>
				<h6>Video sub-title</h6>
			</div>
			<div class="col-6 col-md-3">
				<h3>Video Title</h3>
				<h6>Video sub-title</h6>
			</div>
			<div class="col-6 col-md-3">
				<h3>Video Title</h3>
				<h6>Video sub-title</h6>
			</div>
    	</div>
    	
    	<div class="row free-vids">
			<div class="col-6 col-md-3">
				<h3>Video Title</h3>
				<h6>Video sub-title</h6>
			</div>
			<div class="col-6 col-md-3">
				<h3>Video Title</h3>
				<h6>Video sub-title</h6>
			</div>
			<div class="col-6 col-md-3">
				<h3>Video Title</h3>
				<h6>Video sub-title</h6>
			</div>
			<div class="col-6 col-md-3">
				<h3>Video Title</h3>
				<h6>Video sub-title</h6>
			</div>
    	</div>
    </div>
    <!-- End Container -->
    
    <!-- Begin Headings -->
    <div class="container">
    	<div class="row">
            <div class="col-12 col-md-4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce
 dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut 
fermentum massa justo sit amet risus. Etiam porta sem malesuada magna 
mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
            </div><!--/span-->
            <div class="col-12 col-md-4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce
 dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut 
fermentum massa justo sit amet risus. Etiam porta sem malesuada magna 
mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
            </div><!--/span-->
            <div class="col-12 col-md-4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce
 dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut 
fermentum massa justo sit amet risus. Etiam porta sem malesuada magna 
mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
            </div><!--/span-->
		</div>
 	</div>
   <!-- End Headings -->
    
   <!-- Begin Jumbotron -->
    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">Teach on EasyLearn</h1>
        <p class="lead text-muted">Earn money. Share your expertise. Build your personal brand.</p>
        <p>
          <a href="#" class="btn btn-primary">Learn More</a>
        </p>
      </div>
    </section>
    <!-- End Jumbotron -->
    
    <!-- Begin FOOTER -->
	<div class="container-fluid">
		<footer>
			<p class="float-right"><a href="#">Back to top</a></p>
			<p>© 2017 EasyLearn, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
	  </footer>
	</div> 
	<!-- End FOOTER -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>