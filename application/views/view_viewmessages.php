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
	  <!-- Extra Search bar -->
      <form class="navbar-form navbar-left" action="<?php echo site_url("search/dosearch");?>" method="get">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="query" id="query">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</nav>


<div class="container-fluid">
	<!-- Display each post -->
    <?php foreach($posts as $post){?>
		<div class="container-fluid panel panel-success"><br>
			<div class="panel-heading">
				<h3 class="panel-title"><?php 
				$username = $post->user_username;
				echo $username.' '. $post->posted_at;
				// If not following display follow button
				if(isset($following) && !$following && $username != $this->session->userdata("username"))
					echo '<button id="followButton" class="pull-right btn btn-primary btn-xs">Follow</button>';
							?>
				</h3>
			</div>
			<div class="well well-sm">
				<?php echo $post->text;?>
			</div>
		</div>
    <?php }?>  
</div>

<!-- On follow button click run follow method in User controller -->
<script type="text/javascript">
	document.getElementById("followButton").onclick = function() {
		location.href = "<?php echo site_url("User/follow/").$username;?>";
	};
</script>

</body>
</html>