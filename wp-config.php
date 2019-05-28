<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ID211210_webcportfolio' );

/** MySQL database username */
define( 'DB_USER', 'ID211210_webcportfolio' );

/** MySQL database password */
define( 'DB_PASSWORD', 'dItiSMiJn#w8wOorD' );

/** MySQL hostname */
define( 'DB_HOST', 'ID211210_webcportfolio.db.webhosting.be' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '.GC#@j1Bb7B`kjM%KU}rAeD&RMU>)s$768O;/KG(:9g853%6wfo_eCuZ0Q|=IMx(' );
define( 'SECURE_AUTH_KEY',   '%pfB}A~M|D/0]p4ZW^!Q@qQL{cq^-!~|IT#n^ARb%*,t2-iay-hb:@u[p|g(_d^<' );
define( 'LOGGED_IN_KEY',     'MU2;znq|T_ZS#[@2R4=-F+61?O0Tl]g:s.E-gD7BOHo*o7$9)hFi68whS=-=gk2p' );
define( 'NONCE_KEY',         'urTFAGkvP3K[8W*oNTyy{g}gfn.32>3O_Yy@yy&iR<F3Ch+{tBW 7)0AMEt-IEn>' );
define( 'AUTH_SALT',         'vJfR?v;BC~n8G{`R![nhG/,S* }&vbnKAHby:O9<ZXekPv9gW,eEb_{|Dw_s<yH;' );
define( 'SECURE_AUTH_SALT',  '-QuO1Yg{;{Qf&Vei}QL3zB5WyeEV)TRi/*:MQCJ&4(}})g%V%E?Rhdd}|L;!`[OO' );
define( 'LOGGED_IN_SALT',    'C$X4>oQGUnWSQ4znU-})C.*DmxB!N[M:`WSb=$0,O`F!%mz9yhC/IKF@y[SV<z^r' );
define( 'NONCE_SALT',        '.(?c22kjDD}Y1>:CC6N/Ua*bvt_EVE&@u,CZ^<prR%TS?tgEV[?:R~4,E2k,;,>J' );
define( 'WP_CACHE_KEY_SALT', 'C9KS~dMMWMf4I8ZiPD8J~0j0AB>`Vu[zFT3IBbg2c.gS3oWZ!}-Ta-0(e=fsz9V)' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define( 'WP_DEBUG', true );
define( 'SCRIPT_DEBUG', true );


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
