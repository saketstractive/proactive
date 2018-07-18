<?php
$list = scandir("upload/");

$password = "awsedrftgyhu";

	foreach ($list as $value) {
		if (strpos($value, ".pdf") !== FALSE) {
			$cmd = "pdftk /var/www/html/pratham/upload/$value output /var/www/html/pratham/upload/xyz$value userpw $password";

			echo "$cmd <BR />";
		}
		
	}
?>