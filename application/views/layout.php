<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>
	<?php
	   $user = is_logged_in();
	   if ($user['status'] == 1) {
	   echo $user['email'];
	?>
	<a href="<?php echo site_url('logout'); ?>">Logout</a>
   <?php 
     } else {
   ?>
   	<a href="<?php echo site_url('register'); ?>">Register</a> | 
   	<a href="<?php echo site_url('register'); ?>">Login</a>
   <?php 
     }
   ?>

	<div id="container">
		<?php echo $content; ?>
	</div>
</body>
</html>