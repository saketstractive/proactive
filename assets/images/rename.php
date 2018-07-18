<?php

$list = scandir("posters/");
var_dump($list);
echo "here <BR/>";
$list = array_diff($list,array('.','..'));

foreach ($list as $file) {
	$new = str_replace(" ", "_", "posters/".$file);
	rename("posters/".$file, $new);
	echo "renamed posters/".$file." as ". $new;
}

echo "Done";