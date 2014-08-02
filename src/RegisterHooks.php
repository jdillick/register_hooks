<?php
/**
 * @file
 * RegisterHooks.php
 */

namespace Drupal\register_hooks;

class RegisterHooks {
  /**
   * Get a lambda for any php callable
   * @param  callable $callback the callable
   * @return string the lambda function for your callable
   */
  public static function lambda($callback){
    if ( is_callable($callback) ) {
      $label = 'label_' . sha1(time());
      self::register('register_hooks', $label, $callback);
      return create_function('$args=array()',
        "return call_user_func_array(
            \\Drupal\\register_hooks\\RegisterHooks::register('register_hooks', $label), func_get_args());"
      );
    }
    return 'noop';
  }

  /**
   * Create a drupal hook on any php callable.
   * @param  string $module   the module name
   * @param  string $hook     the hook name
   * @param  callable $callback the callable
   */
  public static function hook( $module, $hook, $callback ) {

    if ( is_callable($callback) && module_exists($module) ) {
      self::register($module, $hook, $callback);
      eval(
"function {$module}_{$hook}() {
return call_user_func_array(
  \\Drupal\\register_hooks\\RegisterHooks::register($module, $hook), func_get_args()
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
