<?php
/*
Plugin Name: Custom DDB Driver
Description: Plugin to allow for choice of DB driver
Version: 0.1
Author: Antoine GRÉA
Author URI: https://antoine.grea.me
*/

yourls_add_filter( 'db_connect_custom_dsn', 'custom_db' );

function custom_db($in) {
	
	foreach ($_ENV as $var_name => $var) {
		define( $var_name, $var );
	}
	
	if (   !defined( 'YOURLS_DB_USER' )
			or !defined( 'YOURLS_DB_PASS' )
			or !defined( 'YOURLS_DB_NAME' )
			or !defined( 'YOURLS_DB_HOST' )
			or !defined( 'YOURLS_DB_DRIVER' )
		) yourls_die ( yourls__( 'Incorrect DB config, or could not connect to DB' ), yourls__( 'Fatal error' ), 503 );

	$dbhost = YOURLS_DB_HOST;
	$user   = YOURLS_DB_USER;
	$pass   = YOURLS_DB_PASS;
	$dbname = YOURLS_DB_NAME;
	$dbdriver = YOURLS_DB_DRIVER;

	if ( false !== strpos( $dbhost, ':' ) ) {
			    list( $dbhost, $dbport ) = explode( ':', $dbhost );
			    $dbhost = sprintf( '%1$s;port=%2$d', $dbhost, $dbport );
	}

	$charset = yourls_apply_filter( 'db_connect_charset', 'utf8' );

	$dsn = sprintf( '%s:host=%s;dbname=%s;charset=%s', $dbdriver, $dbhost, $dbname, $charset );
	return($dsn);
}
