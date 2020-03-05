<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'idoag_blog');

/** MySQL database username */
define('DB_USER', 'idoagproduction');

/** MySQL database password */
define('DB_PASSWORD', 'idoag*#iG');

/** MySQL hostname */
define('DB_HOST', 'idoagproduction2.cnrlhlbwe14d.ap-south-1.rds.amazonaws.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('RELOCATE',true);

define('FS_METHOD', 'direct');

define('WP_HOME','https://www.idoag.com/blog');
define('WP_SITEURL','https://www.idoag.com/blog');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '!VRCHTjOYB.IcfRi6:?~%u36_B^@=t)R$Tf=DUf [fN6/Z;4.)quy6MqB&o: *2R');
define('SECURE_AUTH_KEY',  'Sy,LN>.pNHH%Jk_*j)QC^LX>&p>y8&;Xs@9C-_^v|aZBc|Qm+%-|%*8=_T-w((R_');
define('LOGGED_IN_KEY',    'WN.+8PEy@2gGcmImJ:sM1~R(-dP$0YeAw<|-EJhMzAY%Un3+_;H+L:,Z4hzN9+n-');
define('NONCE_KEY',        '>A|)IyVv#IW/<yhW&68a|e`V`K1=dS_:dV)7(RsH|^L~iS}+*?5h@mSr*MG&Xag@');
define('AUTH_SALT',        'Y/|Q{ntm$QAAn[R@4*FKU>Kg!]CK{YGC+Zu2:.vBD4YOU~-NJz&=nn @8G9S<imk');
define('SECURE_AUTH_SALT', 'M!cqp&MsJih*K6`JF|hTsNg6qxE0NwNmbp*-n#i3TFOTB|%iyX2-!7bs(@#e){29');
define('LOGGED_IN_SALT',   '[5/,}?+lv:o}iq5.xP6X rmC+x85B*H{e^LG;:^2}e.yXC1tNyN!A#Wt!+%B-EdC');
define('NONCE_SALT',       ']m%|(p<:u*7dBPL5cINsBt(:eE~j^|=9l?jy1csn%%[M6x*0<0}ht.^:2~z9e71>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
