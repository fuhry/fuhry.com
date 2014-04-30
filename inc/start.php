<?php

// these two constants help us find further resources
define('BASEURL', rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/');
define('BASEDIR', dirname(dirname(__FILE__)) . '/');

// load 3rd party stuff
// I had to kinda trick myself into believing that this was actually PHP:
require BASEDIR . 'vendor/autoload.php';

// load local stuff
require BASEDIR . 'inc/config.php';
require BASEDIR . 'inc/functions.php';
require BASEDIR . 'inc/smarty-functions.php';

// get git revision
$head = file_get_contents(BASEDIR . '.git/refs/heads/master');
define('GITREV', substr($head, 0, 7));

use \Smarty;

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


