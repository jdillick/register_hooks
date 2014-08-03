<?php
/**
 * @file
 * Route.php
 */

namespace Drupal\register_hooks_example;
use \Drupal\register_hooks\RegisterHooks;

class Route {

  /**
   * Implements hook_menu().
   */
  public static function menu() {
    $items['yoface'] = array(
      'title' => t('Yo Face'),
      'page callback' => 'register_hooks_example_menu_yoface_page',
      'access callback' => TRUE,
      'type' => MENU_NORMAL_ITEM,
    );

    return $items;
  }

  /**
   * Page callback
   */
  public static function page() {
    echo "Yo face!";
  }
}
