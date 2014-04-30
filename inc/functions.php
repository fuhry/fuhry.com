<?php

#################
# Functions

function redirect($uri, $prefix = true)
{
	$prefix = $prefix ? BASEURL : '';
	$uri = $prefix . $uri;
	
	header('HTTP/1.1 302 Found');
	header("Location: $uri");
	
	echo "0";
	
	exit;
}
