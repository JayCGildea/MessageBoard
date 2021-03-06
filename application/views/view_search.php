<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>

<!-- Bootstrap navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">JG527</a>
    </div>
	<!-- If logged in display tabs and logout page, else display login -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
		<?php if($this->session->userdata("username")) echo '
			<li><a href="'.site_url("user/view/").$this->session->userdata("username").'">My Posts</a></li>
			<li><a href="'.site_url("user/feed/").$this->session->userdata("username").'">My Feed</a></li>
			<li><a href="'.site_url("message").'">Post</a></li>
			<li><a href="'.site_url("user/logout").'">Logout</a></li>';
		 else echo '<li class="active"><a href="'.site_url("user/login").'">Login <span class="sr-only">(current)</span></a></li>';
		?>
      </ul>
	  
      <form class="navbar-form navbar-left" action="<?php echo site_url("search/dosearch");?>" method="get">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="query" id="query">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</nav>

<body>
	<div> <!-- Create form linking to search/dosearch via get -->
		<form action="<?php echo site_url("search/dosearch");?>" method="get">
			<input type="text" name="query" id="query" size="40" value="">
			<input type="submit" value="Search">
		</form> 
	</div> 
</body>
</html>