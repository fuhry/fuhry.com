<?php

// load 3rd party stuff
// I had to kinda trick myself into believing that this was actually PHP:
require 'vendor/autoload.php';

use \Michelf\MarkdownExtra;
use \Smarty;

// load local stuff
require 'inc/smarty-functions.php';

// which set of templates and resources will be used
define('THEME', 'fuhry');

// these two constants help us find further resources
define('BASEURL', rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/');
define('BASEDIR', dirname(__FILE__) . '/');

// get git revision
$head = file_get_contents(BASEDIR . '.git/refs/heads/master');
define('GITREV', substr($head, 0, 7));

// begin routing logic - determine page name from request URI
$uri = substr($_SERVER['REQUEST_URI'], strlen(BASEURL));

// emulate DirectoryIndex
if ( empty($uri) )
	$uri = 'index';

// FIXME make sure this is not exploitable
if ( !preg_match('#^[A-Za-z0-9/_-]+$#', $uri) )
	redirect('index');

// init and configure Smarty
$smarty = new Smarty();
$smarty->setTemplateDir($templateDir = BASEDIR . 'themes/' . THEME . '/templates/');
$smarty->setCompileDir( BASEDIR . 'cache/templates/compiled/');
$smarty->setConfigDir(  BASEDIR . 'templates/');
$smarty->setCacheDir(   BASEDIR . 'cache/templates/');

$smarty->assign('baseurl', BASEURL);
$smarty->assign('themeurl', BASEURL . 'themes/' . THEME);
$smarty->assign('gitrev', GITREV);
$smarty->assign('year', date('Y'));
$smarty->assign('title', false);

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
