<?php
/**
 * @file
 * Route.php
 */

namespace Drupal\register_hooks_example;

class Route {

  /**
   * Implements hook_menu().
   */
  public static function menu() {
    $items['yoface'] = array(
      'title' => t('Yo Face'),
      'page callback' => 'Drupal\register_hooks_example\yoface_page',
      'access callback' => TRUE,
      'type' => MENU_NORMAL_ITEM,
    );

    return $items;
  }
}

function yoface_page() {
    echo "Yo face namespaced procedural!";
}
