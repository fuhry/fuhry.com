<?php

// I had to kinda trick myself into believing that this was actually PHP.

require 'vendor/autoload.php';

use \Michelf\Markdown;
use \Smarty;

require 'inc/smarty-functions.php';

define('BASEURL', dirname($_SERVER['PHP_SELF']) . '/');
define('BASEDIR', dirname(__FILE__) . '/');

$uri = substr($_SERVER['REQUEST_URI'], strlen(BASEURL));

if ( empty($uri) )
	$uri = 'index';

// FIXME make sure this is not exploitable
if ( !preg_match('#^[A-Za-z0-9/_-]+$#', $uri) )
	redirect('index');

if ( !file_exists($mdfile = BASEDIR . "pages/$uri.md") )
	redirect('index');

$markdown = file_get_contents($mdfile);

$smarty = new Smarty();
$smarty->setTemplateDir(BASEDIR . 'templates/');
$smarty->setCompileDir( BASEDIR . 'cache/templates/compiled/');
$smarty->setConfigDir(  BASEDIR . 'templates/');
$smarty->setCacheDir(   BASEDIR . 'cache/templates/');

$smarty->assign('baseurl', BASEURL);
$smarty->assign('content', Markdown::defaultTransform($markdown));

$smarty->display('page.tpl');

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
