<?php
$table_prefix  = 'wp_';

define( 'WP_DEBUG', false );

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

define( 'DB_CHARSET', $_ENV["DB_CHARSET"] );
define( 'DB_COLLATE', $_ENV["DB_COLLATE"] );


define( 'AUTH_KEY',         'C~;uq_4?|*>}o!q0KxYaJ$,QigPbQ8h_pGG}c}I09|[=M?#X%[e,Wc$#aJz-,!|#' );
define( 'SECURE_AUTH_KEY',  'Q^#fa)}*~a=gNE%R3F!TPy?1K%8<~dys~`o}[}9jLN^:QlN*rz-Jv<BfL)_=5a6Z' );
define( 'LOGGED_IN_KEY',    '+;aG_ytnxk$ba@1sH[Dnoi%6u;OHO%fj@oW:TV*Yaxk0!-;.AhpD2/v?c>vUQI!W' );
define( 'NONCE_KEY',        '(`f>rINZ5^qws3EaZcA4k5Ln[53d4l~wGOdI<n_P(3[x28T{b?kS1<51ti*LI|]o' );
define( 'AUTH_SALT',        'xtqP/@g`Nspk}bmJ|{!2Z`cDmf^21L}xSw!Uogig%w*25V`Vsk%eyVWWU|iBFF6%' );
define( 'SECURE_AUTH_SALT', 'iad_~WBK{W2#7[ pN:|j_S$8_1/D2|X2-jS2~N!I0o?SN<G/#K|Q4m%%d|9}(g]y' );
define( 'LOGGED_IN_SALT',   '()Gb;eWfit*jWS?vSu(Y4FxTsZUa,5=1fw%GPs**7]|1E9H@4h:y_R:#<Ju81mFp' );
define( 'NONCE_SALT',       'uHPz1zg&+cxINyWI!HXOV]>b)5AsT0&k5~:6pz)@2&3]=~~[eHOC&Jl<.Yv$<=9Q' );

define( 'WP_DEBUG', false );


$protocol = 'http';
$_SERVER['HTTPS']='off';
if (getenv('NOW_URL')) {
	$_SERVER['HTTPS']='on';
	$protocol = 'https';
}
define('WP_SITEURL', $protocol . '://' . $_SERVER['HTTP_HOST']);
define('WP_HOME', $protocol . $_SERVER['HTTP_HOST']);

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');


