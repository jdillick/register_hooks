<?php
/**
 * Example Drupal Hook registration using real callbacks (not just functions).
 */

use Drupal\register_hooks\RegisterHooks;

RegisterHooks::hook('my_module_name', 'init', array('StaticCall','init'));
class StaticCall {
  /**
   * Implements hook_init().
   * Believe it or not.
   */
  static function init() {
    // do hook_init stuff
  }
}

RegisterHooks::hook('my_module_name', 'form_alter', array(new InstantiatedCall(), 'form_alter'));
class InstantiatedCall {
  /**
   * Implements hook_form_alter().
   * No joke.
   */
  function form_alter(&$form, &$form_state, $form_id) {
    $form['blah'] = array(
      '#type' => '',
      '#title' => t(''),
      '#default_value' => $settings[''],
      '#required' => ,
      '#element_validate' => array(''),
      '#description' => t(''),
    );
  }
}

/**
 * Autoloaded example.
 *
 * Your ViewsController loaded PSR-0 or PSR-4 style!
 */
RegisterHooks::hook('my_views_module', 'views_data', array(
    'Drupal\my_views_module\ViewsController', 'data'
  )
);

/**
 * Example page callable in a menu hook.
 */
RegisterHooks::hook('my_module_name', 'menu', array('Router', 'menu'));
class Router {
  /**
   * Implements hook_menu().
   */
  public static function menu() {
    $items['myroute'] = array(
      'title' => 'I am a menu route.',
      'page callback' => RegisterHooks::lambda(array(__CLASS__,'my_page_callable')),
      'page arguments' => array(),
      'access arguments' => array(''),
      'type' => ,
      'file' => ,
    );

    return $items;
  }

  /**
   * My page callable for /myroute
   */
  public static my_page_callable() {
    return array(); // render array
  }
}

