<?php

require 'inc/start.php';

use \Michelf\MarkdownExtra;
use \Smarty;

// begin routing logic - determine page name from request URI
$uri = substr($_SERVER['REQUEST_URI'], strlen(BASEURL));

// emulate DirectoryIndex
if ( empty($uri) )
	$uri = 'index';

// FIXME make sure this is not exploitable
if ( !preg_match('#^[A-Za-z0-9/_-]+$#', $uri) )
	redirect('index');

// try to load markdown file for this page...
if ( file_exists($mdfile = BASEDIR . "pages/$uri.md") )
{
	// got it - read and parse
	$markdown = file_get_contents($mdfile);
	$parser = new MarkdownExtra;
	$html = $parser->defaultTransform($markdown);
	
	// allow markdown pages to set the page title
	if ( preg_match('/<!-- title: (.*?) -->/', $markdown, $match) )
		$smarty->assign('title', $match[1]);
	
	// font awesome icons
	$html = preg_replace('/\{([a-z-]+)\}/', '<i class="fa fa-$1"></i>', $html);
	
	// determine last-modified
	$mtime = @filemtime($mdfile);
	if ( is_int($mtime) )
	{
		header('Last-Modified: ' . date(DATE_RFC822, $mtime));
	}
}
else if ( file_exists($htmlfile = BASEDIR . "pages/$uri.html") )
{
	// straight html
	$markup = file_get_contents($htmlfile);
	
	// allow markdown pages to set the page title
	if ( preg_match('/<!-- title: (.*?) -->/', $markup, $match) )
		$smarty->assign('title', $match[1]);
	
	// determine last-modified
	$mtime = @filemtime($mdfile);
	if ( is_int($mtime) )
	{
		header('Last-Modified: ' . date(DATE_RFC822, $mtime));
	}
	
	$html =& $markup;
}
else
{
	// no such page... show 404
	
	header('HTTP/1.1 404 Not Found');
	$html = $smarty->fetch('404.tpl');
}

// we have our content; tell smarty what it is
$smarty->assign('content', $html);

// aaaaaand display!
$template = 'page';
if ( file_exists($templateDir . "$uri.tpl") )
	$template = $uri;

$smarty->display("$template.tpl");

