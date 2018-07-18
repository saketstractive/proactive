<!DOCTYPE html>
<html>
<head>
	<title>Pratham Professional Academy</title>
</head>
<body>
		<?php 

				$cookie_name = "reader";
				$cookie_value = md5($_SESSION['uid']);
				setcookie($cookie_name, $cookie_value, time() + (21600), "/");

		 ?>	
		<?php redirect(base_url()."web/viewer.php?token=".md5($_SESSION['uid'])."&file=".$filename); ?>
</body>
</html>