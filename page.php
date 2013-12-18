<?php

// I had to kinda trick myself into believing that this was actually PHP.

require 'vendor/autoload.php';

use \Michelf\Markdown;
use \Smarty;

require 'inc/smarty-functions.php';

define('THEME', 'fuhry');

define('BASEURL', rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/');
define('BASEDIR', dirname(__FILE__) . '/');

exec(sprintf('/usr/bin/git --git-dir=%s rev-parse HEAD', escapeshellarg(BASEDIR . '.git')), $head);

define('GITREV', substr(implode('', $head), 0, 7));

$uri = substr($_SERVER['REQUEST_URI'], strlen(BASEURL));

if ( empty($uri) )
	$uri = 'index';

// FIXME make sure this is not exploitable
if ( !preg_match('#^[A-Za-z0-9/_-]+$#', $uri) )
	redirect('index');

if ( !file_exists($mdfile = BASEDIR . "pages/$uri.md") )
	redirect('index');

$markdown = file_get_contents($mdfile);
//$html = htmlentities(Markdown::defaultTransform($markdown), ENT_HTML5 | ENT_NOQUOTES, 'UTF-8');
$html = Markdown::defaultTransform($markdown);

$smarty = new Smarty();
$smarty->setTemplateDir(BASEDIR . 'themes/' . THEME . '/templates/');
$smarty->setCompileDir( BASEDIR . 'cache/templates/compiled/');
$smarty->setConfigDir(  BASEDIR . 'templates/');
$smarty->setCacheDir(   BASEDIR . 'cache/templates/');

$smarty->assign('baseurl', BASEURL);
$smarty->assign('themeurl', BASEURL . 'themes/' . THEME);
$smarty->assign('content', $html);
$smarty->assign('gitrev', GITREV);
$smarty->assign('year', date('Y'));
$smarty->assign('title', false);

// allow markdown pages to set the page title
if ( preg_match('/<!-- title: (.*?) -->/', $markdown, $match) )
	$smarty->assign('title', $match[1]);

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
