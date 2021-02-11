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

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */



// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'mccorca_bd' );



/** MySQL database username */

define( 'DB_USER', 'mccorca_mccorca' );



/** MySQL database password */

define( 'DB_PASSWORD', 'B}Q3LM}SV[[e' );



/** MySQL hostname */

define( 'DB_HOST', 'localhost' );



/** Database Charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8mb4' );



/** The Database Collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );



/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         '{<* XG^&$)[j&*4x]7yQ?%EQlIHS!^CH-|D:{bYyrE(}a7t8K6I* (6MO8Pwv^3w' );

define( 'SECURE_AUTH_KEY',  '0.E;~S`0+>Ef$e3bn5)Wzb/onWnJa[Q*9qkA`> 799xU^9[%rnmP}B&:H bqH[W.' );

define( 'LOGGED_IN_KEY',    'oYz0Y!z<QO#D+t6/(mb3GdkD!ya<=-0U)n$XSpPb$C=(:U>ccM5ZaemN1Bq/C+h8' );

define( 'NONCE_KEY',        'dfk.lD$^B-go68z<Z/_;rCl7}j/aT?X47 %5ZC5ovn&0O<1{HnF/g!=bOg{>&bw&' );

define( 'AUTH_SALT',        'H$;`x(|iz~,)^=&G=+sWw`9 e@u<2{}#,]*-L`]K=l]r>&pE&9^Vin2cVO6XZ)u/' );

define( 'SECURE_AUTH_SALT', 'D~b&Lm6-|bDVuIOdP.F>)<?M>6K*2k0zI|ytK3d+or,VNwA#sVLSaJl@mq,8d]zm' );

define( 'LOGGED_IN_SALT',   'CG{*N(:d@{4N.o9DPII:[`FojspM-axx?ls}F+l(DF!caf|&?[ GaUcc[s=*m_} ' );

define( 'NONCE_SALT',       '2*Oo[20z(02Q>o#7x2D[IC(tCU_fU}O^de/8?O~X|.T{=$UOHis6} /&7O@I8|fH' );



/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'wp_';



/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the documentation.

 *

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );



/* That's all, stop editing! Happy publishing. */



/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}



/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

