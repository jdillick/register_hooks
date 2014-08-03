<?php
/**
 * @file
 * RegisterHooks.php
 */

namespace Drupal\register_hooks;

class RegisterHooks {
  /**
   * Create multiple drupal hooks on php callables.
   * @param  string $module   the module name
   * @param  array $callbacks array('hook' => <callable>)
   */
  public static function hooks($module, $callbacks) {
    foreach ( $callbacks as $hook => $callback ) {
      self::hook($module, $hook, $callback );
    }
  }

  /**
   * Create a drupal hook on any php callable.
   * @param  string $module   the module name
   * @param  string $hook     the hook name
   * @param  callable $callback the callable
   */
  public static function hook( $module, $hook, $callback ) {
    $hook = check_plain($hook);
    if ( is_callable($callback) && module_exists($module) ) {
      self::register($module, $hook, $callback);
      eval(
        "function {$module}_{$hook}() {
        return call_user_func_array(
          \\Drupal\\register_hooks\\RegisterHooks::register('$module', '$hook'), func_get_args()
          );
        }"
      );
    }
  }

  /**
   * Register a php callable and associate with a module and hook.
   * @param  string  $module   module name
   * @param  string  $hook     hook name
   * @param  callable $callback (optional) Any php callable or FALSE to get registered callable.
   * @return callable the registered callable
   */
  public static function register( $module, $hook, $callback = FALSE ) {
    $callbacks = &drupal_static(__METHOD__);
    if ( ! is_array($callbacks) ) $callbacks = array();

    if ( is_callable($callback) ) {
      $callbacks[$module][$hook] = $callback;
      return $callback;
    }

    if ( isset($callbacks[$module][$hook]) ) {
      return $callbacks[$module][$hook];
    }

    return 'noop';
  }
}
