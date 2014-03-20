<?php

/**
 * Example Drupal Hook registration using real callbacks (not just functions).
 */

register_hooks_register('my_module_name', 'init', array('Test','init'));
class Test {
  /**
   * Implements hook_init().
   * Believe it or not.
   */
  static function init() {
    // do hook_init stuff
  }
}

register_hooks_register('my_module_name', 'form_alter', array(new Test2(), 'form_alter'));
class Test2 {
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
