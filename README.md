# Register Hooks
Hook callback registration module for Drupal 7. Allows developer to use any PHP callable to implement Drupal hooks, instead of modulename_hookname() functions.

register_hooks  Copyright (C) 2014  John A Dillick
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------------------

Example Drupal Hook registration using real callables (not just crumby functions).

```php
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
RegisterHooks::hooks('my_module_name', array(
    'menu' => array('Router', 'menu'),
    'menu_myroute_pc' => array('Router', 'page')
  )
);

class Router {
  /**
   * Implements hook_menu().
   */
  public static function menu() {
    $items['myroute'] = array(
      'title' => 'I am a menu route.',
      'page callback' => 'my_module_name_menu_myroute_pc',
      'access callback' => TRUE,
      'type' => MENU_NORMAL_ITEM,
    );

    return $items;
  }

  /**
   * My page callable for /myroute
   */
  public static page() {
    return array(); // render array
  }
}
```
