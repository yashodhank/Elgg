<?php
namespace Elgg\Cache;

/**
 * Represents a group of key-value pairs whose values can be invalidated,
 * forcing a recalculation of the value.
 *
 * Exactly how/when the values are invalidated is not specified by this API,
 * except that specific values can be forcefully invalidated with ::invalidate().
 *
 * WARNING: API IN FLUX. DO NOT USE DIRECTLY.
 *
 * @package    Elgg
 * @subpackage Cache
 * @since      1.10.0
 *
 * @access private
 */
interface Pool {
	/**
	 * Fetches a value from the cache, with the option of calculating on miss
	 *
	 * @param string|int    $key      A plain string ID for the cache entry
	 * @param callable|null $callback Logic for calculating the cache entry on miss
	 * @param mixed         $default  Default value returned if the value is missing and no callback is provided
	 *
	 * @return mixed The cache value or the $default if no value and no callable
	 * @throws \InvalidArgumentException if $key is not string or int
	 */
	public function get($key, callable $callback = null, $default = null);
	
	/**
	 * Forcefully invalidates the value associated with the given key.
	 *
	 * Implementations must:
	 *  * Immediately consider the value stale
	 *  * Recalculate the value at the next opportunity
	 *
	 * @param string|int $key A plain string ID for the cache entry to invalidate.
	 *
	 * @return void
	 * @throws \InvalidArgumentException if $key is not string or int
	 */
	public function invalidate($key);

	/**
	 * Prime the cache to a specific value.
	 *
	 * This is useful when the value was calculated by some out-of-band means.
	 * For example, when a list of rows is fetched from the database, you can
	 * prime the cache for each individual result.
	 *
	 * @param string|int $key   A plain string ID for the cache entry
	 * @param mixed      $value The cache value
	 *
	 * @return void
	 * @throws \InvalidArgumentException if $key is not string or int
	 */
	public function put($key, $value);
}
