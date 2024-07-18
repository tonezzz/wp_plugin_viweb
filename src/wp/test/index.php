<?php
$data = [
    '__FILE__'      => __FILE__,
    'SERVER_NAME'   => $_SERVER['SERVER_NAME'],
    'REQUEST_URI'   => $_SERVER['REQUEST_URI'],
    'QUERY_STRING'  => $_SERVER['QUERY_STRING'],
    '_GET'          => $_GET,
    '_COOKIE'       => $_COOKIE,
    '_SERVER'       =>  $_SERVER,
];
echo '<a href="/en/">/en/?drw</a>';
echo '<pre>'.print_r($data,true).'</pre>';

#echo '<pre>'.print_r($_SERVER['REQUEST_URI'],true).'</pre>';
#echo '<pre>'.print_r($_SERVER['QUERY_STRING'],true).'</pre>';
#echo '<pre>'.print_r($_GET,true).'</pre>';
#echo '<pre>'.print_r($_COOKIE,true).'</pre>';
#echo '<pre>'.print_r($_SERVER,true).'</pre>';
