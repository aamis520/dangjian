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
define('DB_NAME', 'dangjian');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ' cr`:tmCimMQ|)JApvMv5|3>acR*ZBeRCNR>&!W2{$x[f]c/Gow5Xq_.R]VHq!%*');
define('SECURE_AUTH_KEY',  '[1LC3ZS| LLm_4Fn+VMX$)F|tQf7Cb=)P*wP-fBx2i/B)`b^p^a{G6<Q:%Zo8,d<');
define('LOGGED_IN_KEY',    'il_)R7W?`2u3aKtq~%A{~RUn5V~.@3CG|<hs8@%aO7{(6v6rkL*FbX*Hv$0Mr%t)');
define('NONCE_KEY',        'wB0O6W74Gax@)ISEBnB{/U>xC8BpDps.W6]vm6|w)iq@v:1.Rc3PtBEefb)z^4+)');
define('AUTH_SALT',        '~C({/O-`aW#fbItP43HFs|H`IF-!rcUi9uMas`W.%qmm7#M_Z3tZ@qfdFv(@!,i^');
define('SECURE_AUTH_SALT', '7rW*[kBxjqNU@aFHKw^ <B+t8t!0LO(Z}tqyx(a]Ri0K,4}yVJ?|QLmVeY09@TmQ');
define('LOGGED_IN_SALT',   '2{&DHJ+A</9>G[&M w=a$mfo,2>l-^}KHG`m1BRi)Iff&fJ>Er@YzCbB$+L80PM/');
define('NONCE_SALT',       '$v*C9[ng.Q3)G5#2h@L&$f{`&9J*Ep!y8W-1gU&*a|-%<#N_wgR+^;Nl2uks_.nN');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dangjian_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
