<?php
/**
 * XML-RPC protocol support for NXTClass
 *
 * @package NXTClass
 */

/**
 * Whether this is a XMLRPC Request
 *
 * @var bool
 */
define('XMLRPC_REQUEST', true);

// Some browser-embedded clients send cookies. We don't want them.
$_COOKIE = array();

// A bug in PHP < 5.2.2 makes $HTTP_RAW_POST_DATA not set by default,
// but we can do it ourself.
if ( !isset( $HTTP_RAW_POST_DATA ) ) {
	$HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
}

// fix for mozBlog and other cases where '<?xml' isn't on the very first line
if ( isset($HTTP_RAW_POST_DATA) )
	$HTTP_RAW_POST_DATA = trim($HTTP_RAW_POST_DATA);

/** Include the bootstrap for setting up NXTClass environment */
include('./nxt-load.php');

if ( isset( $_GET['rsd'] ) ) { // http://archipelago.phrasewise.com/rsd
header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);
?>
<?php echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
<rsd version="1.0" xmlns="http://archipelago.phrasewise.com/rsd">
  <service>
    <engineName>NXTClass</engineName>
    <engineLink>http://opensource.nxtclass.tk/</engineLink>
    <homePageLink><?php bloginfo_rss('url') ?></homePageLink>
    <apis>
      <api name="NXTClass" blogID="1" preferred="true" apiLink="<?php echo site_url('xmlrpc.php', 'rpc') ?>" />
      <api name="Movable Type" blogID="1" preferred="false" apiLink="<?php echo site_url('xmlrpc.php', 'rpc') ?>" />
      <api name="MetaWeblog" blogID="1" preferred="false" apiLink="<?php echo site_url('xmlrpc.php', 'rpc') ?>" />
      <api name="Blogger" blogID="1" preferred="false" apiLink="<?php echo site_url('xmlrpc.php', 'rpc') ?>" />
      <api name="Atom" blogID="" preferred="false" apiLink="<?php echo site_url('nxt-app.php/service', 'rpc') ?>" />
    </apis>
  </service>
</rsd>
<?php
exit;
}

include_once(ABSPATH . 'nxt-admin/includes/admin.php');
include_once(ABSPATH . nxtINC . '/class-IXR.php');
include_once(ABSPATH . nxtINC . '/class-nxt-xmlrpc-server.php');

// Turn off all warnings and errors.
// error_reporting(0);

/**
 * Posts submitted via the xmlrpc interface get that title
 * @name post_default_title
 * @var string
 */
$post_default_title = "";

/**
 * Whether to enable XMLRPC Logging.
 *
 * @name xmlrpc_logging
 * @var int|bool
 */
$xmlrpc_logging = 0;

/**
 * logIO() - Writes logging info to a file.
 *
 * @uses $xmlrpc_logging
 * @package NXTClass
 * @subpackage Logging
 *
 * @param string $io Whether input or output
 * @param string $msg Information describing logging reason.
 * @return bool Always return true
 */
function logIO($io,$msg) {
	global $xmlrpc_logging;
	if ($xmlrpc_logging) {
		$fp = fopen("../xmlrpc.log","a+");
		$date = gmdate("Y-m-d H:i:s ");
		$iot = ($io == "I") ? " Input: " : " Output: ";
		fwrite($fp, "\n\n".$date.$iot.$msg);
		fclose($fp);
	}
	return true;
}

if ( isset($HTTP_RAW_POST_DATA) )
	logIO("I", $HTTP_RAW_POST_DATA);

// Make sure nxt_die output is XML
add_filter( 'nxt_die_handler', '_xmlrpc_nxt_die_filter' );

// Allow for a plugin to insert a different class to handle requests.
$nxt_xmlrpc_server_class = apply_filters('nxt_xmlrpc_server_class', 'nxt_xmlrpc_server');
$nxt_xmlrpc_server = new $nxt_xmlrpc_server_class;

// Fire off the request
$nxt_xmlrpc_server->serve_request();
?>