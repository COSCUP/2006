<?php
/* 
* Very small php script that generates 304 redirect to static files.
*
* Static files was fetched using HTTrack. Files are then renamed to it's full query string.
*
* ~ timdream (Feb 2010)
*
*/

$siteURL = 'http://coscup.org/2006/';

/*
Joomla site search - ask Google instead.
*/
if ($_GET['searchword']) {
	header('Location: http://www.google.com/search?q=' . $_GET['searchword'] . '+site:' . $siteURL);
	exit();
}

/*
Assume index.html will be served before index.php (this file) 
Please verify this in httpd config - will results redirect loop if incorrect.
*/
if (!$_SERVER['QUERY_STRING']) {
	header('Location: ' . $siteURL);
	exit();
}

/*
Do 304 redirection.
We could readfile() but it's not that important to maintain the behavior as long as people could find their old content right?
*/
header('Location: ' . $siteURL . preg_replace('/&amp\;/', '&', $_SERVER['QUERY_STRING']) . '.html');

?>
