<?php

function smarty_function_internal_link($params, $smarty)
{
	global $uri;
	
	$result = '<li';
	if ( $uri === $params['href'] || 
			( $uri === 'index' && $params['href'] === '' ) )
		$result .= ' class="youarehere"';
	
	$result .= sprintf('><a href="%s">%s</a></li>', htmlspecialchars(BASEURL . $params['href']), $params['title']);
	
	return $result;
}
