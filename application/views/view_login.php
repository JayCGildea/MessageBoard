<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

	<!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>

<!-- Bootstrap navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">JG527</a>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
	  <!-- If logged in display tabs and logout page, else display login -->
		<?php if($this->session->userdata("username")) echo '
			<li><a href="'.site_url("user/view/").$this->session->userdata("username").'">My Posts</a></li>
			<li><a href="'.site_url("user/feed/").$this->session->userdata("username").'">My Feed</a></li>
			<li><a href="'.site_url("message").'">Post</a></li>
			<li><a href="'.site_url("user/logout").'">Logout</a></li>';
		 else echo '<li class="active"><a href="'.site_url("user/login").'">Login <span class="sr-only">(current)</span></a></li>';
		?>
      </ul>
	  <!-- Extra search bar -->
      <form class="navbar-form navbar-left" action="<?php site_url("search/dosearch"); ?>" method="get">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="query" id="query">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</nav>


<div class="container">
	<div class="card card-container"> <!-- Create form linking to User controller, dologin method via post -->
        <form class="form-signin" action="<?php echo site_url("User/dologin");?>" method="post">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
            <br>
			<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <br>
			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form>
		<!--If already attempted display error -->
		<?php if(isset($attempted)) echo '<br> 
			<div class="alert alert-danger">
				<strong>Invalid Details</strong> 	Please try again
			</div>'; 
		?>
    </div>
</div>


</body>
</html>