<?php
/*	Program	: staffdashboard.php
**	Desc	: Teachers' personal homepage for editing profile and courses.
*/
if((!isset($_SESSION['level'])) || ($_SESSION['level'] !== 2) || (!isset($_SESSION['staff_id']))){
	header("Location: index.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Staff Page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
		body{
			padding-top: 50px;
		}
		.sidebar{
			  position: fixed;
			  top: 51px;
			  bottom: 0;
			  left: 0;
			  z-index: 1000;
			  padding: 20px;
			  overflow-x: hidden;
			  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
			  border-right: 1px solid #eee;
		}
		.sidebar .nav {
		  margin-bottom: 20px;
		}

		.sidebar .nav-item {
		  width: 100%;
		}

		.sidebar .nav-item + .nav-item {
		  margin-left: 0;
		}

		.sidebar .nav-link {
		  border-radius: 0;
		}
		.placeholders {
		  padding-bottom: 3rem;
		}

		.placeholder img {
		  padding-top: 1.5rem;
		  padding-bottom: 1.5rem;
		}
	</style>
  </head>

  <body>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">EasyLearn</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Orientation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
         <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <h3>Welcome, Teacher</h3>
            </li>
          </ul>
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link profile" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link profile" href="index.php?q=1">Edit Profile<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link new" href="index.php?q=2">Create New Course</a>
            </li>
            <li class="nav-item">
              <a class="nav-link add" href="index.php?q=3">Add Classes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link remove" href="index.php?q=4">Remove Course</a>
            </li>
          </ul>
		</nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <?php
			if(isset($_GET['q'])){
				if($_GET['q'] == 1){
					include("editprofile.inc");
				}elseif($_GET['q'] == 2){
					include("addcourse.inc");
				}elseif($_GET['q'] == 3){
					include("editcourse.inc");
				}elseif($_GET['q'] == 4){
					include("delcourse.inc");
				}elseif($_GET['q'] == 5){
					include("changephoto.inc");
				}elseif($_GET['q'] == 6){
					include("changepwd.inc");
				}
			}elseif(!(isset($_GET['q']))){
				include("misc.inc");?>
		<section class='row text-center placeholders'>
			<?php
				$courses = [];
				$query = "SELECT * FROM courses WHERE staff_id = '{$_SESSION['staff_id']}'";
				$results = mysqli_query($cxn, $query);
				while($row = mysqli_fetch_assoc($results)){
					extract($row);
					$courses[] = $course_title;
				}
				foreach($courses as $cse){
					$course = ucfirst($cse);
					echo "<div class='col-6 col-sm-3 placeholder'>
					  <img src='img/teachLearn.jpg' class='img-fluid rounded-circle' alt='Generic placeholder thumbnail' width='200' height='200'>
					  <h4>$course</h4>
					  <div class='text-muted'><a href='index.php?course=$cse'>Edit</a></div>
					</div>";
				}
			}
			if(isset($_GET['course']) and isset($_GET['id']) and isset($_GET['q'])){
				include("misc.inc");
				if($_GET['q'] === 'delete'){
					$table = $_GET['course'];
					$id = $_GET['id'];
					$query = "DELETE FROM $table WHERE topic_id = $id";
					$result = mysqli_query($cxn,$query);
					if($result){
						header("Location: index.php?course=$table");
						exit();
					}else{
						echo "Deletion failed!<br/>";
						echo "<a href='index.php?course=$table'>Back</a>";
					}
				}elseif($_GET['q'] === 'edit'){
					$table = $_GET['course'];
					$id = $_GET['id'];
					include("edit_topic.php");
				}
			}elseif(isset($_GET['course'])){
				$table = $_GET['course'];
				echo "<div class='table-responsive'>
						<h2>".ucfirst($table)." Content</h2>
						<table class='table table-striped'>
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Title</th>
							  <th>Description</th>
							  <th>Video</th>
							  <th>File</th>
							</tr>
						  </thead>
						  <tbody>";
				$query = "SELECT * FROM $table";
				$results = mysqli_query($cxn, $query) or die("Sorry, an error Occurred!");
				while($row = mysqli_fetch_assoc($results)){
					extract($row);
					echo "<tr>
							  <td>$topic_id</td>
							  <td>$topic_title</td>
							  <td>$topic_desc</td>
							  <td><a href='$video_url'>Video</a></td>
							  <td><a href='$file_url'>Document</a></td>
							  <td><a href='index.php?course=$table&id=$topic_id&q=delete'>Delete</a></td>
							  <td><a  href='index.php?course=$table&id=$topic_id&q=edit'>Edit</a></td>
							</tr>";
				}
			}
			?>  
				</tbody>
						</table>
					  </div> 
			</section>
		</main>
	  </div>
	</div>       
          
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
		
	</script>
</body></html>