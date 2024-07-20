<?php
//if(isset($_GET['dden'])) {
	gen_link("/en/?dden");
	global $wp_query,$wp_rewrite;
	//ob_clean();
    die("<pre>".print_r([
		'xx'			=> 'xx',
		'__FILE__'      => __FILE__,
		'SERVER_NAME'   => $_SERVER['SERVER_NAME'],
		'REQUEST_URI'   => $_SERVER['REQUEST_URI'],
		'QUERY_STRING'  => $_SERVER['QUERY_STRING'],
		'_GET'          => $_GET,
		'_COOKIE'       => $_COOKIE,
		'_SERVER'       =>  $_SERVER,
	],true));

    function gen_link($url){ echo "<a href='{$url}'>{$url}</a>"; }
//}
