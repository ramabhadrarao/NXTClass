<?php
// Last sync [nxt11537]

/**
 * Object Cache API
 *
 * @link http://codex.nxtclass.org/Function_Reference/nxt_Cache
 *
 * @package NXTClass
 * @subpackage Cache
 */



/**
 * Adds data to the cache, if the cache key doesn't aleady exist.
 *
 * @since 2.0.0
 * @uses $nxt_object_cache Object Cache Class
 * @see nxt_Object_Cache::add()
 *
 * @param int|string $key The cache ID to use for retrieval later
 * @param mixed $data The data to add to the cache store
 * @param string $flag The group to add the cache to
 * @param int $expire When the cache data should be expired
 * @return unknown
 */
function nxt_cache_add($key, $data, $flag = '', $expire = 0) {
	global $nxt_object_cache;

	return $nxt_object_cache->add($key, $data, $flag, $expire);
}

/**
 * Closes the cache.
 *
 * This function has ceased to do anything since NXTClass 2.5. The
 * functionality was removed along with the rest of the persistent cache. This
 * does not mean that plugins can't implement this function when they need to
 * make sure that the cache is cleaned up after NXTClass no longer needs it.
 *
 * @since 2.0.0
 *
 * @return bool Always returns True
 */
function nxt_cache_close() {
	return true;
}

/**
 * Removes the cache contents matching ID and flag.
 *
 * @since 2.0.0
 * @uses $nxt_object_cache Object Cache Class
 * @see nxt_Object_Cache::delete()
 *
 * @param int|string $id What the contents in the cache are called
 * @param string $flag Where the cache contents are grouped
 * @return bool True on successful removal, false on failure
 */
function nxt_cache_delete($id, $flag = '') {
	global $nxt_object_cache;

	return $nxt_object_cache->delete($id, $flag);
}

/**
 * Removes all cache items.
 *
 * @since 2.0.0
 * @uses $nxt_object_cache Object Cache Class
 * @see nxt_Object_Cache::flush()
 *
 * @return bool Always returns true
 */
function nxt_cache_flush( $group = null ) {
	// nxt does not support group flushing
	global $nxt_object_cache;

	return $nxt_object_cache->flush( $group );
}

/**
 * Retrieves the cache contents from the cache by ID and flag.
 *
 * @since 2.0.0
 * @uses $nxt_object_cache Object Cache Class
 * @see nxt_Object_Cache::get()
 *
 * @param int|string $id What the contents in the cache are called
 * @param string $flag Where the cache contents are grouped
 * @return bool|mixed False on failure to retrieve contents or the cache
 *		contents on success
 */
function nxt_cache_get($id, $flag = '') {
	global $nxt_object_cache;

	return $nxt_object_cache->get($id, $flag);
}

/**
 * Sets up Object Cache Global and assigns it.
 *
 * @since 2.0.0
 * @global nxt_Object_Cache $nxt_object_cache NXTClass Object Cache
 */
function nxt_cache_init() {
	$GLOBALS['nxt_object_cache'] =& new nxt_Object_Cache();
}

/**
 * Replaces the contents of the cache with new data.
 *
 * @since 2.0.0
 * @uses $nxt_object_cache Object Cache Class
 * @see nxt_Object_Cache::replace()
 *
 * @param int|string $id What to call the contents in the cache
 * @param mixed $data The contents to store in the cache
 * @param string $flag Where to group the cache contents
 * @param int $expire When to expire the cache contents
 * @return bool False if cache ID and group already exists, true on success
 */
function nxt_cache_replace($key, $data, $flag = '', $expire = 0) {
	global $nxt_object_cache;

	return $nxt_object_cache->replace($key, $data, $flag, $expire);
}

/**
 * Saves the data to the cache.
 *
 * @since 2.0
 * @uses $nxt_object_cache Object Cache Class
 * @see nxt_Object_Cache::set()
 *
 * @param int|string $id What to call the contents in the cache
 * @param mixed $data The contents to store in the cache
 * @param string $flag Where to group the cache contents
 * @param int $expire When to expire the cache contents
 * @return bool False if cache ID and group already exists, true on success
 */
function nxt_cache_set($key, $data, $flag = '', $expire = 0) {
	global $nxt_object_cache;

	return $nxt_object_cache->set($key, $data, $flag, $expire);
}

/**
 * Adds a group or set of groups to the list of global groups.
 *
 * @since 2.6.0
 *
 * @param string|array $groups A group or an array of groups to add
 */
function nxt_cache_add_global_groups( $groups ) {
	global $nxt_object_cache;

	return $nxt_object_cache->add_global_groups( $groups );
}

/**
 * Adds a group or set of groups to the list of non-persistent groups.
 *
 * @since 2.6.0
 *
 * @param string|array $groups A group or an array of groups to add
 */
function nxt_cache_add_non_persistent_groups( $groups ) {
	global $nxt_object_cache;

	return $nxt_object_cache->add_non_persistent_groups( $groups );
}
